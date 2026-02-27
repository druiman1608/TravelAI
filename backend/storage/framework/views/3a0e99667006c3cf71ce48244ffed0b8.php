<h1>Editar Reserva #<?php echo e($reservation->id); ?></h1>

<form action="<?php echo e(route('reservations.update', $reservation->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <?php if(auth()->user()->isAdmin()): ?>
    <div>
        <label>Paquete:</label><br>
        <select name="package_id">
            <option value="">Ninguno</option>
            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($package->id); ?>" <?php echo e($reservation->package_id == $package->id ? 'selected' : ''); ?>>
                <?php echo e($package->name); ?> (<?php echo e($package->total_price); ?>€)
            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <br>

    <div>
        <label>Hotel:</label><br>
        <select name="hotel_id">
            <option value="">Ninguno</option>
            <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($hotel->id); ?>" <?php echo e($reservation->hotel_id == $hotel->id ? 'selected' : ''); ?>>
                <?php echo e($hotel->name); ?> (<?php echo e($hotel->location->name); ?>)
            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <br>

    <div>
        <label>Vuelo:</label><br>
        <select name="flight_id">
            <option value="">Ninguno</option>
            <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($flight->id); ?>" <?php echo e($reservation->flight_id == $flight->id ? 'selected' : ''); ?>>
                <?php echo e($flight->airline); ?> - <?php echo e($flight->destination); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <br>

    <div>
        <label>Actividad:</label><br>
        <select name="activity_id">
            <option value="">Ninguno</option>
            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($activity->id); ?>" <?php echo e($reservation->activity_id == $activity->id ? 'selected' : ''); ?>>
                <?php echo e($activity->name); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <br>

    <label>Estado de la Reserva [Vista Admin]:</label><br>
    <select name="status">
        <option value="pendiente" <?php echo e($reservation->status == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
        <option value="confirmada" <?php echo e($reservation->status == 'confirmada' ? 'selected' : ''); ?>>Confirmada</option>
        <option value="cancelada" <?php echo e($reservation->status == 'cancelada' ? 'selected' : ''); ?>>Cancelada</option>
    </select>
    <br><br>
    <button type="submit">Guardar Cambios</button>

    <?php else: ?>
    <div style="background: #f4f4f4; padding: 15px; border-radius: 8px;">
        <p><strong>Detalles de tu reserva:</strong></p>
        <ul>
            <?php if($reservation->package_id): ?> <li>Paquete: <?php echo e($reservation->package->name); ?></li> <?php endif; ?>
            <?php if($reservation->hotel_id): ?> <li>Hotel: <?php echo e($reservation->hotel->name); ?></li> <?php endif; ?>
            <?php if($reservation->flight_id): ?> <li>Vuelo: <?php echo e($reservation->flight->airline); ?>

                (<?php echo e($reservation->flight->destination); ?>)</li> <?php endif; ?>
            <?php if($reservation->activity_id): ?> <li>Actividad: <?php echo e($reservation->activity->name); ?></li> <?php endif; ?>
        </ul>
        <p><strong>Precio Total:</strong> <?php echo e(number_format($reservation->price, 2)); ?>€</p>
        <p><strong>Estado actual:</strong> <?php echo e(ucfirst($reservation->status)); ?></p>
    </div>

    <br>
    <?php if($reservation->status !== 'cancelada'): ?>
    <input type="hidden" name="status" value="cancelada">
    <button type="submit" style="background: red; color: white;"
        onclick="return confirm('¿Seguro de que quieres cancelar esta reserva?')">
        Cancelar Reserva
    </button>
    <?php else: ?>
    <p style="color: red;">Esta reserva ya ha sido cancelada.</p>
    <?php endif; ?>
    <?php endif; ?>
</form>

<br>
<a href="<?php echo e(route('reservations.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/reservations/edit.blade.php ENDPATH**/ ?>