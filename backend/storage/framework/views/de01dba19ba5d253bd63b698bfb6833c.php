<h1>Consultar a la IA</h1>

<form action="<?php echo e(route('aichatlogs.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <label>Escribe tu pregunta:</label><br>
    <textarea name="user_question" required><?php echo e(old('user_question')); ?></textarea>

    <?php $__errorArgs = ['user_question'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p style="color:red"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <br>
    <button type="submit">Preguntar</button>
</form>

<br>
<a href="<?php echo e(route('aichatlogs.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/aichatlogs/create.blade.php ENDPATH**/ ?>