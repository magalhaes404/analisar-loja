<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="archive post-type-archive post-type-archive-product woocommerce woocommerce-page">
        <div id="page">
            <div class="container">
                <?php echo $__env->make('app.bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- #masthead -->
                <div id="content" class="site-content">
                    <div id="primary" class="content-area column full">
                        <main id="main" class="site-main" role="main">
                            <ul class="products">
                                <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="product">
                                    <a href="<?php echo e(route('produto',['uuid'=> $produto->uuid])); ?>">
                                        <img src="<?php echo e(storage_path('app/'.$produto->foto)); ?>" alt="">
                                        <h3><?php echo e($produto->nome); ?></h3>
                                        <span class="price">
                                            <span class="amount"><?php echo e(preco_br($produto->preco)); ?></span></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <?php echo e($produtos->links()); ?>


                        </main>
                        <!-- #main -->
                    </div>
                    <!-- #primary -->
                </div>
                <!-- #content -->
            </div>
            <!-- .container -->
            <?php echo $__env->make('app.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- #page -->

        <?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH C:\wamp64\www\analisar-loja\resources\views/welcome.blade.php ENDPATH**/ ?>