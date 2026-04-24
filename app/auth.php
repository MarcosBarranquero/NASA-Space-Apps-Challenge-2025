<?php
require_once __DIR__.'/db.php';

function is_logged(): bool {
  // MODO DEMO: Siempre logueado para que WinHTTrack pueda acceder a todo
  return true;
}

/** Opcional para vistas: */
function current_user(): ?array {
  // MODO DEMO: Usuario falso
  return [
    'id'    => 1,
    'name'  => 'Demo User',
    'email' => 'demo@spacecrafter.com',
  ];
}

/**
 * login por email+password
 * Return:
 *  ['ok'=>true]  ó  ['ok'=>false,'error'=>'...']
 */
function auth_login(string $email, string $pass): array {
  // MODO DEMO: Login simulado
  if ($email === 'demo' && $pass === 'demo') {
      // No necesitamos sesión real si is_logged() siempre devuelve true
      return ['ok'=>true];
  }
  return ['ok'=>false, 'error'=>'Invalid credentials. Use demo/demo'];
}

function auth_register(string $name, string $email, string $password): array {
    return ['ok'=>false, 'error'=>'Registration disabled in demo mode'];
}

function auth_logout(): void {
  // No hace nada en modo demo
}

/** Guard “suave” para privadas */
function auth_guard(): void {
  // MODO DEMO: Permitir acceso a todo
  return;
}
