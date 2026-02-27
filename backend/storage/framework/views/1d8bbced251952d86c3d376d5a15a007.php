<h1>Detalle de la consulta #<?php echo e($aiChatLog->id); ?></h1>

<p><strong>Fecha:</strong> <?php echo e($aiChatLog->created_at?->format('d/m/Y H:i:s') ?? 'Fecha no disponible'); ?></p>
<p><strong>Usuario:</strong> <?php echo e($aiChatLog->user?->name ?? 'Usuario no encontrado'); ?></p>
<hr>

<div style="margin-bottom: 20px;">
    <h3 style="color: blue;">Pregunta del Usuario:</h3>
    <div style="background: #f0f0f0; padding: 15px; border-radius: 5px;">
        <?php echo e($aiChatLog->user_question); ?>

    </div>
</div>

<div>
    <h3 style="color: green;">Respuesta de la IA:</h3>
    <div style="background: #e8f5e9; padding: 15px; border-radius: 5px; white-space: pre-wrap;">
        <?php echo e($aiChatLog->ai_answer); ?>

    </div>
</div>

<br>
<a href="<?php echo e(route('aichatlogs.index')); ?>">Volver</a><?php /**PATH /var/www/resources/views/aichatlogs/show.blade.php ENDPATH**/ ?>