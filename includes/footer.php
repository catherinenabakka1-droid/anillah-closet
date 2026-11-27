<footer class="site-footer <?=$isAdmin ? 'admin-footer' : ''?>">
  <div class="container footer-grid">
    <div><div class="brand">ANILLAH <span>CLOSET</span></div><p>Style, confidence and everyday elegance.</p><p>Thoughtfully chosen looks for your wardrobe.</p></div>
    <div><h3>Explore</h3><a href="<?=$isAdmin ? '../index.php' : 'index.php'?>">⌂ Home</a><a href="<?=$isAdmin ? '../shop.php' : 'shop.php'?>">✦ Shop collection</a><a href="<?=$isAdmin ? '../about.php' : 'about.php'?>">♡ Our story</a></div>
    <div><h3>Customer care</h3><a href="<?=$isAdmin ? '../orders.php' : 'orders.php'?>">🛍 Place an order</a><a href="<?=$isAdmin ? '../cart.php' : 'cart.php'?>">🛒 Shopping cart</a><a href="<?=$isAdmin ? '../contact.php' : 'contact.php'?>">✉ Contact us</a></div>
    <div><h3>Stay connected</h3><p>Have a question about a look, size or availability?</p><a href="<?=$isAdmin ? '../contact.php' : 'contact.php'?>">Send us a message →</a><p>📍 Uganda</p></div>
  </div>
  <div class="container footer-bottom"><p>For more information about the developer contact <a href="mailto:nabakkacatherinemariam@gmail.com">nabakkacatherinemariam@gmail.com</a> or WhatsApp <a href="https://wa.me/256763781324">0763781324</a>.</p><p>© <?=date('Y')?> ANILLAH CLOSET · Website currently for study purposes.</p></div>
</footer>
<script>
/* Accessible mobile navigation */
(() => {
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.getElementById('main-navigation');
  if (!toggle || !menu) return;
  toggle.addEventListener('click', () => {
    const isOpen = menu.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
    toggle.querySelector('span').textContent = isOpen ? 'Close' : 'Menu';
  });
  menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
    menu.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.querySelector('span').textContent = 'Menu';
  }));
  window.addEventListener('resize', () => {
    if (window.innerWidth > 900) {
      menu.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.querySelector('span').textContent = 'Menu';
    }
  });
})();
</script>
</body>
</html>