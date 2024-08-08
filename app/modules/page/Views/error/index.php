<div class="container contenedor-error h-100 d-flex justify-content-center align-items-center">
    <?php if ($this->error) { ?>
        <div class="alert alert-<?= $this->tipo ?>  w-100 text-center" role="alert">
            <?= $this->error ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger w-100 text-center" role="alert">
            Ha ocurrido un error inesperado.
        </div>
    <?php } ?>
</div>

<style>
    .main-general {
        min-height: calc(100dvh - 125px);

    }
    .contenedor-error{
        min-height: calc(100dvh - 225px);

    }
</style>