<?php
/**
 * Soporte para instalar SpaceCrafter en una subcarpeta (p. ej. /demos/spacecrafter/)
 * además de en la raíz de un dominio.
 *
 * - base_path(): carpeta pública donde está instalada la app ('' si está en la raíz).
 *   Se detecta sola; se puede forzar con la variable de entorno APP_BASE.
 * - url('/ruta'): antepone esa carpeta a una ruta absoluta.
 * - Las páginas pueden seguir escribiendo href="/assets/...": un búfer de salida
 *   añade la carpeta a href/src/action/poster y expone window.APP_BASE para el JS.
 */

if (!function_exists('base_path')) {

function base_path(): string {
    static $base = null;
    if ($base !== null) return $base;

    $forced = getenv('APP_BASE');
    if ($forced !== false && $forced !== '') {
        return $base = rtrim('/' . trim($forced, '/'), '/');
    }

    // URL del script menos su ruta relativa a la raíz de la app = carpeta pública de la app
    $root   = str_replace('\\', '/', (string) realpath(dirname(__DIR__)));
    $file   = str_replace('\\', '/', (string) realpath($_SERVER['SCRIPT_FILENAME'] ?? ''));
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $rel    = ($root !== '' && str_starts_with($file, $root)) ? substr($file, strlen($root)) : '';

    if ($rel !== '' && str_ends_with($script, $rel)) {
        return $base = rtrim(substr($script, 0, -strlen($rel)), '/');
    }
    return $base = '';
}

function url(string $path = '/'): string {
    return base_path() . '/' . ltrim($path, '/');
}

/** Añade la carpeta base a las rutas absolutas del HTML generado. */
function base_rewrite_html(string $html): string {
    $base = base_path();
    if ($base === '') return $html;

    // href="/x", src='/x', action="/x"… (no toca "//cdn…" ni rutas ya prefijadas)
    $quoted = preg_quote($base, '#');
    $html = preg_replace(
        '#\b(href|src|action|poster)=(["\'])/(?!/)(?!' . ltrim($quoted, '/') . '(?:/|\2))#i',
        '$1=$2' . $base . '/',
        $html
    );

    // Módulos ES escritos dentro de la página: import … from '/x' e import('/x')
    $html = preg_replace(
        '#\b(from\s*|import\s*\(\s*)(["\'])/(?!/)(?!' . ltrim($quoted, '/') . '/)#',
        '$1$2' . $base . '/',
        $html
    );

    // Variable para los scripts, lo antes posible dentro de <head>
    $script = '<script>window.APP_BASE=' . json_encode($base) . ';</script>';
    return preg_replace('#<head(\s[^>]*)?>#i', '$0' . $script, $html, 1) ?? $html;
}

// Activa la reescritura una sola vez por petición
if (PHP_SAPI !== 'cli' && empty($GLOBALS['__base_buffer'])) {
    $GLOBALS['__base_buffer'] = true;
    ob_start('base_rewrite_html');
}

}
