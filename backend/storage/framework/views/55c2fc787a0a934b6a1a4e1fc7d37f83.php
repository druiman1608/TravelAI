<h1>Editar Hotel: <?php echo e($hotel->name); ?></h1>

<form action="<?php echo e(route('hotels.update', $hotel->id)); ?>" method="POST">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <label>Nombre:</label>
    <input type="text" name="name" value="<?php echo e(old('name', $hotel->name)); ?>">
    <br><br>

    <label>Ubicacion:</label>
    <select name="location_id">
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($location->id); ?>"
            <?php echo e(old('location_id', $hotel->location_id) == $location->id ? 'selected' : ''); ?>>
            <?php echo e($location->city); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Estrellas:</label>
    <input type="number" name="stars" min="1" max="5" value="<?php echo e(old('stars', $hotel->stars)); ?>">
    <br><br>

    <label>Precio por noche:</label>
    <input type="number" step="0.01" name="price_per_night"
        value="<?php echo e(old('price_per_night', $hotel->price_per_night)); ?>">
    <br><br>

    <label>Descripcion:</label><br>
    <textarea name="description"><?php echo e(old('description', $hotel->description)); ?></textarea>
    <br><br>

    <button type="submit">Actualizar Hotel</button>
</form>
<a href="<?php echo e(route('hotels.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/hotels/edit.blade.php ENDPATH**/ ?>