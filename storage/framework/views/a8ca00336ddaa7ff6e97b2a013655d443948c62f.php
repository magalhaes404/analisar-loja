<?php if($paginator->hasPages()): ?>
<nav class="woocommerce-pagination">
    <ul class="page-numbers">
        <?php if($paginator->onFirstPage()): ?>
        <li><span class="next page-numbers" ><</span></li>
        <?php else: ?>
        <li><a class="next page-numbers" href="<?php echo e($paginator->previousPageUrl()); ?>"><</a></li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        
        <?php if(is_array($element)): ?>
        <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($page == $paginator->currentPage()): ?>
        <li><span class="page-numbers current"><?php echo e($page); ?></span></li>
        <?php else: ?>
        <li><a class="page-numbers" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>

        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($paginator->hasMorePages()): ?>
            <li><a class="next page-numbers" href="<?php echo e($paginator->nextPageUrl()); ?>">></a></li>
        <?php else: ?>
            <li><span class="next page-numbers" >></span></li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\analisar-loja\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>