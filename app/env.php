<?php
if (!function_exists('env')) {
function env(string $key, ?string $def=null): ?string {
return $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key) ?: $def;
}
}
$envFile = dirname(__DIR__).'/.env';
if (is_file($envFile)) {
foreach (file($envFile, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $line) {
if ($line[0] === '#') continue;
[$k,$v] = array_map('trim', explode('=', $line, 2));
putenv("$k=$v"); $_ENV[$k] = $v; $_SERVER[$k] = $v;
}
}
