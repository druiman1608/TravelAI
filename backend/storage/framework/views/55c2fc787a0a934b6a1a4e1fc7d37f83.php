<h1>Editar hotel:</h1>
<form method="POST" action="<?php echo e(route('hotels.update', $hotel->id)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" value="<?php echo e(old('name', $hotel->name)); ?>" required><br><br>

    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error" style="color:red"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description"
        required><?php echo e(old('description', $hotel->description)); ?></textarea><br><br>

    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error" style="color:red"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="stars">Estrellas:</label>
    <input type="number" id="stars" name="stars" min="1" max="5" value="<?php echo e(old('stars', $hotel->stars)); ?>"
        required><br><br>

    <?php $__errorArgs = ['stars'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error" style="color:red"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="location_id">Ubicación:</label>
    <select id="location_id" name="location_id" required>
        <option value="">Selecciona una localizacion</option>
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($location->id); ?>"
            <?php echo e(old('location_id', $hotel->location_id) == $location->id ? 'selected' : ''); ?>>
            <?php echo e($location->city); ?> (<?php echo e($location->country); ?>)
        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error" style="color:red"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="price_per_night">Precio por noche:</label>
    <input type="number" id="price_per_night" name="price_per_night" step="0.01"
        value="<?php echo e(old('price_per_night', $hotel->price_per_night)); ?>" required><br><br>

    <?php $__errorArgs = ['price_per_night'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error" style="color:red"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <button type="submit">Actualizar hotel</button>
</form><?php /**PATH /var/www/resources/views/hotels/edit.blade.php ENDPATH**/ ?>