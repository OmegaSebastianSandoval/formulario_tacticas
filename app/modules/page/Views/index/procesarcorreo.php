<div class="container contenedor-formulario mt-3 mb-5 mx-auto ">
    <div class=" d-flex justify-content-start ">
        <h3 class="my-0"> <i class="fa-solid fa-envelope" title="Ingreso"></i>
            Validar Correo</h3>
    </div>
    <form action="/page/index/procesarcorreo" class="mt-3" method="post">
        <input type="hidden" name="token" value="<?= $this->token_encoded ?>">

        <div class="row ">

            <?php if ($this->error) { ?>
                <div class="alert alert-<?= $this->tipo ?>" role="alert">
                    <?= $this->error ?>
                </div>
            <?php } ?>
            <div class="col-10 col-md-10 form-group">
                <label for="email" class="control-label">Correo</label>
                <label class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-icono  fondo-verde "><i class="fa-solid fa-envelope"></i></span>
                    </div>
                    <input type="email" name="email" id="email" class="form-control" required>
                </label>
                <div class="help-block with-errors"></div>
            </div>
            <div class="col-12 col-md-2 form-group d-flex align-items-end justify-content-md-center justify-content-end">
                <div class="botones-acciones m-md-0 w-100 ">
                    <button class="btn btn-guardar w-100" type="submit">Enviar</button>
                    <!-- <a href="/page/ingreso" class="btn btn-cancelar">Cancelar</a> -->
                </div>
            </div>
        </div>
    </form>
</div>