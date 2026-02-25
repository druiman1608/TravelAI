<h1>Editar Reseña</h1>

<form action="<?php echo e(route('reviews.update', $review->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <?php if(auth()->user()->isAdmin() || auth()->user()->isMod()): ?>
    <label>Estado:</label>
    <select name="status">
        <option value="pendiente" <?php echo e($review->status == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
        <option value="publicada" <?php echo e($review->status == 'publicada' ? 'selected' : ''); ?>>Publicada</option>
        <option value="borrada" <?php echo e($review->status == 'borrada' ? 'selected' : ''); ?>>Borrada</option>
    </select>
    <br><br>
    <?php endif; ?>

    <label>Puntuacion:</label>
    <input type="number" name="rating" min="1" max="5" value="<?php echo e($review->rating); ?>">
    <br><br>

    <label>Comentario:</label><br>
    <textarea name="comment" rows="5" cols="40"><?php echo e($review->comment); ?></textarea>
    <br><br>

    <button type="submit">Guardar cambios</button>
</form><?php /**PATH /var/www/resources/views/reviews/edit.blade.php ENDPATH**/ ?>