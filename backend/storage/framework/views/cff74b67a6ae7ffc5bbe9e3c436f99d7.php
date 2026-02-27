<h1>Crear Nueva Reserva</h1>

<?php if($errors->any()): ?>
<div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?php echo e(route('reservations.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <label>Reservar Paquete:</label>
    <select name="package_id">
        <option value="">-- No seleccionar paquete --</option>
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($package->id); ?>" <?php echo e(old('package_id') == $package->id ? 'selected' : ''); ?>>
            <?php echo e($package->name); ?> (<?php echo e($package->total_price); ?>€)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Reservar Hotel:</label>
    <select name="hotel_id">
        <option value="">-- No seleccionar hotel --</option>
        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($hotel->id); ?>" <?php echo e(old('hotel_id') == $hotel->id ? 'selected' : ''); ?>>
            <?php echo e($hotel->name); ?> (<?php echo e($hotel->price_per_night); ?>€/noche)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Reservar Vuelo:</label>
    <select name="flight_id">
        <option value="">-- No seleccionar vuelo --</option>
        <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($flight->id); ?>" <?php echo e(old('flight_id') == $flight->id ? 'selected' : ''); ?>>
            <?php echo e($flight->airline); ?> - <?php echo e($flight->origin); ?> (<?php echo e($flight->price); ?>€)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Reservar Actividad:</label>
    <select name="activity_id">
        <option value="">-- No seleccionar actividad --</option>
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($activity->id); ?>" <?php echo e(old('activity_id') == $activity->id ? 'selected' : ''); ?>>
            <?php echo e($activity->name); ?> (<?php echo e($activity->price); ?>€)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <button type="submit">Confirmar Reserva</button>
</form>

<br>
<a href="<?php echo e(route('reservations.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/reservations/create.blade.php ENDPATH**/ ?>