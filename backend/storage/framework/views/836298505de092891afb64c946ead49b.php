<?php if($errors->any()): ?>
<div
    style="background-color: #fff5f5; color: #c53030; padding: 15px; border: 1px solid #feb2b2; border-radius: 8px; margin-bottom: 20px; font-family: sans-serif;">
    <strong style="display: block; margin-bottom: 5px;">Errores encontrados:</strong>
    <ul style="margin: 0; padding-left: 20px;">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<?php if(session('success')): ?>
<div
    style="background-color: #f0fff4; color: #2f855a; padding: 15px; border: 1px solid #c6f6d5; border-radius: 8px; margin-bottom: 20px; font-family: sans-serif;">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div
    style="background-color: #fff5f5; color: #c53030; padding: 15px; border: 1px solid #feb2b2; border-radius: 8px; margin-bottom: 20px; font-family: sans-serif;">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?><?php /**PATH /var/www/resources/views/partials/alerts.blade.php ENDPATH**/ ?>