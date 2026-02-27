<h1>Dejar una Reseña</h1>

<?php if($errors->any()): ?>
<div style="color: red;">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?php echo e(route('reviews.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <p>Selecciona uno de los servicios para valorar:</p>

    <label>Paquete:</label>
    <select name="package_id">
        <option value="">-- Ninguno --</option>
        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Hotel:</label>
    <select name="hotel_id">
        <option value="">-- Ninguno --</option>
        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($h->id); ?>"><?php echo e($h->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Vuelo:</label>
    <select name="flight_id">
        <option value="">-- Ninguno --</option>
        <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($f->id); ?>"><?php echo e($f->airline); ?> (<?php echo e($f->origin); ?>)</option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Actividad:</label>
    <select name="activity_id">
        <option value="">-- Ninguno --</option>
        <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($a->id); ?>"><?php echo e($a->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>

    <label>Puntuación 1-5:</label>
    <input type="number" name="rating" min="1" max="5" value="5" required>
    <br><br>

    <label>Comentario:</label><br>
    <textarea name="comment" rows="5" cols="40" required></textarea>
    <br><br>

    <button type="submit">Publicar Reseña</button>
</form>

<br>
<a href="<?php echo e(route('reviews.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/reviews/create.blade.php ENDPATH**/ ?>