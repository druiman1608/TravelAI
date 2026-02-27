<h1>Reseña #<?php echo e($review->id); ?></h1>

<p><strong>Autor:</strong> <?php echo e($review->user->name); ?></p>
<p><strong>Servicio:</strong>
    <?php if($review->package): ?> <?php echo e($review->package->name); ?> Paquete
    <?php elseif($review->hotel): ?> <?php echo e($review->hotel->name); ?> Hotel
    <?php elseif($review->flight): ?> <?php echo e($review->flight->airline); ?> Vuelo
    <?php endif; ?>
</p>
<p><strong>Puntuacion:</strong> <?php echo e($review->rating); ?> de 5</p>
<p><strong>Comentario:</strong> <?php echo e($review->comment); ?></p>
<p><strong>Estado:</strong> <?php echo e($review->status); ?></p>

<br>
<a href="<?php echo e(route('reviews.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/reviews/show.blade.php ENDPATH**/ ?>