<?php
require 'config.php';
$pageTitle = 'Home'; $pageDescription='Discover featured dresses and skirts at ANILLAH CLOSET. Explore the latest fashion collection and shop styles from UGX 10,000.';
$products = $pdo->query("SELECT * FROM products WHERE is_active=1 ORDER BY created_at DESC, id DESC LIMIT 8")->fetchAll();
$slides = [
 ['image'=>'assets/images/product-02.jpg','alt'=>'Yellow dress from the collection','label'=>'Brighten your wardrobe'],
 ['image'=>'assets/images/product-07.jpg','alt'=>'Black elegant dress from the collection','label'=>'Classic looks, confident style'],
 ['image'=>'assets/images/product-14.jpg','alt'=>'Magenta dress from the collection','label'=>'A little colour goes a long way'],
 ['image'=>'assets/images/product-21.jpg','alt'=>'Mustard dress from the collection','label'=>'Find a look you love'],
 ['image'=>'assets/images/product-29.jpg','alt'=>'Navy skirt from the collection','label'=>'Everyday style, beautifully done'],
 ['image'=>'assets/images/product-44.jpg','alt'=>'Floral skirt from the collection','label'=>'Make it your own']
];
include 'includes/header.php';
?>
<section class="hero hero-fullbleed" aria-label="Anillah Closet featured collection">
 <div class="hero-slider hero-slider-wide" data-slider aria-label="Featured clothing image slider">
  <div class="slides">
   <article class="slide active" aria-hidden="false">
    <img src="assets/images/product-02.jpg" alt="Yellow dress from the Anillah Closet collection" fetchpriority="high">
    <div class="slide-shade"></div><div class="slide-copy"><span class="slide-kicker">THE ANILLAH EDIT · 01</span><h1>Colour your<br>everyday.</h1><p>Fresh, feel-good dresses that bring a little sunshine to every occasion.</p><a class="btn slide-cta" href="shop.php">Explore dresses <span aria-hidden="true">↗</span></a></div>
   </article>
   <article class="slide" aria-hidden="true">
    <img src="assets/images/product-07.jpg" alt="Classic black dress from the collection" loading="lazy">
    <div class="slide-shade"></div><div class="slide-copy"><span class="slide-kicker">TIMELESS FAVOURITES · 02</span><h1>Classic looks.<br>Bold confidence.</h1><p>Find your go-to pieces for days when effortless style says it all.</p><a class="btn slide-cta" href="shop.php">Find your favourite <span aria-hidden="true">↗</span></a></div>
   </article>
   <article class="slide" aria-hidden="true">
    <img src="assets/images/product-14.jpg" alt="Magenta dress from the Anillah Closet collection" loading="lazy">
    <div class="slide-shade"></div><div class="slide-copy"><span class="slide-kicker">A POP OF PINK · 03</span><h1>Make room<br>for colour.</h1><p>Playful shades and flattering pieces, selected to help your style shine.</p><a class="btn slide-cta" href="shop.php">Shop the collection <span aria-hidden="true">↗</span></a></div>
   </article>
   <article class="slide" aria-hidden="true">
    <img src="assets/images/product-44.jpg" alt="Floral skirt from the collection" loading="lazy">
    <div class="slide-shade"></div><div class="slide-copy"><span class="slide-kicker">YOUR STYLE, YOUR STORY · 04</span><h1>Everyday pieces.<br>Extraordinary you.</h1><p>Discover skirts and easy favourites made for expressing your own style.</p><a class="btn slide-cta" href="shop.php">Browse new arrivals <span aria-hidden="true">↗</span></a></div>
   </article>
  </div>
  <button class="slider-arrow prev" type="button" aria-label="Previous slide">&#10094;</button><button class="slider-arrow next" type="button" aria-label="Next slide">&#10095;</button>
  <div class="slider-progress" aria-hidden="true"><span></span></div>
  <div class="slider-dots" aria-label="Choose a slide"><button type="button" class="active" aria-label="Show slide 1" aria-current="true"></button><button type="button" aria-label="Show slide 2" aria-current="false"></button><button type="button" aria-label="Show slide 3" aria-current="false"></button><button type="button" aria-label="Show slide 4" aria-current="false"></button></div>
  <div class="hero-bottom-note"><span>ANILLAH CLOSET</span><span>Styles from UGX 10,000–50,000</span></div>
 </div>
</section>
<section class="section container"><div class="section-head"><div><div class="eyebrow">Curated for you</div><h2>Featured pieces</h2><p>Fresh finds to make getting dressed feel special.</p></div><a class="btn light" href="shop.php">View all pieces</a></div>
 <?php if ($products): ?><div class="grid"><?php foreach ($products as $p): ?><article class="product"><a href="shop.php"><img src="<?=e($p['image'])?>" alt="<?=e($p['name'])?>" loading="lazy"></a><div class="product-info"><h3><?=e($p['name'])?></h3><div class="price"><?=money($p['price'])?></div><p class="muted"><?=e($p['category'])?></p><a class="btn product-link" href="orders.php?product=<?=$p['id']?>">Order this piece</a></div></article><?php endforeach; ?></div><?php else: ?><p class="notice">Our collection is being prepared. Please check back soon.</p><?php endif; ?>
</section>
<section class="story-strip"><div class="container story-inner"><div class="eyebrow">Your style, your story</div><h2>Find your next favourite look.</h2><p>From standout dresses to easy everyday pieces, explore a collection made for expressing your own style.</p><a class="btn" href="shop.php">Shop the collection</a></div></section>
<script>
(() => {
 const slider=document.querySelector('[data-slider]'); if(!slider) return;
 const slides=[...slider.querySelectorAll('.slide')], dots=[...slider.querySelectorAll('.slider-dots button')];
 const prev=slider.querySelector('.prev'), next=slider.querySelector('.next'), progress=slider.querySelector('.slider-progress span');
 let current=0, timer=null, progressTimer=null, startedAt=0; const interval=3200;
 function show(n){
  current=(n+slides.length)%slides.length;
  slides.forEach((el,i)=>{const active=i===current;el.classList.toggle('active',active);el.setAttribute('aria-hidden',active?'false':'true');});
  dots.forEach((el,i)=>{const active=i===current;el.classList.toggle('active',active);el.setAttribute('aria-current',active?'true':'false');});
  if(progress){progress.style.transition='none';progress.style.width='0%';void progress.offsetWidth;progress.style.transition=`width ${interval}ms linear`;progress.style.width='100%';}
 }
 function stop(){if(timer)clearInterval(timer);timer=null;}
 function start(){stop();show(current);timer=setInterval(()=>show(current+1),interval);}
 dots.forEach((dot,i)=>dot.addEventListener('click',()=>{show(i);start()}));
 prev.addEventListener('click',()=>{show(current-1);start()}); next.addEventListener('click',()=>{show(current+1);start()});
 slider.addEventListener('mouseenter',stop); slider.addEventListener('mouseleave',start); slider.addEventListener('focusin',stop); slider.addEventListener('focusout',start);
 document.addEventListener('visibilitychange',()=>document.hidden?stop():start());
 show(0);start();
})();
</script>
<?php include 'includes/footer.php'; ?>
