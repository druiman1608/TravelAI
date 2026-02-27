<link rel="stylesheet" href="<?php echo e(asset('css/_lists/_list.blade.css')); ?>">

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Correo Electronico</th>
            <th>Rol del Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>#<?php echo e($user->id); ?></td>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td>
                <strong><?php echo e($user->role->name ?? 'Sin Rol'); ?></strong>
            </td>
            <td>
                <a href="<?php echo e(route('users.show', $user->id)); ?>">Ver</a>

                <?php if(auth()->user()->isAdmin() || auth()->id() == $user->id): ?>
                | <a href="<?php echo e(route('users.edit', $user->id)); ?>">Editar</a>
                <?php endif; ?>

                <?php if(auth()->user()->isAdmin() && auth()->id() !== $user->id): ?>
                | <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        onclick="return confirm('¿Seguro de que deseas eliminar este usuario?')">Eliminar</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php if($users->isEmpty()): ?>
<p>No hay usuarios registrados en el sistema.</p>
<?php endif; ?><?php /**PATH /var/www/resources/views/users/_list.blade.php ENDPATH**/ ?>