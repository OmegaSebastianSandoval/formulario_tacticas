<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>"  data-bs-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->ingreso_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->ingreso_id; ?>" />
			<?php }?>
			<div class="row">
				<input type="hidden" name="ingreso_fecha_ingreso"  value="<?php echo $this->content->ingreso_fecha_ingreso ?>">
				<div class="col-12 form-group">
					<label for="ingreso_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_nombre; ?>" name="ingreso_nombre" id="ingreso_nombre" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_fecha_nacimiento"  class="control-label">Fecha nacimiento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-calendar-alt"></i></span>
						</div>
					<input type="text" value="<?php if($this->content->ingreso_fecha_nacimiento){ echo $this->content->ingreso_fecha_nacimiento; } else { echo date('Y-m-d'); } ?>" name="ingreso_fecha_nacimiento" id="ingreso_fecha_nacimiento" class="form-control"  required data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="es"  >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_lugar_nacimiento"  class="control-label">Lugar nacimiento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_lugar_nacimiento; ?>" name="ingreso_lugar_nacimiento" id="ingreso_lugar_nacimiento" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_cedula"  class="control-label">C&eacute;dula</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_cedula; ?>" name="ingreso_cedula" id="ingreso_cedula" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_nacionalidad"  class="control-label">Nacionalidad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_nacionalidad; ?>" name="ingreso_nacionalidad" id="ingreso_nacionalidad" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_direccion_casa"  class="control-label">Direcci&oacute;n casa</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_direccion_casa; ?>" name="ingreso_direccion_casa" id="ingreso_direccion_casa" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_telefono"  class="control-label">Tel&eacute;fono</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_telefono; ?>" name="ingreso_telefono" id="ingreso_telefono" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_telefono_casa"  class="control-label">Tel&eacute;fono casa</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_telefono_casa; ?>" name="ingreso_telefono_casa" id="ingreso_telefono_casa" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_email"  class="control-label">Email</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_email; ?>" name="ingreso_email" id="ingreso_email" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_estado_civil"  class="control-label">Estado civil</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_estado_civil; ?>" name="ingreso_estado_civil" id="ingreso_estado_civil" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_nombre_pareja"  class="control-label">Nombre de la pareja</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_nombre_pareja; ?>" name="ingreso_nombre_pareja" id="ingreso_nombre_pareja" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
		<div class="col-12 form-group">
			<label   class="control-label">Carnet blanco (Si, No)</label>
				<input type="checkbox" name="ingreso_carnet_blanco" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'ingreso_carnet_blanco') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-12 form-group">
					<label for="ingreso_numero_hijos"  class="control-label">N&uacute;mero de hijos</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_numero_hijos; ?>" name="ingreso_numero_hijos" id="ingreso_numero_hijos" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_numero_seguro_social"  class="control-label">N&uacute;mero del seguro social</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_numero_seguro_social; ?>" name="ingreso_numero_seguro_social" id="ingreso_numero_seguro_social" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_hobby" class="form-label" >Hobby</label>
					<textarea name="ingreso_hobby" id="ingreso_hobby"   class="form-control tinyeditor" rows="10"   ><?= $this->content->ingreso_hobby; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_edad"  class="control-label">Edad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_edad; ?>" name="ingreso_edad" id="ingreso_edad" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label class="control-label">Sexo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="ingreso_sexo"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_ingreso_sexo AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"ingreso_sexo") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
		<div class="col-12 form-group">
			<label   class="control-label">Carnet verde (Si, No)</label>
				<input type="checkbox" name="ingreso_carnet_verde" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'ingreso_carnet_verde') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
		<div class="col-12 form-group">
			<label   class="control-label">Afiliado al seguro social (Si, No)</label>
				<input type="checkbox" name="ingreso_afiliado_seguro_social" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'ingreso_afiliado_seguro_social') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-12 form-group">
					<label for="ingreso_nombre_madre"  class="control-label">Nombre de la madre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_nombre_madre; ?>" name="ingreso_nombre_madre" id="ingreso_nombre_madre" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_telefono_madre"  class="control-label">Tel&eacute;fono de la madre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_telefono_madre; ?>" name="ingreso_telefono_madre" id="ingreso_telefono_madre" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_nombre_padre"  class="control-label">Nombre del padre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_nombre_padre; ?>" name="ingreso_nombre_padre" id="ingreso_nombre_padre" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="ingreso_telefono_padre"  class="control-label">Tel&eacute;fono del padre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingreso_telefono_padre; ?>" name="ingreso_telefono_padre" id="ingreso_telefono_padre" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label class="control-label">Vive en casa</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="ingreso_vive_casa"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_ingreso_vive_casa AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"ingreso_vive_casa") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="ingreso_fecha_solicitud"  value="<?php echo $this->content->ingreso_fecha_solicitud ?>">
				<input type="hidden" name="ingreso_estado_solicitud"  value="<?php echo $this->content->ingreso_estado_solicitud ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>