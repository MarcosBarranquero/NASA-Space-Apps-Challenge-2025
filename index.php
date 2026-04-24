<?php
declare(strict_types=1);

require_once __DIR__.'/app/session.php';
require_once __DIR__.'/app/env.php';
require_once __DIR__.'/app/db.php';
require_once __DIR__.'/app/csrf.php';
require_once __DIR__.'/app/auth.php';

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer-when-downgrade');

session_harden();

function error_page(int $code): void {
  http_response_code($code);
  $file = __DIR__ . "/modules/error/$code.php";
  if (is_file($file)) require $file;
  else echo "<h1>Error $code</h1><p>Something went wrong.</p>";
  exit;
}

$base = __DIR__ . '/modules/';

$routes = [
  // públicas
  'onepage' => $base.'onepage.php',
  'login'   => $base.'auth/login.php',
  'logout'  => $base.'auth/logout.php',
  'signup'  => $base.'auth/signup.php',
  'forgot-password' => $base.'auth/forgot-password.php',
  'demo' => $base.'habitat/demo.php',
  // privadas (ejemplos)
  'dashboard' => $base.'dashboard/dashboard.php',
  'analytics' => $base.'dashboard/analytics.php',
  'community' => $base.'dashboard/community.php',
  'learn' => $base.'dashboard/learn.php',
  'module_library' => $base.'dashboard/modules.php',
  'my_habitats' => $base.'dashboard/my_habitats.php',
  'profile' => $base.'dashboard/profile.php',
    'creator' => $base.'habitat/habitat.php',
  
];

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$seg  = array_values(array_filter(explode('/', trim($path, '/'))));

// ✅ si no hay segmento, usa 'onepage'
$route = $seg[0] ?? 'onepage';

// Compat ?mod=
if (isset($_GET['mod']) && $_GET['mod'] !== '') $route = $_GET['mod'];

$file = $routes[$route] ?? null;
if ($file === null || strpos($file, $base) !== 0 || !is_file($file)) {
  error_page(404);
}

$public = ['onepage','login','logout', 'signup', 'demo', 'forgot-password'];
if (!in_array($route, $public, true)) {
  auth_guard(); // redirige a /login si no hay sesión
}

require $file;
