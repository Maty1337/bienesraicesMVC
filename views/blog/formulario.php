<fieldset>
    <legend>Información de la Entrada</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="entrada[titulo]" placeholder="Título de la entrada" value="<?php echo s($entrada->titulo); ?>">

    <label for="resumen">Resumen:</label>
    <textarea id="resumen" name="entrada[resumen]" placeholder="Resumen de la entrada"><?php echo s($entrada->resumen); ?></textarea>

    <label for="contenido">Contenido:</label>
    <textarea id="contenido" name="entrada[contenido]" placeholder="Contenido completo"><?php echo s($entrada->contenido); ?></textarea>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="entrada[autor]" placeholder="Autor" value="<?php echo s($entrada->autor); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="entrada[imagen]">

    <?php if($entrada->imagen): ?>
        <p>Imagen actual:</p>
        <img src="/imagenes/<?php echo $entrada->imagen; ?>" class="imagen-small">
    <?php endif; ?>
</fieldset>
