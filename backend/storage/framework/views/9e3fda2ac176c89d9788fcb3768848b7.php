<h1>Catalogo de Paquetes</h1>
<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('packages.create')); ?>">Crear nuevo paquete</a></p>
<?php endif; ?>
<?php echo $__env->make('packages._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<br>
<a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a><?php /**PATH /var/www/resources/views/packages/index.blade.php ENDPATH**/ ?>