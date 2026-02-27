<h1>Crear Nuevo Paquete</h1>

<?php if($errors->any()): ?>
<div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
    <strong>Error:</strong> Debes seleccionar al menos dos servicios.
</div>
<?php endif; ?>

<form action="<?php echo e(route('packages.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <label>Nombre del Paquete:</label>
    <input type="text" name="name" value="<?php echo e(old('name')); ?>" required>
    <br><br>

    <p><small>* Selecciona al menos dos:</small></p>

    <label>Hotel:</label>
    <select name="hotel_id">
        <option value="">-- No incluir hotel --</option>
        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($hotel->id); ?>" <?php echo e(old('hotel_id') == $hotel->id ? 'selected' : ''); ?>>
            <?php echo e($hotel->name); ?> (<?php echo e($hotel->location->city); ?>)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Vuelo:</label>
    <select name="flight_id">
        <option value="">-- No incluir vuelo --</option>
        <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($flight->id); ?>" <?php echo e(old('flight_id') == $flight->id ? 'selected' : ''); ?>>
            <?php echo e($flight->airline); ?>: <?php echo e($flight->origin); ?> -> <?php echo e($flight->location->city); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Actividad:</label>
    <select name="activity_id">
        <option value="">-- No incluir actividad --</option>
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($activity->id); ?>" <?php echo e(old('activity_id') == $activity->id ? 'selected' : ''); ?>>
            <?php echo e($activity->name); ?> (<?php echo e($activity->location->city); ?>)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Precio Total:</label>
    <input type="number" step="0.01" name="total_price" value="<?php echo e(old('total_price')); ?>" required>
    <br><br>

    <button type="submit">Crear Paquete</button>
</form>

<br>
<a href="<?php echo e(route('packages.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/packages/create.blade.php ENDPATH**/ ?>