<?php
require '../config.php'; require_admin();
$rows=$pdo->query('SELECT o.*, p.name AS product_name FROM orders o LEFT JOIN products p ON p.id=o.product_id ORDER BY o.created_at DESC')->fetchAll();
$pageTitle='Orders'; $pageDescription='Review customer order requests.'; include '../includes/header.php';
?>
<div class="container admin-wrap admin-orders-wrap"><div class="admin-page-heading"><span class="admin-kicker">CUSTOMER ACTIVITY</span><h1>Customer order requests</h1><p>Review incoming requests and keep track of the details customers have shared with your boutique.</p></div><div class="admin-nav"><a href="index.php">Dashboard</a><a href="products.php">Products</a><form method="post" action="logout.php" class="logout-form"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><button type="submit">Log out</button></form></div>
<section class="admin-panel admin-orders-panel"><div class="admin-section-heading"><div><span class="admin-kicker">ORDER INBOX</span><h2>Recent requests</h2></div><span class="admin-count"><?=count($rows)?> orders</span></div><div class="table-wrap"><table class="table"><thead><tr><th>Customer</th><th>Product</th><th>Phone</th><th>Email</th><th>Qty</th><th>Size / preference</th><th>Date</th></tr></thead><tbody>
<?php foreach($rows as $o): ?><tr><td><?=e($o['customer_name'])?></td><td><?=e($o['product_name']??'Deleted product')?></td><td><?=e($o['phone'])?></td><td><?=e($o['email'])?></td><td><?=(int)$o['quantity']?></td><td><?=e($o['size'])?></td><td><?=e($o['created_at'])?></td></tr><?php endforeach; ?>
<?php if(!$rows): ?><tr><td colspan="7">No order requests have been received yet.</td></tr><?php endif; ?></tbody></table></div></section></div><?php include '../includes/footer.php'; ?>
