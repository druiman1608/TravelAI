<h1>Detalles del Hotel: <?php echo e($hotel->name); ?></h1>

<p><strong>ID:</strong> <?php echo e($hotel->id); ?></p>
<p><strong>Estrellas:</strong> <?php echo e($hotel->stars); ?></p>
<p><strong>Ubicacion:</strong> <?php echo e($hotel->location->city); ?>, <?php echo e($hotel->location->country); ?></p>
<p><strong>Precio por noche:</strong> <?php echo e($hotel->price_per_night); ?>€</p>
<p><strong>Descripcion:</strong></p>
<p><?php echo e($hotel->description); ?></p>

<br>
<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('hotels.edit', $hotel->id)); ?>">Editar hotel</a></p>
<?php endif; ?>

<br>
<a href="<?php echo e(route('hotels.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/hotels/show.blade.php ENDPATH**/ ?>