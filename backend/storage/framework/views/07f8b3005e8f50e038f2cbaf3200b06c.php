<h1>Detalles: <?php echo e($hotel->name); ?></h1>

<p><strong>ID:</strong> <?php echo e($hotel->id); ?></p>
<p><strong>Nombre:</strong> <?php echo e($hotel->name); ?></p>
<p><strong>Descripción:</strong> <?php echo e($hotel->description); ?></p>
<p><strong>Estrellas:</strong> <?php echo e($hotel->stars); ?></p>
<p><strong>Ubicación:</strong> <?php echo e($hotel->location->city); ?>, <?php echo e($hotel->location->country); ?></p>
<p><strong>Precio por noche:</strong> <?php echo e($hotel->price_per_night); ?></p>
<br>
<p><a href="<?php echo e(route('hotels.edit', $hotel->id)); ?>">Editar hotel</a></p>
<br>
<a href="<?php echo e(route('hotels.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/hotels/show.blade.php ENDPATH**/ ?>