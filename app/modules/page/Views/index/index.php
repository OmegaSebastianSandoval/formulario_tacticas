<?php

$nuevafecha = strtotime('-18 year', strtotime(date('Y-m-d')));
$nuevafecha = date('Y-m-d', $nuevafecha);

$maxFechaFinTrabajo = strtotime('+30 day', strtotime(date('Y-m-d')));
$maxFechaFinTrabajo = date('Y-m-d', $maxFechaFinTrabajo);
echo $maxFechaFinTrabajo;

$maxFechaInicioTrabajo = strtotime('-1 day', strtotime(date('Y-m-d')));
$maxFechaInicioTrabajo = date('Y-m-d', $maxFechaInicioTrabajo);
echo $maxFechaInicioTrabajo
?>
<div class="container contenedor-formulario mt-3 mb-5 ">
    <span class="label-fecha">Fecha de ingreso: <span><?= date("Y-m-d H:m:s") ?></span></span>
    <h3>INFORMACIÓN DEL COLABORADOR</h3>
    <form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-bs-toggle="validator" id="form-ingreso">
        <div class="content-dashboard">

            <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
            <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">

        


            <div class="row">
                <input type="hidden" name="ingreso_fecha_ingreso" value="<?= date("Y-m-d H:m:s") ?>">
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_nombre" class="control-label">Nombres</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_nombre" id="ingreso_nombre" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_apellido" class="control-label">Apellidos</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_apellido" id="ingreso_apellido" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_fecha_nacimiento" class="control-label">Fecha nacimiento</label>
                    <label class="input-group">

                        <input type="date" name="ingreso_fecha_nacimiento" id="ingreso_fecha_nacimiento" class="form-control" required max="<?= $nuevafecha ?>">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_lugar_nacimiento" class="control-label">Lugar nacimiento</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_lugar_nacimiento" id="ingreso_lugar_nacimiento" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <div class="tooltip1">
                        <div class="tooltiptext">Esta cédula ya se encuentra registrada</div>
                    </div>

                    <label for="ingreso_cedula" class="control-label">C&eacute;dula</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_cedula" id="ingreso_cedula" class="form-control" maxlength="24" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_nacionalidad" class="control-label">Nacionalidad</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_nacionalidad" id="ingreso_nacionalidad" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_direccion_casa" class="control-label">Direcci&oacute;n casa</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_direccion_casa" id="ingreso_direccion_casa" class="form-control" required maxlength="255">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_telefono" class="control-label">Tel&eacute;fono</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_telefono" id="ingreso_telefono" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_telefono_casa" class="control-label">Tel&eacute;fono casa</label>
                    <label class="input-group">

                        <input type="number" name="ingreso_telefono_casa" id="ingreso_telefono_casa" class="form-control">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 form-group">
                    <label for="ingreso_email" class="control-label">Email</label>
                    <label class="input-group">

                        <input type="email" name="ingreso_email" id="ingreso_email" class="form-control" required maxlength="30">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_estado_civil" class="control-label">Estado civil</label>
                    <label class="input-group">


                        <select class="form-control" id="ingreso_estado_civil" name="ingreso_estado_civil" required>
                            <option value="" selected disabled>Seleccione...</option>
                            <?php foreach ($this->list_ingreso_estado_civil as $key => $value) { ?>
                                <option value="<?php echo $key; ?>" /> <?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div id="contenedor-input-pareja" class="col-12 col-md-6 col-lg-2 form-group d-none">
                    <label for="ingreso_nombre_pareja" class="control-label">Nombre de la pareja</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_nombre_pareja" id="ingreso_nombre_pareja" class="form-control">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">


                    <label class="control-label">Carnet blanco (Si, No)</label>
                    <br>

                    <input type="checkbox" name="ingreso_carnet_blanco" value="1" class="form-control switch-form "></input>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_numero_hijos" class="control-label">N&uacute;mero de hijos</label>
                    <label class="input-group">

                        <input type="number" min="0" value="0" max="15" name="ingreso_numero_hijos" id="ingreso_numero_hijos" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_numero_seguro_social" class="control-label">N&uacute;mero del seguro social</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_numero_seguro_social" id="ingreso_numero_seguro_social" class="form-control" maxlength="45">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_edad" class="control-label">Edad</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_edad" id="ingreso_edad" class="form-control" readonly>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label class="control-label">Sexo</label>
                    <label class="input-group">

                        <select class="form-control" name="ingreso_sexo" required>
                            <option value="" selected disabled>Seleccione...</option>
                            <?php foreach ($this->list_ingreso_sexo as $key => $value) { ?>
                                <option value="<?php echo $key; ?>" /> <?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label class="control-label">Carnet verde<br> (Si, No)</label>
                    <br>
                    <input type="checkbox" name="ingreso_carnet_verde" value="1" class="form-control switch-form "></input>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label class="control-label">Afiliado al seguro<br> social (Si, No)</label>
                    <br>

                    <input type="checkbox" name="ingreso_afiliado_seguro_social" value="1" class="form-control switch-form "></input>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 form-group">
                    <label for="ingreso_nombre_madre" class="control-label">Nombre de la madre</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_nombre_madre" id="ingreso_nombre_madre" class="form-control">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_telefono_madre" class="control-label">Tel&eacute;fono de la madre</label>
                    <label class="input-group">

                        <input type="number" name="ingreso_telefono_madre" id="ingreso_telefono_madre" class="form-control">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 form-group">
                    <label for="ingreso_nombre_padre" class="control-label">Nombre del padre</label>
                    <label class="input-group">

                        <input type="text" name="ingreso_nombre_padre" id="ingreso_nombre_padre" class="form-control">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label for="ingreso_telefono_padre" class="control-label">Tel&eacute;fono del padre</label>
                    <label class="input-group">

                        <input type="number" name="ingreso_telefono_padre" id="ingreso_telefono_padre" class="form-control">
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 form-group">
                    <label class="control-label">Vive en casa</label>
                    <label class="input-group">

                        <select class="form-control" name="ingreso_vive_casa" required>
                            <option value="">Seleccione...</option>
                            <?php foreach ($this->list_ingreso_vive_casa as $key => $value) { ?>
                                <option value="<?php echo $key; ?>" /> <?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-lg-6 form-group">
                    <label for="ingreso_hobby" class="form-label">Hobby</label>
                    <textarea name="ingreso_hobby" id="ingreso_hobby" class="form-control" rows="3"></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <!-- <input type="hidden" name="ingreso_fecha_solicitud" value="">
                <input type="hidden" name="ingreso_estado_solicitud" value=""> -->
            </div>
            <hr>

        </div>

        <h4>DEPENDIENTES</h4>
        <div class="content-dashboard">

            <div class="row">
                <div class="col-12 col-md-6 form-group">
                    <label for="dependiente_nombre[]" class="control-label">Nombre</label>
                    <label class="input-group">

                        <input type="text" name="dependiente_nombre[]" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-5 form-group">
                    <label for="dependiente_parentesco[]" class="control-label">Parentesco</label>
                    <label class="input-group">

                        <input type="text" name="dependiente_parentesco[]" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>



            </div>
            <div id="campos" class=""></div>
            <div class="d-flex justify-content-center mb-4">
                <a href="javascript:void(0);" onclick="AgregarCampos(event)" class="btn btn-outline-dark">Incluir más personas</a>
            </div>
            <hr>
        </div>


        <h4>CON QUIENES VIVE</h4>
        <div class="content-dashboard">

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 form-group">
                    <label for="vive_con_nombre[]" class="control-label">Nombre</label>
                    <label class="input-group">

                        <input type="text" name="vive_con_nombre[]" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-4  form-group">
                    <label for="vive_con_parentesco[]" class="control-label">Parentesco</label>
                    <label class="input-group">

                        <input type="text" name="vive_con_parentesco[]" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-3  form-group">
                    <label for="vive_con_telefono[]" class="control-label">Teléfono</label>
                    <label class="input-group">

                        <input type="text" name="vive_con_telefono[]" class="form-control validar-telefono" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>



            </div>
            <div id="camposvivcecon" class=""></div>
            <div class="d-flex justify-content-center mb-4">
                <a href="javascript:void(0);" onclick="AgregarCamposViveCon(event)" class="btn btn-outline-dark">Incluir más personas</a>
            </div>
            <hr>
        </div>

        <h4>FORMACION ACADÉMICA</h4>
        <div class="content-dashboard">

            <div class="row">
                <div class="col-12 col-md-11  form-group">
                    <label for="datos_academicos_formacion[]" class="control-label">Título</label>
                    <label class="input-group">

                        <input type="text" name="datos_academicos_formacion[]" class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div id="camposformacion" class=""></div>
            <div class="d-flex justify-content-center mb-4">
                <a href="javascript:void(0);" onclick="AgregarCamposFormacion(event)" class="btn btn-outline-dark">Incluir más formación</a>
            </div>
            <hr>
        </div>


        <h4>DATOS LABORALES</h4>
        <div class="content-dashboard">

            <div class="row">
                <div class="col-12 col-md-3 col-lg-2 form-group">
                    <label for="datos_laborales_empleo[]" class="control-label">Cargo</label>
                    <label class="input-group">

                        <input type="text" name="datos_laborales_empleo[]" class="form-control" required>
                    </label>

                </div>
                <div class="col-12 col-md-3 col-lg-2 form-group">
                    <label for="datos_laborales_fecha_inicio[]" class="control-label  " >Fecha de inicio</label>
                    <label class="input-group">

                        <input type="date" name="datos_laborales_fecha_inicio[]" class="form-control fecha-inicio" required max="<?= $maxFechaInicioTrabajo?>">
                    </label>
                </div>
                <div class="col-12 col-md-3 col-lg-2 form-group">
                    <label for="datos_laborales_fecha_fin[]" class="control-label">Fecha de salida</label>
                    <label class="input-group">

                        <input type="date" name="datos_laborales_fecha_fin[]" class="form-control  fecha-fin"  max="<?= $maxFechaFinTrabajo?>" required>
                    </label>
                </div>
                <div class="col-12 col-md-3 col-lg-6 form-group">
                    <label for="datos_laborales_motivo_retiro[]" class="control-label">Motivo de salida</label>
                    <label class="input-group">

                        <textarea name="datos_laborales_motivo_retiro[]" class="form-control" required ></textarea>
                    </label>
                </div>


            </div>
            <div id="camposlaborales" class=""></div>
            <div class="d-flex justify-content-center mb-4">
                <a href="javascript:void(0);" onclick="AgregarCamposLaborales(event)" class="btn btn-outline-dark">Incluir más datos laborales</a>
            </div>
            <hr>
        </div>


        <div class="d-fleX justify-content-center">
            <div class="g-recaptcha" data-sitekey="6LfFDZskAAAAAE2HmM7Z16hOOToYIWZC_31E61Sr"></div>
        </div>

        <div class="botones-acciones mt-3 d-flex justify-content-center">
            <button class="btn btn-guardar" type="submit">Enviar</button>
        </div>
    </form>
</div>

<script>
    function AgregarCampos(event) {
        event.preventDefault();
        const campo = document.createElement('div');
        campo.className = 'row';
        campo.innerHTML = `
        <div class="col-12 col-md-6 form-group">
            <label for="nombres_familia">Nombres</label>
            <input type="text" class="form-control" name="dependiente_nombre[]" required>
        </div>
        <div class="col-9 col-md-5 form-group">
            <label for="apellidos_familia">Parentesco</label>
            <input type="text" class="form-control" name="dependiente_parentesco[]" required>
        </div>
        <div class="col-3 col-md-1 d-flex justify-content-center align-items-center">
            <button type="button" title="Eliminar campos" class="btn btn-danger btn-sm" onclick="EliminarCampo(this)">X</button>
        </div>
    `;
        document.getElementById("campos").appendChild(campo);
    }

    function AgregarCamposViveCon(event) {
        event.preventDefault();
        const campo = document.createElement('div');
        campo.className = 'row';
        campo.innerHTML = `
         <div class="col-12 col-md-6 col-lg-4 form-group">
                    <label for="vive_con_nombre[]" class="control-label">Nombre</label>
                    <label class="input-group">
                        <input type="text" name="vive_con_nombre[]" class="form-control" required >
                    </label>
                </div>
                <div class="col-12 col-md-6 col-lg-4  form-group">
                    <label for="vive_con_parentesco[]" class="control-label">Parentesco</label>
                    <label class="input-group">
                        <input type="text" name="vive_con_parentesco[]" class="form-control" required >
                    </label>
                </div>
                <div class="col-10 col-md-6 col-lg-3  form-group">
                    <label for="vive_con_telefono[]" class="control-label">Teléfono</label>
                    <label class="input-group">

                        <input type="text" name="vive_con_telefono[]" class="form-control validar-telefono"  required>
                    </label>
                </div>
                <div class="col-2 col-md-1 d-flex justify-content-center align-items-center">
            <button type="button" title="Eliminar campos" class="btn btn-danger btn-sm" onclick="EliminarCampo(this)">X</button>
        </div>
    `;
        document.getElementById("camposvivcecon").appendChild(campo);
    }

    function AgregarCamposFormacion(event) {
        event.preventDefault();
        const campo = document.createElement('div');
        campo.className = 'row';
        campo.innerHTML = `
         <div class="col-11 col-md-11  form-group">
                    <label for="datos_academicos_formacion[]" class="control-label">Título</label>
                    <label class="input-group">
                        <input type="text" name="datos_academicos_formacion[]" class="form-control" required >
                    </label>
                </div>
                
                <div class="col-1  d-flex justify-content-center align-items-center">
            <button type="button" title="Eliminar campos" class="btn btn-danger btn-sm" onclick="EliminarCampo(this)">X</button>
        </div>
    `;
        document.getElementById("camposformacion").appendChild(campo);
    }

    function AgregarCamposLaborales(event) {
        event.preventDefault();
        const campo = document.createElement('div');
        campo.className = 'row';
        campo.innerHTML = `
                <div class="col-12 col-md-3 col-lg-2 form-group">
                    <label for="datos_laborales_empleo[]" class="control-label">Cargo</label>
                    <label class="input-group">
                        <input type="text" name="datos_laborales_empleo[]" class="form-control">
                    </label>
                    
                </div>
                <div class="col-12 col-md-3 col-lg-2 form-group">
                    <label for="datos_laborales_fecha_inicio[]" class="control-label">Fecha de inicio</label>
                    <label class="input-group">

                        <input type="date" name="datos_laborales_fecha_inicio[]" class="form-control fecha-inicio">
                    </label>                  
                </div>
                <div class="col-12 col-md-3 col-lg-2 form-group">
                    <label for="datos_laborales_fecha_fin[]" class="control-label">Fecha de salida</label>
                    <label class="input-group">

                        <input type="date" name="datos_laborales_fecha_fin[]" class="form-control  fecha-fin">
                    </label>
                </div>
                <div class="col-12 col-md-3 col-lg-6 form-group">
                    <label for="datos_laborales_motivo_retiro[]" class="control-label">Motivo de salida</label>
                    <label class="input-group">

                        <textarea name="datos_laborales_motivo_retiro[]" class="form-control"></textarea>
                    </label>
                </div>

    `;
        document.getElementById("camposlaborales").appendChild(campo);

        const fechaInicio = campo.querySelector('.fecha-inicio');
        const fechaFin = campo.querySelector('.fecha-fin');

        fechaInicio.addEventListener('change', validarFechas);
        fechaFin.addEventListener('change', validarFechas);

        // Establecer el valor máximo permitido para la fecha de fin
        const fechaActual = new Date();
        const maxFechaFin = new Date(fechaActual);
        maxFechaFin.setDate(fechaActual.getDate() + 30);
        fechaFin.setAttribute('max', maxFechaFin.toISOString().split('T')[0]);

    }

    function validarFechas(event) {
        const campo = event.target.closest('.row');
        const fechaInicio = campo.querySelector('.fecha-inicio').value;
        const fechaFin = campo.querySelector('.fecha-fin').value;

        if (fechaInicio) {
            const fechaInicioDate = new Date(fechaInicio);
            campo.querySelector('.fecha-fin').setAttribute('min', fechaInicio);
        }

        if (fechaFin) {
            const fechaFinDate = new Date(fechaFin);
            campo.querySelector('.fecha-inicio').setAttribute('max', fechaFin);
        }

        if (fechaInicio && fechaFin) {
            const fechaInicioDate = new Date(fechaInicio);
            const fechaFinDate = new Date(fechaFin);

            // if (fechaInicioDate > fechaFinDate) {
            //     alert('La fecha de inicio no puede ser mayor a la fecha de fin.');
            //     event.target.value = ''; // Limpiar el valor del campo inválido
            // }
        }
    }

    document.querySelectorAll('.fecha-inicio, .fecha-fin').forEach(input => {
        input.addEventListener('change', validarFechas);
    });

    function EliminarCampo(button) {
        button.parentElement.parentElement.remove();
    }

    const limitarLongitud = (input, maxLength) => {
        input.addEventListener('input', (event) => {
            // Obtener el valor actual del input y eliminar caracteres no numéricos
            let value = event.target.value.replace(/\D/g, '');

            // Si el valor supera la longitud máxima, truncar el valor
            if (value.length > maxLength) {
                value = value.slice(0, maxLength);
            }

            // Actualizar el valor del input
            event.target.value = value;
        });
    };

    // Obtener los inputs por sus IDs
    const inputsTelefono = document.querySelectorAll('#ingreso_telefono, #ingreso_telefono_madre, #ingreso_telefono_padre, .validar-telefono');
    const inputsTelefonoCasa = document.querySelectorAll('#ingreso_telefono_casa');

    // Aplicar la función a cada input
    inputsTelefono.forEach(input => limitarLongitud(input, 14));
    inputsTelefonoCasa.forEach(input => limitarLongitud(input, 12));

</script>