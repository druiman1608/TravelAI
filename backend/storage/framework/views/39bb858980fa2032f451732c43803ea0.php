<h1>Detalle de la Reserva #<?php echo e($reservation->id); ?></h1>

<p><strong>Estado:</strong> <?php echo e($reservation->status); ?></p>
<p><strong>Fecha de creación:</strong> <?php echo e($reservation->created_at->format('d/m/Y H:i')); ?></p>
<p><strong>Cliente:</strong> <?php echo e($reservation->user->name); ?> (<?php echo e($reservation->user->email); ?>)</p>

<hr>

<h3>Reserva:</h3>
<ul>
    <?php if($reservation->package): ?>
    <li><strong>Paquete:</strong> <?php echo e($reservation->package->name); ?></li>
    <?php endif; ?>

    <?php if($reservation->hotel): ?>
    <li><strong>Hotel:</strong> <?php echo e($reservation->hotel->name); ?></li>
    <?php endif; ?>

    <?php if($reservation->flight): ?>
    <li><strong>Vuelo:</strong> Vuelo <?php echo e($reservation->flight->airline); ?> (Origen: <?php echo e($reservation->flight->origin); ?>)
    </li>
    <?php endif; ?>
</ul>

<h2>Total: <?php echo e($reservation->price); ?>€</h2>

<br>
<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('reservations.edit', $reservation->id)); ?>">Editar reserva</a></p>
<?php endif; ?>

<br>
<a href="<?php echo e(route('reservations.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/reservations/show.blade.php ENDPATH**/ ?>