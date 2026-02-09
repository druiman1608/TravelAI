<link rel="stylesheet" href="<?php echo e(asset('../../css/hotels/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estrellas</th>
            <th>Ubicación</th>
            <th>Precio por noche</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($hotel->name); ?></td>
            <td><?php echo e($hotel->stars); ?></td>
            <td><?php echo e($hotel->location->city ?? 'Sin localizacion'); ?></td>
            <td><?php echo e($hotel->price_per_night); ?></td>
            <td>
                <a href="<?php echo e(route('hotels.show', $hotel->id)); ?>">Ver</a> |
                <a href="<?php echo e(route('hotels.edit', $hotel->id)); ?>">Editar</a> |
                <form action="<?php echo e(route('hotels.destroy', $hotel->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php if($hotels->isEmpty()): ?>
<p>No hay hoteles.</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/hotels/_list.blade.php ENDPATH**/ ?>