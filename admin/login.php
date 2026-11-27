<?php
require '../config.php';
$err = '';
$_SESSION['login_attempts'] = $_SESSION['login_attempts'] ?? [];
$_SESSION['login_attempts'] = array_values(array_filter($_SESSION['login_attempts'], fn($t) => $t > time() - 900));
$locked = count($_SESSION['login_attempts']) >= 5;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    if ($locked) {
        $err = 'Too many failed attempts. Wait 15 minutes before trying again.';
    } else {
        $s = $pdo->prepare('SELECT id, password_hash FROM admins WHERE username = ? LIMIT 1');
        $s->execute([trim($_POST['username'] ?? '')]);
        $admin = $s->fetch();
        if ($admin && password_verify($_POST['password'] ?? '', $admin['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = (int)$admin['id'];
            $_SESSION['login_attempts'] = [];
            header('Location: index.php'); exit;
        }
        $_SESSION['login_attempts'][] = time();
        $locked = count($_SESSION['login_attempts']) >= 5;
        $err = 'Invalid login details.';
    }
}
$pageTitle = 'Admin login'; $pageDescription = 'Secure administrator sign-in.';
include '../includes/header.php';
?>
<section class="section container"><div class="content contact-card" style="max-width:520px;margin:auto"><h1>Administrator login</h1>
<?php if ($err): ?><div class="notice"><?=e($err)?></div><?php endif; ?>
<?php if (!$locked): ?><form method="post" autocomplete="on"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><label>Username<input name="username" autocomplete="username" required></label><label>Password<input type="password" name="password" autocomplete="current-password" required></label><button class="btn" type="submit">Sign in</button></form><?php else: ?><p>Sign-in is temporarily locked because of repeated failed attempts.</p><?php endif; ?>
</div></section><?php include '../includes/footer.php'; ?>
