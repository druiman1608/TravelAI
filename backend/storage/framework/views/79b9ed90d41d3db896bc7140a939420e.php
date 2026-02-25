<h1>Detalles del Vuelo</h1>
<p><strong>ID:</strong> <?php echo e($flight->id); ?></p>
<p><strong>Aerolinea:</strong> <?php echo e($flight->airline); ?></p>
<p><strong>Ruta:</strong> <?php echo e($flight->origin); ?> -> <?php echo e($flight->location->city); ?></p>
<p><strong>Salida:</strong> <?php echo e($flight->departure); ?></p>
<p><strong>Llegada:</strong> <?php echo e($flight->arrival); ?></p>
<p><strong>Precio:</strong> <?php echo e($flight->price); ?>€</p>

<?php if(auth()->user()->isAdmin()): ?>
<p><a href="<?php echo e(route('flights.edit', $flight->id)); ?>">Editar vuelo</a></p>
<?php endif; ?>
<a href="<?php echo e(route('flights.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/flights/show.blade.php ENDPATH**/ ?>