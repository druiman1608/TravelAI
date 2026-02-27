<h1>Editar Reseña</h1>

<?php if($errors->any()): ?>
<div
    style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fca5a5;">
    <strong>Problemas con los datos:</strong>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?php echo e(route('reviews.update', $review->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div>
        <label>Reseña sobre:</label><br>
        <strong>
            <?php if($review->hotel_id): ?> Hotel: <?php echo e($review->hotel->name); ?>

            <?php elseif($review->flight_id): ?> Vuelo: <?php echo e($review->flight->airline); ?>

            <?php elseif($review->activity_id): ?> Actividad: <?php echo e($review->activity->name); ?>

            <?php elseif($review->package_id): ?> Paquete: <?php echo e($review->package->name); ?>

            <?php else: ?> Elemento no encontrado
            <?php endif; ?>
        </strong>
    </div>
    <br>

    <div>
        <label>Puntuación (1-5):</label><br>
        <input type="number" name="rating" min="1" max="5" value="<?php echo e($review->rating); ?>"
            <?php echo e(auth()->user()->isMod() ? 'readonly' : ''); ?> required>
    </div>
    <br>

    <div>
        <label>Comentario:</label><br>
        <textarea name="comment" rows="5" cols="40" <?php echo e(auth()->user()->isMod() ? 'readonly' : ''); ?>

            required><?php echo e($review->comment); ?></textarea>
    </div>
    <br>

    <?php if(auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
    <div>
        <label>Estado de la Reseña [Moderacion]:</label><br>
        <select name="status">
            <option value="pendiente" <?php echo e($review->status == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
            <option value="publicada" <?php echo e($review->status == 'publicada' ? 'selected' : ''); ?>>Publicada [Aprobada]
            </option>
            <option value="borrada" <?php echo e($review->status == 'borrada' ? 'selected' : ''); ?>>Borrada [Rechazada]</option>
        </select>
    </div>
    <br>
    <button type="submit"
        style="background-color: #2b6cb0; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">
        Guardar Cambios de Moderacion
    </button>
    <?php else: ?>
    <p>Estado actual: <strong><?php echo e(ucfirst($review->status)); ?></strong></p>

    <?php if($review->status !== 'borrada'): ?>
    <input type="hidden" name="status" value="<?php echo e($review->status); ?>">
    <button type="submit"
        style="background-color: #38a169; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">
        Actualizar mi comentario
    </button>
    <hr>
    <button type="submit" name="status" value="borrada"
        style="background-color: #e53e3e; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;"
        onclick="return confirm('¿Seguro que quieres eliminar esta reseña?')">
        Eliminar Reseña
    </button>
    <?php endif; ?>
    <?php endif; ?>
</form>

<br>
<a href="<?php echo e(route('reviews.index')); ?>" style="text-decoration: none; color: #4a5568;">← Cancelar y volver</a><?php /**PATH /var/www/resources/views/reviews/edit.blade.php ENDPATH**/ ?>