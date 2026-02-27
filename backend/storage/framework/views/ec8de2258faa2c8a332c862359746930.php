<h1>Mis Preferencias de Viaje</h1>

<?php if(session('success')): ?>
<p style="color: green;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<form action="<?php echo e(route('userPreferences.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <label>¿Tipo de viaje preferido? (Mochileo, Lujo, Relax, Aventura...)</label><br>
    <input type="text" name="travel_type" value="<?php echo e(old('travel_type', $preference->travel_type ?? '')); ?>" required>
    <?php $__errorArgs = ['travel_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p style="color:red"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Presupuesto maximo aproximado:</label><br>
    <input type="number" step="0.01" name="max_budget" value="<?php echo e(old('max_budget', $preference->max_budget ?? '')); ?>"
        required>
    <?php $__errorArgs = ['max_budget'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p style="color:red"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <label>Clima favorito:</label><br>
    <input type="text" name="fav_weather" value="<?php echo e(old('fav_weather', $preference->fav_weather ?? '')); ?>" required>
    <?php $__errorArgs = ['fav_weather'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p style="color:red"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <br><br>

    <button type="submit">Guardar mis preferencias</button>

    <br>
    <br>
    <a href="<?php echo e(route('dashboard')); ?>">
        Cancelar y volver al Dashboard
    </a>
    <hr>
</form><?php /**PATH /var/www/resources/views/userPreferences/form.blade.php ENDPATH**/ ?>