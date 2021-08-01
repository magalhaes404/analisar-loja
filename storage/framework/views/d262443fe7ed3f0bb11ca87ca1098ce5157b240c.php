<header id="masthead" class="site-header">
    <div class="site-branding">
        <h1 class="site-title"><a href="<?php echo e(route('default')); ?>" rel="home">Loja</a></h1>
    </div>
    <nav id="site-navigation" class="main-navigation">
        <button class="menu-toggle">Menu</button>
        <div class="menu-menu-1-container">
            <ul id="menu-menu-1" class="menu">
                <li><a href="<?php echo e(route('default')); ?>">Home</a></li>
                <li><a href="<?php echo e(route('empresas')); ?>">Empresas Parceiras</a></li>
                <?php if(auth()->guard()->check()): ?>
                <li><a href="about.html">Perfil</a></li>
                <li><a href="shop.html">Sair</a></li>
                <?php endif; ?>    
            </ul>
        </div>
    </nav>
</header>
<?php /**PATH C:\wamp64\www\analisar-loja\resources\views//app/bar.blade.php ENDPATH**/ ?>