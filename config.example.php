<?php
declare(strict_types=1);

// Production credentials should be supplied as environment variables.
// For local WAMP, edit the fallback values below.
$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Lax');
    session_set_cookie_params([
        'lifetime' => 0, 'path' => '/', 'secure' => $secure,
        'httponly' => true, 'samesite' => 'Lax'
    ]);
    session_start();
}

const SITE_NAME = 'ANILLAH CLOSET';
const CURRENCY = 'UGX';
$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_NAME = getenv('DB_NAME') ?: 'anillah_closet';
$DB_USER = getenv('DB_USER') ?: 'YOUR_DATABASE_USER';
$DB_PASS = getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'YOUR_DATABASE_PASSWORD';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log('ANILLAH CLOSET database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('The website is temporarily unavailable. Please contact the site administrator.');
}

function e($value): string { return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function verify_csrf(): void {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(403); exit('Your form session expired. Refresh the page and try again.');
    }
}
function money($value): string { return CURRENCY . ' ' . number_format((float)$value); }
function require_admin(): void {
    if (empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
}
