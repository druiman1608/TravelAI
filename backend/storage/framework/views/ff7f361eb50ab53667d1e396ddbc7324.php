<h1>Editar Paquete: <?php echo e($package->name); ?></h1>

<?php if($errors->any()): ?>
<div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
    <strong>Error:</strong> Debes seleccionar al menos dos servicios.
</div>
<?php endif; ?>

<form action="<?php echo e(route('packages.update', $package->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <label>Nombre del Paquete:</label>
    <input type="text" name="name" value="<?php echo e(old('name', $package->name)); ?>">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Hotel:</label>
    <select name="hotel_id">
        <option value="">-- Quitar Hotel --</option>
        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($hotel->id); ?>" <?php echo e(old('hotel_id', $package->hotel_id) == $hotel->id ? 'selected' : ''); ?>>
            <?php echo e($hotel->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Vuelo:</label>
    <select name="flight_id">
        <option value="">-- Quitar Vuelo --</option>
        <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($flight->id); ?>" <?php echo e(old('flight_id', $package->flight_id) == $flight->id ? 'selected' : ''); ?>>
            <?php echo e($flight->airline); ?> (<?php echo e($flight->origin); ?> -> <?php echo e($flight->location->city); ?>)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Actividad:</label>
    <select name="activity_id">
        <option value="">-- Quitar Actividad --</option>
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($activity->id); ?>"
            <?php echo e(old('activity_id', $package->activity_id) == $activity->id ? 'selected' : ''); ?>>
            <?php echo e($activity->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Precio Total:</label>
    <input type="number" step="0.01" name="total_price" value="<?php echo e(old('total_price', $package->total_price)); ?>">
    <?php $__errorArgs = ['total_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <button type="submit">Guardar Cambios</button>
</form>

<br>
<a href="<?php echo e(route('packages.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/packages/edit.blade.php ENDPATH**/ ?>