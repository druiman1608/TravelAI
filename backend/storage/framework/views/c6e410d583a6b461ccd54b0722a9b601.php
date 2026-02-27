<h1>Gestion de Roles</h1>
<p><a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a></p>
<a href="<?php echo e(route('roles.create')); ?>">Crear Nuevo Rol</a>
<br><br>

<?php if(session('success')): ?>
<div style="color: green; font-weight: bold;"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
<div style="color: red; font-weight: bold;"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php echo $__env->make('roles._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/roles/index.blade.php ENDPATH**/ ?>