<h1>Editar Reseña</h1>

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
        <label>Comentario:</label><br>
        <textarea name="comment" rows="5" cols="40" <?php echo e(auth()->user()->isMod() ? 'readonly' : ''); ?>

            <?php echo e((auth()->user()->isAdmin() || !auth()->user()->isMod()) ? '' : 'readonly'); ?>><?php echo e($review->comment); ?></textarea>
    </div>
    <br>

    <?php if(auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
    <div>
        <label>Estado de la Reseña [Moderación]:</label><br>
        <select name="status">
            <option value="pendiente" <?php echo e($review->status == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
            <option value="aprobada" <?php echo e($review->status == 'aprobada' ? 'selected' : ''); ?>>Aprobada</option>
            <option value="rechazada" <?php echo e($review->status == 'rechazada' ? 'selected' : ''); ?>>Rechazada</option>
        </select>
    </div>
    <br>
    <button type="submit">Guardar Cambios</button>
    <?php else: ?>
    <p>Estado actual: <strong><?php echo e(ucfirst($review->status)); ?></strong></p>

    <?php if($review->status !== 'cancelada'): ?>
    <input type="hidden" name="status" value="cancelada">
    <button type="submit" onclick="return confirm('¿Seguro que quieres cancelar esta reseña?')">Eliminar Reseña</button>
    <?php endif; ?>
    <?php endif; ?>
</form>

<br>
<a href="<?php echo e(route('reviews.index')); ?>">Cancelar y volver</a><?php /**PATH /var/www/resources/views/reviews/edit.blade.php ENDPATH**/ ?>