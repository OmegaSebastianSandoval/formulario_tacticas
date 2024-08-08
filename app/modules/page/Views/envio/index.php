<div class="container contenedor-error h-100 d-flex justify-content-center align-items-center">
    <?php if ($this->estado == 1) { ?>
        <div class="alert alert-success  w-100 text-center" role="alert">
            La solicitud de ingreso ha sido enviada correctamente, pronto recibirá una respuesta a su solicitud.
        </div>
    <?php } else if ($this->estado == 2) { ?>
        <div class="alert alert-danger  w-100 text-center" role="alert">
            La solicitud de ingreso no ha podido ser enviada, por favor intente nuevamente.
        </div>
    <?php } else { ?>
        <div class="alert alert-warning w-100 text-center" role="alert">
            Ha ocurrido un error inesperado.
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