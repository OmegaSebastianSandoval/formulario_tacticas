<div class="container contenedor-error h-100 d-flex justify-content-center align-items-center">
    <?php if ($this->error) { ?>
        <div class="alerta alerta-<?= $this->tipo ?>   text-center shadow-sm" role="alert">
            <?php if ($this->tipo === 'success') { ?>

                <i class="fa-solid fa-circle-check"></i>
            <?php } else if ($this->tipo === 'warning') { ?>
                <i class="fa-solid fa-triangle-exclamation"></i>
            <?php } else { ?>
                <i class="fa-solid fa-circle-xmark"></i>
            <?php } ?>
            <div>

                <span class="titulo-alerta">Solicitud de <br> Ingreso de Personal</span>
            </div>

            <div class="mensaje mt-4">
                <p> <?= $this->error ?></p>
            </div>
        </div>
    <?php } else { ?>
        <div class="alerta alerta-danger  text-center shadow-sm" role="alert">

            <i class="fa-solid fa-circle-xmark"></i>

            <div>

                <span class="titulo-alerta">Solicitud de <br> Ingreso de Personal</span>
            </div>

            <div class="mensaje mt-5">
                <p> Ha ocurrido un error inesperado. </p>
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