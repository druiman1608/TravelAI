<h1>Historial de conversaciones IA:</h1>
<p><a href="<?php echo e(route('dashboard')); ?>">Volver al Dashboard</a></p>
<hr>
<br>
<?php echo $__env->make('aichatlogs._list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/aichatlogs/index.blade.php ENDPATH**/ ?>