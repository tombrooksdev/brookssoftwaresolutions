<?php
// Local dev: php -S localhost:8080 -t httpdocs scripts/dev-router.php
$file = __DIR__ . '/../httpdocs' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (is_file($file) && !str_ends_with($file, '.php')) return false;
require __DIR__ . '/../httpdocs/index.php';
