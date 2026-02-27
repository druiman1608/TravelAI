<h1>Editar Usuario: <?php echo e($user->name); ?></h1>

<form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

    <label>Nombre:</label><br>
    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
    <br><br>

    <label>Contraseña:</label><br>
    <p style="color: red;">*Si no quiere ser cambiada simplemente no llenar este campo*</p>
    <input type="password" name="password">
    <br><br>

    <label>Confirmar Contraseña:</label><br>
    <input type="password" name="password_confirmation">
    <br><br>

    <?php if(auth()->user()->isAdmin()): ?>
    <label>Rol:</label><br>
    <select name="role_id" required>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($role->id); ?>" <?php echo e(old('role_id', $user->role_id) == $role->id ? 'selected' : ''); ?>>
            <?php echo e($role->name); ?>

        </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php endif; ?>
    <br><br>

    <button type="submit">Actualizar</button>
</form><?php /**PATH /var/www/resources/views/users/edit.blade.php ENDPATH**/ ?>