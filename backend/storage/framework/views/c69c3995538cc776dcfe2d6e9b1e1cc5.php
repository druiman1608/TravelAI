<h1>Editar Vuelo: <?php echo e($flight->airline); ?></h1>

<form action="<?php echo e(route('flights.update', $flight->id)); ?>" method="POST">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <label>Aerolinea:</label>
    <input type="text" name="airline" value="<?php echo e(old('airline', $flight->airline)); ?>">
    <br><br>

    <label>Destino:</label>
    <select name="location_id">
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($location->id); ?>"
            <?php echo e(old('location_id', $flight->location_id) == $location->id ? 'selected' : ''); ?>>
            <?php echo e($location->city); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Salida:</label>
    <input type="datetime-local" name="departure"
        value="<?php echo e(old('departure', \Carbon\Carbon::parse($flight->departure)->format('Y-m-d\TH:i'))); ?>">
    <br><br>

    <button type="submit">Actualizar Vuelo</button>
</form><?php /**PATH /var/www/resources/views/flights/edit.blade.php ENDPATH**/ ?>