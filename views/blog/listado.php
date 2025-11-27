<?php
use Model\Entrada;

$entradas = Entrada::get($limite ?? null); // Usa el límite si está definido
?>


<main class="contenedor seccion contenido-centrado">

    <?php foreach($entradas as $entrada): ?>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="/imagenes/<?php echo $entrada->imagen; ?>" type="image/webp">
                    <source srcset="/imagenes/<?php echo $entrada->imagen; ?>" type="image/jpeg">
                    <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $entrada->id; ?>">
                    <h4><?php echo s($entrada->titulo); ?></h4>
                    <p>Escrito el: <span><?php echo $entrada->fecha_publicacion; ?></span> por: <span><?php echo s($entrada->autor); ?></span></p>

                    <p><?php echo s($entrada->resumen); ?></p>
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</main>
