<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>

            <img loading="lazy" src="/Imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">
       

        <div class="resumen-propiedad">
            <p class="precio">$ <?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
    <li>
        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono baños">
        <span class="cantidad"><?php echo $propiedad->wc; ?></span>
        <span class="etiqueta">Baños</span>
    </li>

    <li>
        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
        <span class="cantidad"><?php echo $propiedad->estacionamiento; ?></span>
        <span class="etiqueta">Cochera</span>
    </li>

    <li>
        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
        <span class="cantidad"><?php echo $propiedad->habitaciones; ?></span>
        <span class="etiqueta">Habitaciones</span>
    </li>
</ul>


            <p><?php echo $propiedad->descripcion; ?></p>
        </div>
    </main>