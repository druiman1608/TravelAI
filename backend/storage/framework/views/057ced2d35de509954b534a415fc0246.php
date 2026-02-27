<h1>Editar Rol: <?php echo e($role->name); ?></h1>
<form action="<?php echo e(route('roles.update', $role->id)); ?>" method="POST">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <label>Nombre del Rol:</label>
    <input type="text" name="name" value="<?php echo e(old('name', $role->name)); ?>">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p style="color: red;"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <button type="submit">Actualizar</button>
</form><?php /**PATH /var/www/resources/views/roles/edit.blade.php ENDPATH**/ ?>