<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body class="single single-product woocommerce woocommerce-page">
        <div id="page">
            <div class="container">
                <?php echo $__env->make('app.bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- #masthead -->
                <div id="content" class="site-content">
                    <div id="primary" class="content-area column full">
                        <main id="main" class="site-main" role="main">
                            <div id="container">
                                <div id="content" role="main">
                                    <div itemscope itemtype="http://schema.org/Product" class="product">
                                        <div class="images">
                                            <img src="<?php echo e(storage_path('app/'.$produto->foto)); ?>" alt=""></img>
                                        </div>
                                        <div class="summary entry-summary">
                                            <h1 itemprop="name" class="product_title entry-title"><?php echo e($produto->nome); ?></h1>
                                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                <p class="price">
                                                    <span class="amount"><?php echo e(preco_br($produto->preco)); ?></span>
                                                </p>
                                            </div>
                                            <form class="cart" method="post" enctype='multipart/form-data'>
                                                <div class="quantity">
                                                    <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4"/>
                                                </div>									
                                                <button type="submit" class="single_add_to_cart_button button alt">Comprar</button>
                                            </form>
                                        </div>
                                        <!-- .summary -->
                                        <div class="woocommerce-tabs wc-tabs-wrapper">
                                            <div class="panel entry-content wc-tab" id="tab-description">
                                                <h2>Produto Descrição</h2>
                                                <p>
                                                    <?php echo e($produto->descricao); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html><?php /**PATH C:\wamp64\www\analisar-loja\resources\views/produto.blade.php ENDPATH**/ ?>