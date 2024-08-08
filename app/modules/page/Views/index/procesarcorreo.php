<div class="container contenedor-formulario mt-3 mb-5 ">
    <h3>PROCESAR CORREO</h3>
    <form action="/page/index/procesarcorreo" class="mt-3" method="post">

        <div class="row ">

            <?php if ($this->error) { ?>
                <div class="alert alert-<?= $this->tipo ?>" role="alert">
                    <?= $this->error ?>
                </div>
            <?php } ?>
            <div class="col-12 col-md-9 form-group">
                <label for="email" class="control-label">Correo</label>
                <label class="input-group">

                    <input type="email" name="email" id="email" class="form-control" required>
                    <input type="hidden" name="token" value="<?= $this->token_encoded ?>">

                </label>
            </div>
            <div class="col-12 col-md-3 form-group d-flex align-items-center justify-content-md-center justify-content-center">
                <div class="botones-acciones m-md-0 ">
                    <button class="btn btn-guardar" type="submit">Enviar</button>
                    <!-- <a href="/page/ingreso" class="btn btn-cancelar">Cancelar</a> -->
                </div>
            </div>
        </div>
    </form>
</div>