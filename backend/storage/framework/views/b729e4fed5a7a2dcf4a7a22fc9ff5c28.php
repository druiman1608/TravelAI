<link rel="stylesheet" href="<?php echo e(asset('css/_lists/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>Ciudad</th>
            <th>Pais</th>
            <th>Continente</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($location->city); ?></td>
            <td><?php echo e($location->country); ?></td>
            <td><?php echo e($location->continent); ?></td>
            <td>
                <?php echo e($location->status ? 'Activo' : 'Inactivo'); ?>

            </td>
            <td>
                <a href="<?php echo e(route('locations.show', $location->id)); ?>">Ver</a>
                <?php if(auth()->user()->isAdmin()): ?>
                | <a href="<?php echo e(route('locations.edit', $location->id)); ?>">Editar</a> |
                <form action="<?php echo e(route('locations.destroy', $location->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        onclick="return confirm('¿Borrar localizacion? cuidado, esto borrara hoteles y vuelos asociados a esta localizacion.')">Borrar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php if($locations->isEmpty()): ?> <p>No hay localizaciones creadas.</p> <?php endif; ?><?php /**PATH /var/www/resources/views/locations/_list.blade.php ENDPATH**/ ?>