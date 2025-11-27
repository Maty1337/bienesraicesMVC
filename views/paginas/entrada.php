<main class="contenedor seccion contenido-centrado">
    <h1><?php echo s($entrada->titulo); ?></h1>



    <picture>
        <source srcset="/imagenes/<?php echo s($entrada->imagen); ?>" type="image/webp">
        <source srcset="/imagenes/<?php echo s($entrada->imagen); ?>" type="image/jpeg">
        <img loading="lazy" src="/imagenes/<?php echo s($entrada->imagen); ?>" alt="Imagen blog">
    </picture>


     <p class="informacion-meta">
        Escrito el: <span><?php echo s($entrada->fecha_publicacion); ?></span> por: <span><?php echo s($entrada->autor); ?></span>
    </p>
    <div class="resumen-blog">
        <p><?php echo nl2br(s($entrada->contenido)); ?></p>
    </div>
</main>

