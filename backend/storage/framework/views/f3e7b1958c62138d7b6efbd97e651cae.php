<h1>Editar Localizacion: <?php echo e($location->city); ?></h1>

<form action="<?php echo e(route('locations.update', $location->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <label for="city">Ciudad:</label>
    <input type="text" id="city" name="city" value="<?php echo e(old('city', $location->city)); ?>" required>
    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label for="country">Pais:</label>
    <input type="text" id="country" name="country" value="<?php echo e(old('country', $location->country)); ?>" required>
    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label for="continent">Continente:</label>
    <input type="text" id="continent" name="continent" value="<?php echo e(old('continent', $location->continent)); ?>" required>
    <?php $__errorArgs = ['continent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label for="weather_type">Clima:</label>
    <input type="text" id="weather_type" name="weather_type" value="<?php echo e(old('weather_type', $location->weather_type)); ?>"
        required>
    <?php $__errorArgs = ['weather_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label for="image_url">URL de la Imagen (Opcional):</label>
    <input type="text" id="image_url" name="image_url" value="<?php echo e(old('image_url', $location->image_url)); ?>">
    <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label for="status">Estado:</label>
    <select id="status" name="status" required>
        <option value="1" <?php echo e(old('status', $location->status) == 1 ? 'selected' : ''); ?>>Activo</option>
        <option value="0" <?php echo e(old('status', $location->status) == 0 ? 'selected' : ''); ?>>Inactivo</option>
    </select>
    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label for="description">Descripcion:</label><br>
    <textarea id="description" name="description" rows="5" cols="50"
        required><?php echo e(old('description', $location->description)); ?></textarea>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="color:red"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <button type="submit">Actualizar Localizacion</button>
</form>

<br>
<a href="<?php echo e(route('locations.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/locations/edit.blade.php ENDPATH**/ ?>