<link rel="stylesheet" href="<?php echo e(asset('../../css/_list/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>Nombre del Paquete</th>
            <th>Hotel</th>
            <th>Vuelo (Origen)</th>
            <th>Actividad</th>
            <th>Precio Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($package->name); ?></td>

            <td><?php echo e($package->hotel->name ?? 'No incluido'); ?></td>

            <td>
                <?php if($package->flight): ?>
                <?php echo e($package->flight->airline); ?> (<?php echo e($package->flight->origin); ?>)
                <?php else: ?>
                No incluido
                <?php endif; ?>
            </td>

            <td><?php echo e($package->activity->name ?? 'No incluida'); ?></td>

            <td><strong><?php echo e($package->total_price); ?>€</strong></td>
            <td>
                <a href="<?php echo e(route('packages.show', $package->id)); ?>">Ver</a>

                <?php if(auth()->user()->isAdmin()): ?>
                | <a href="<?php echo e(route('packages.edit', $package->id)); ?>">Editar</a> |
                <form action="<?php echo e(route('packages.destroy', $package->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('¿Borrar paquete?')">Borrar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php if($packages->isEmpty()): ?>
<p>No hay paquetes disponibles.</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/packages/_list.blade.php ENDPATH**/ ?>