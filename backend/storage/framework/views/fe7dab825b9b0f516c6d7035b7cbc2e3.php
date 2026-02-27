<link rel="stylesheet" href="<?php echo e(asset('css/_lists/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>Aerolinea</th>
            <th>Origen</th>
            <th>Ciudad de destino</th>
            <th>Salida</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($flight->airline); ?></td>
            <td><?php echo e($flight->origin); ?></td>
            <td><?php echo e($flight->location->city); ?></td>
            <td><?php echo e(($flight->departure)->format('d/m/Y H:i')); ?></td>
            <td><?php echo e($flight->price); ?>€</td>
            <td>
                <a href="<?php echo e(route('flights.show', $flight->id)); ?>">Ver</a>
                <?php if(auth()->user()->isAdmin()): ?>
                | <a href="<?php echo e(route('flights.edit', $flight->id)); ?>">Editar</a> |
                <form action="<?php echo e(route('flights.destroy', $flight->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('¿Borrar vuelo?')">Borrar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php if($flights->isEmpty()): ?>
<p>No hay vuelos disponibles.</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/flights/_list.blade.php ENDPATH**/ ?>