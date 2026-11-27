<?php
require_once __DIR__.'/../config.php';
$pageTitle = $pageTitle ?? SITE_NAME;
$pageDescription = $pageDescription ?? 'Explore dresses, skirts and everyday fashion at ANILLAH CLOSET. Browse the collection and send an order enquiry.';
$canonicalPath = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
$navActive = static function (string $file) use ($canonicalPath): string { return $canonicalPath === $file ? ' is-current' : ''; };
$navCurrentAttr = static function (string $file) use ($canonicalPath): string { return $canonicalPath === $file ? ' aria-current="page"' : ''; };
$isAdmin = strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') !== false;
$adminLoggedIn = !empty($_SESSION['admin_id']);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($pageTitle)?> | ANILLAH CLOSET</title>
<meta name="description" content="<?=e($pageDescription)?>">
<meta name="robots" content="index,follow">
<meta name="theme-color" content="#6f304d">
<meta property="og:site_name" content="ANILLAH CLOSET">
<meta property="og:title" content="<?=e($pageTitle)?> | ANILLAH CLOSET">
<meta property="og:description" content="<?=e($pageDescription)?>">
<link rel="stylesheet" href="<?=$isAdmin ? '../assets/style.css' : 'assets/style.css'?>">
<?php if ($isAdmin): ?>
<link rel="stylesheet" href="../assets/admin.css">
<?php endif; ?>
</head>
<body class="<?=$isAdmin ? 'admin-page' : 'store-page'?>">
<div class="top"><?=$isAdmin ? 'ANILLAH CLOSET · ADMINISTRATION' : 'FASHION THAT FEELS LIKE YOU · NEW ARRIVALS'?></div>
<header>
  <div class="container nav">
    <a class="brand brand-with-logo" href="<?=$isAdmin ? ($adminLoggedIn ? 'index.php' : '../index.php') : 'index.php'?>" aria-label="ANILLAH CLOSET home"><img class="site-logo" src="<?=$isAdmin ? '../assets/images/anillah-closet-logo.jpeg' : 'assets/images/anillah-closet-logo.jpeg'?>" alt="ANILLAH CLOSET logo"></a>
    <?php if ($isAdmin && $adminLoggedIn): ?>
      <nav class="admin-topnav">
        <a href="index.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="orders.php">Orders</a>
        <form method="post" action="logout.php" class="logout-form"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><button type="submit">Log out</button></form>
      </nav>
    <?php elseif (!$isAdmin): ?>
      <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-navigation">☰ <span>Menu</span></button>
      <nav id="main-navigation" class="main-navigation">
        <a class="<?=$navActive('index.php')?>" href="index.php"<?=$navCurrentAttr('index.php')?>>Home</a>
        <a class="<?=$navActive('shop.php')?>" href="shop.php"<?=$navCurrentAttr('shop.php')?>>Shop</a>
        <a class="<?=$navActive('about.php')?>" href="about.php"<?=$navCurrentAttr('about.php')?>>About</a>
        <a class="<?=$navActive('blog.php')?>" href="blog.php"<?=$navCurrentAttr('blog.php')?>>Style Journal</a>
        <a class="<?=$navActive('cart.php')?>" href="cart.php"<?=$navCurrentAttr('cart.php')?>>Cart (<?=array_sum($_SESSION['cart']??[])?>)</a>
        <a class="<?=$navActive('orders.php')?>" href="orders.php"<?=$navCurrentAttr('orders.php')?>>Order</a>
        <a class="<?=$navActive('contact.php')?>" href="contact.php"<?=$navCurrentAttr('contact.php')?>>Contact</a>
      </nav>
    <?php endif; ?>
  </div>
</header>
