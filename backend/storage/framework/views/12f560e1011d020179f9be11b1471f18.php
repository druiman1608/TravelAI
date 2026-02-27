<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Rol</th>
            <th>Usuarios Asignados</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($role->id); ?></td>
            <td><?php echo e($role->name); ?></td>
            <td><?php echo e($role->users_count ?? $role->users->count()); ?></td>
            <td>
                <a href="<?php echo e(route('roles.edit', $role->id)); ?>">Editar</a>

                <?php if($role->name !== 'Administrador'): ?>
                <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        onclick="return confirm('¿Seguro de qe quieres eliminar este rol? Esto tambien afectaria a los usuarios')">
                        Eliminar
                    </button>
                </form>
                <?php else: ?>
                <span style="color: gray;">[Protegido]</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH /var/www/resources/views/roles/_list.blade.php ENDPATH**/ ?>