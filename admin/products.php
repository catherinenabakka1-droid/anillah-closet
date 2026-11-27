<?php
require '../config.php'; require_admin();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf(); $action = $_POST['action'] ?? '';
    try {
        if ($action === 'delete') {
            $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?'); $stmt->execute([(int)($_POST['id'] ?? 0)]);
        } elseif ($action === 'save') {
            $id = (int)($_POST['id'] ?? 0); $name = trim($_POST['name'] ?? '');
            $category = trim($_POST['category'] ?? 'Clothing'); $sku = trim($_POST['sku'] ?? '');
            $price = filter_var($_POST['price'] ?? null, FILTER_VALIDATE_FLOAT);
            $image = trim($_POST['image'] ?? '');
            if ($name === '' || $category === '' || $sku === '' || $price === false || $price < 10000 || $price > 50000) {
                throw new RuntimeException('Enter a name, category, SKU and a price between UGX 10,000 and UGX 50,000.');
            }
            if (!preg_match('~^assets/images/[A-Za-z0-9._-]+\.(jpg|jpeg|png|webp)$~i', $image) || !is_file(__DIR__ . '/../' . $image)) {
                throw new RuntimeException('Choose an existing product image from the assets/images folder.');
            }
            if ($id) {
                $stmt = $pdo->prepare('UPDATE products SET name=?, category=?, price=?, image=?, sku=? WHERE id=?');
                $stmt->execute([$name, $category, $price, $image, $sku, $id]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO products(name,category,price,image,sku) VALUES(?,?,?,?,?)');
                $stmt->execute([$name, $category, $price, $image, $sku]);
            }
        }
        header('Location: products.php?saved=1'); exit;
    } catch (PDOException $ex) { $error = 'The product could not be saved. Check that its SKU is unique.'; }
      catch (RuntimeException $ex) { $error = $ex->getMessage(); }
}
$edit = null;
if (isset($_GET['edit'])) { $stmt=$pdo->prepare('SELECT * FROM products WHERE id=?'); $stmt->execute([(int)$_GET['edit']]); $edit=$stmt->fetch(); }
$rows=$pdo->query('SELECT * FROM products ORDER BY id DESC')->fetchAll();
$pageTitle='Manage products'; $pageDescription='Administrator product catalogue management.'; include '../includes/header.php';
?>
<div class="container admin-wrap admin-products-wrap"><div class="admin-page-heading"><span class="admin-kicker">CATALOGUE</span><h1>Manage products</h1><p>Add new pieces, update details, and keep your collection looking its best.</p></div><div class="admin-nav"><a href="index.php">Dashboard</a><a href="orders.php">Orders</a><form method="post" action="logout.php" class="logout-form"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><button type="submit">Log out</button></form></div>
<?php if ($error): ?><div class="notice"><?=e($error)?></div><?php elseif(isset($_GET['saved'])): ?><div class="notice success">Product changes saved.</div><?php endif; ?>
<section class="admin-panel admin-product-editor"><h2><?= $edit ? 'Edit product' : 'Add product' ?></h2>
<form method="post" class="admin-product-form"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=e($edit['id']??'')?>">
<label>Product name<input required maxlength="150" name="name" value="<?=e($edit['name']??'')?>"></label>
<label>Category<input required maxlength="80" name="category" value="<?=e($edit['category']??'Clothing')?>"></label>
<label>Price in UGX<input type="number" min="10000" max="50000" step="500" name="price" value="<?=e($edit['price']??'10000')?>" required></label>
<label>Image path<input required name="image" value="<?=e($edit['image']??'assets/images/product-01.jpg')?>"></label>
<label>SKU<input required maxlength="40" name="sku" value="<?=e($edit['sku']??'')?>"></label><button class="btn" type="submit">Save product</button></form></section>
<section class="admin-panel admin-catalogue"><div class="admin-section-heading"><div><span class="admin-kicker">YOUR COLLECTION</span><h2>Product catalogue</h2></div><span class="admin-count"><?=count($rows)?> items</span></div><div class="table-wrap"><table class="table"><thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Actions</th></tr></thead><tbody>
<?php foreach($rows as $product): ?><tr><td><img src="../<?=e($product['image'])?>" alt="" width="48" height="58" style="object-fit:cover"></td><td><?=e($product['name'])?></td><td><?=e($product['category'])?></td><td><?=money($product['price'])?></td><td><a href="?edit=<?=(int)$product['id']?>">Edit</a> <form method="post" style="display:inline" onsubmit="return confirm('Delete this product?')"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=(int)$product['id']?>"><button type="submit">Delete</button></form></td></tr><?php endforeach; ?>
</tbody></table></div></section></div><?php include '../includes/footer.php'; ?>
