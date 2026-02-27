<h1>Listado de hoteles:</h1>
<p><a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a></p>
<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('hotels.create')); ?>">Crear nuevo hotel</a></p>
<?php endif; ?>
<hr>
<br>
<?php echo $__env->make('hotels._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/hotels/index.blade.php ENDPATH**/ ?>