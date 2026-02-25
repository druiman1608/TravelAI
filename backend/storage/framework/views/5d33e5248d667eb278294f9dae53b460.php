<h1>Listado de usuarios:</h1>
<p><a href="<?php echo e(route('users.create')); ?>">Crear nuevo usuario</a></p>
<?php echo $__env->make('users._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<br>
<a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a><?php /**PATH /var/www/resources/views/users/index.blade.php ENDPATH**/ ?>