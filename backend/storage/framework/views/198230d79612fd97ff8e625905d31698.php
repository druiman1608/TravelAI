<link rel="stylesheet" href="<?php echo e(asset('css/_lists/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pregunta</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($log->id); ?></td>
            <td><?php echo e(Str::limit($log->user_question, 50)); ?></td>
            <td><?php echo e($log->user?->name ?? 'N/A'); ?></td>
            <td>
                <a href="<?php echo e(route('aichatlogs.show', $log->id)); ?>">Ver</a>
                <?php if(auth()->user()->isAdmin()): ?>
                |
                <form action="<?php echo e(route('aichatlogs.destroy', $log->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" onclick="return confirm('¿Borrar Log?')">Borrar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="4">No se encontraron logs en la base de datos.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if($logs->isEmpty()): ?>
<p>No se encontraron registros</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/aichatlogs/_list.blade.php ENDPATH**/ ?>