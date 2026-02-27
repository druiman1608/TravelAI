<h1>Detalles del Usuario</h1>
<ul>
    <li><strong>Nombre:</strong> <?php echo e($user->name); ?></li>
    <li><strong>Email:</strong> <?php echo e($user->email); ?></li>
    <li><strong>Rol:</strong> <?php echo e($user->role->name ?? 'Sin Rol'); ?></li>
    <li><strong>Fecha de Registro:</strong> <?php echo e($user->created_at->format('d/m/Y')); ?></li>
</ul>

<br>
<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('users.edit', $user->id)); ?>">Editar usuario</a></p>
<?php endif; ?>
<a href="<?php echo e(route('users.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/users/show.blade.php ENDPATH**/ ?>