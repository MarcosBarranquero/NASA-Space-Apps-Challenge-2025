<?php
function csrf_token(): string {
$_SESSION['csrf'] ??= [];
$t = bin2hex(random_bytes(32));
$_SESSION['csrf'][$t] = time();
foreach ($_SESSION['csrf'] as $k=>$ts) if ($ts < time()-600) unset($_SESSION['csrf'][$k]);
return $t;
}
function csrf_check(?string $t): bool {
if (!$t || !isset($_SESSION['csrf'][$t])) return false;
unset($_SESSION['csrf'][$t]);
return true;
}
