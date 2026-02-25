<link rel="stylesheet" href="<?php echo e(asset('../../css/_list/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($activity->name); ?></td>
            <td><?php echo e($activity->location->city ?? 'Sin localizacion'); ?></td>
            <td><?php echo e($activity->price); ?>€</td>
            <td>
                <a href="<?php echo e(route('activities.show', $activity->id)); ?>">Ver</a>

                <?php if(auth()->user()->isAdmin()): ?>
                | <a href="<?php echo e(route('activities.edit', $activity->id)); ?>">Editar</a> |
                <form action="<?php echo e(route('activities.destroy', $activity->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('¿Seguro?')">Borrar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php if($activities->isEmpty()): ?>
<p>No hay actividades disponibles.</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/activities/_list.blade.php ENDPATH**/ ?>