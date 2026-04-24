<?php
function session_harden(): void {
  $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
  $name = env('SESSION_NAME','FICH_APP') ?? 'FICH_APP';
  session_name($name);
  session_set_cookie_params([
    'lifetime'=>0,'path'=>'/','domain'=>'',
    'secure'=>$isHttps,'httponly'=>true,'samesite'=>'Lax'
  ]);
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
}
