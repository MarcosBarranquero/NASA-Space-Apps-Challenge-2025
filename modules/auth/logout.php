<?php
session_start();

// destruir todo lo de la sesión
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// redirigir a la página pública (ej. onepage o login)
header("Location: /onepage");
exit;
