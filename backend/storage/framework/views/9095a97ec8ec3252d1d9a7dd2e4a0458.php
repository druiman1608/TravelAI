<h1>Listado de Reservas</h1>
<?php if(auth()->user()->isAdmin()): ?>
<p><strong>Administrador:</strong> Viendo todas las reservas del sistema.</p>
<?php else: ?>
<p>Mis reservas:</p>
<?php endif; ?>
<p><a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a></p>
<p><a href="<?php echo e(route('reservations.create')); ?>">Crear nueva reserva</a></p>
<hr>
<br>
<?php echo $__env->make('reservations._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/reservations/index.blade.php ENDPATH**/ ?>