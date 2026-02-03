<?php
// Prefer environment variables for secrets; keep safe fallbacks for local development only.
// Require credentials from environment in production. Remove plaintext fallbacks.
DEFINE('DB_USER', getenv('DB_USER') ?: '');
DEFINE('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
DEFINE('DB_HOST', getenv('DB_HOST') ?: 'localhost');
DEFINE('DB_NAME', getenv('DB_NAME') ?: '');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($dbc, 'utf8');

function escape_data($data, $dbc){
   return mysqli_real_escape_string($dbc, trim($data));
}