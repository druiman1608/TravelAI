<h1>Añadir Nueva Localizacion</h1>

<form action="<?php echo e(route('locations.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <label>Ciudad:</label>
    <input type="text" name="city" value="<?php echo e(old('city')); ?>" required>
    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Pais:</label>
    <input type="text" name="country" value="<?php echo e(old('country')); ?>" required>
    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Continente:</label>
    <input type="text" name="continent" value="<?php echo e(old('continent')); ?>" required>
    <?php $__errorArgs = ['continent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Clima:</label>
    <input type="text" name="weather_type" value="<?php echo e(old('weather_type')); ?>" required>
    <?php $__errorArgs = ['weather_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description" required><?php echo e(old('description')); ?></textarea>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>URL Imagen:</label>
    <input type="text" name="image_url" value="<?php echo e(old('image_url')); ?>">
    <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Estado:</label>
    <select name="status" required>
        <option value="1" <?php echo e(old('status') == '1' ? 'selected' : ''); ?>>Activo</option>
        <option value="0" <?php echo e(old('status') == '0' ? 'selected' : ''); ?>>Inactivo</option>
    </select>
    <br><br>

    <button type="submit">Guardar Localizacion</button>
</form>
<br>
<a href="<?php echo e(route('locations.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/locations/create.blade.php ENDPATH**/ ?>