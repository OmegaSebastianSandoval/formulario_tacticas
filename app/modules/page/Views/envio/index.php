<div class="container contenedor-error h-100 d-flex justify-content-center align-items-center">
    <?php if ($this->estado == 1) { ?>
        <div class="alerta alerta-success  text-center shadow-sm " role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <div>

                <span class="titulo-alerta">Solicitud de <br> Ingreso de Personal</span>
            </div>

            <div class="mensaje mt-4">
                <p>La solicitud de ingreso ha sido enviada correctamente, pronto recibirá una respuesta a su solicitud.</p>
            </div>
        </div>
    <?php } else if ($this->estado == 2) { ?>
        <div class="alerta alerta-danger  text-center shadow-sm" role="alert">
            <i class="fa-solid fa-circle-xmark"></i>
            <div>
                <span class="titulo-alerta">Solicitud de <br> Ingreso de Personal</span>
            </div>
            <div class="mensaje mt-4">
                <p>La solicitud de ingreso no ha podido ser enviada, por favor intente nuevamente.</p>
                

            <!-- La solicitud de ingreso no ha podido ser enviada, por favor intente nuevamente. -->
        </div>
    <?php } else { ?>
        <div class="alerta alerta-danger  text-center shadow-sm" role="alert">
            <i class="fa-solid fa-circle-xmark"></i>
            <div>
                <span class="titulo-alerta">Solicitud de <br> Ingreso de Personal</span>
            </div>
            <div class="mensaje mt-4">
                <p>Ha ocurrido un error inesperado.</p>
            </div>

        </div>
    <?php } ?>
</div>

<style>
    .main-general {
        min-height: calc(100dvh - 125px);
    }

    .contenedor-error {
        min-height: calc(100dvh - 225px);
    }

</style>