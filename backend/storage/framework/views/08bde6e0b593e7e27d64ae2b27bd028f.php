<h1>Listado de actividades:</h1>
<p><a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a></p>
<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('activities.create')); ?>">Crear nueva actividad</a></p>
<?php endif; ?>
<hr>
<br>
<?php echo $__env->make('activities._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/activities/index.blade.php ENDPATH**/ ?>