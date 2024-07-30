<?php 
/**
* clase que genera la insercion y edicion  de ingreso en la base de datos
*/
class Page_Model_DbTable_Ingreso extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'ingreso';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'ingreso_id';

	/**
	 * insert recibe la informacion de un ingreso y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$ingreso_fecha_ingreso = $data['ingreso_fecha_ingreso'];
		$ingreso_nombre = $data['ingreso_nombre'];
		$ingreso_apellido = $data['ingreso_apellido'];
		$ingreso_fecha_nacimiento = $data['ingreso_fecha_nacimiento'];
		$ingreso_lugar_nacimiento = $data['ingreso_lugar_nacimiento'];
		$ingreso_cedula = $data['ingreso_cedula'];
		$ingreso_nacionalidad = $data['ingreso_nacionalidad'];
		$ingreso_direccion_casa = $data['ingreso_direccion_casa'];
		$ingreso_telefono = $data['ingreso_telefono'];
		$ingreso_telefono_casa = $data['ingreso_telefono_casa'];
		$ingreso_email = $data['ingreso_email'];
		$ingreso_estado_civil = $data['ingreso_estado_civil'];
		$ingreso_nombre_pareja = $data['ingreso_nombre_pareja'];
		$ingreso_carnet_blanco = $data['ingreso_carnet_blanco'];
		$ingreso_numero_hijos = $data['ingreso_numero_hijos'];
		$ingreso_numero_seguro_social = $data['ingreso_numero_seguro_social'];
		$ingreso_hobby = $data['ingreso_hobby'];
		$ingreso_edad = $data['ingreso_edad'];
		$ingreso_sexo = $data['ingreso_sexo'];
		$ingreso_carnet_verde = $data['ingreso_carnet_verde'];
		$ingreso_afiliado_seguro_social = $data['ingreso_afiliado_seguro_social'];
		$ingreso_nombre_madre = $data['ingreso_nombre_madre'];
		$ingreso_telefono_madre = $data['ingreso_telefono_madre'];
		$ingreso_nombre_padre = $data['ingreso_nombre_padre'];
		$ingreso_telefono_padre = $data['ingreso_telefono_padre'];
		$ingreso_vive_casa = $data['ingreso_vive_casa'];
		$ingreso_fecha_solicitud = $data['ingreso_fecha_solicitud'];
		$ingreso_estado_solicitud = $data['ingreso_estado_solicitud'];
		$query = "INSERT INTO ingreso( ingreso_fecha_ingreso, ingreso_nombre, ingreso_apellido, ingreso_fecha_nacimiento, ingreso_lugar_nacimiento, ingreso_cedula, ingreso_nacionalidad, ingreso_direccion_casa, ingreso_telefono, ingreso_telefono_casa, ingreso_email, ingreso_estado_civil, ingreso_nombre_pareja, ingreso_carnet_blanco, ingreso_numero_hijos, ingreso_numero_seguro_social, ingreso_hobby, ingreso_edad, ingreso_sexo, ingreso_carnet_verde, ingreso_afiliado_seguro_social, ingreso_nombre_madre, ingreso_telefono_madre, ingreso_nombre_padre, ingreso_telefono_padre, ingreso_vive_casa, ingreso_fecha_solicitud, ingreso_estado_solicitud) VALUES ( '$ingreso_fecha_ingreso', '$ingreso_nombre','$ingreso_apellido', '$ingreso_fecha_nacimiento', '$ingreso_lugar_nacimiento', '$ingreso_cedula', '$ingreso_nacionalidad', '$ingreso_direccion_casa', '$ingreso_telefono', '$ingreso_telefono_casa', '$ingreso_email', '$ingreso_estado_civil', '$ingreso_nombre_pareja', '$ingreso_carnet_blanco', '$ingreso_numero_hijos', '$ingreso_numero_seguro_social', '$ingreso_hobby', '$ingreso_edad', '$ingreso_sexo', '$ingreso_carnet_verde', '$ingreso_afiliado_seguro_social', '$ingreso_nombre_madre', '$ingreso_telefono_madre', '$ingreso_nombre_padre', '$ingreso_telefono_padre', '$ingreso_vive_casa', '$ingreso_fecha_solicitud', '$ingreso_estado_solicitud')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un ingreso  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$ingreso_fecha_ingreso = $data['ingreso_fecha_ingreso'];
		$ingreso_nombre = $data['ingreso_nombre'];
		$ingreso_apellido = $data['ingreso_apellido'];
		$ingreso_fecha_nacimiento = $data['ingreso_fecha_nacimiento'];
		$ingreso_lugar_nacimiento = $data['ingreso_lugar_nacimiento'];
		$ingreso_cedula = $data['ingreso_cedula'];
		$ingreso_nacionalidad = $data['ingreso_nacionalidad'];
		$ingreso_direccion_casa = $data['ingreso_direccion_casa'];
		$ingreso_telefono = $data['ingreso_telefono'];
		$ingreso_telefono_casa = $data['ingreso_telefono_casa'];
		$ingreso_email = $data['ingreso_email'];
		$ingreso_estado_civil = $data['ingreso_estado_civil'];
		$ingreso_nombre_pareja = $data['ingreso_nombre_pareja'];
		$ingreso_carnet_blanco = $data['ingreso_carnet_blanco'];
		$ingreso_numero_hijos = $data['ingreso_numero_hijos'];
		$ingreso_numero_seguro_social = $data['ingreso_numero_seguro_social'];
		$ingreso_hobby = $data['ingreso_hobby'];
		$ingreso_edad = $data['ingreso_edad'];
		$ingreso_sexo = $data['ingreso_sexo'];
		$ingreso_carnet_verde = $data['ingreso_carnet_verde'];
		$ingreso_afiliado_seguro_social = $data['ingreso_afiliado_seguro_social'];
		$ingreso_nombre_madre = $data['ingreso_nombre_madre'];
		$ingreso_telefono_madre = $data['ingreso_telefono_madre'];
		$ingreso_nombre_padre = $data['ingreso_nombre_padre'];
		$ingreso_telefono_padre = $data['ingreso_telefono_padre'];
		$ingreso_vive_casa = $data['ingreso_vive_casa'];
		$ingreso_fecha_solicitud = $data['ingreso_fecha_solicitud'];
		$ingreso_estado_solicitud = $data['ingreso_estado_solicitud'];
		$query = "UPDATE ingreso SET  ingreso_fecha_ingreso = '$ingreso_fecha_ingreso', ingreso_nombre = '$ingreso_nombre', ingreso_apellido = '$ingreso_apellido', ingreso_fecha_nacimiento = '$ingreso_fecha_nacimiento', ingreso_lugar_nacimiento = '$ingreso_lugar_nacimiento', ingreso_cedula = '$ingreso_cedula', ingreso_nacionalidad = '$ingreso_nacionalidad', ingreso_direccion_casa = '$ingreso_direccion_casa', ingreso_telefono = '$ingreso_telefono', ingreso_telefono_casa = '$ingreso_telefono_casa', ingreso_email = '$ingreso_email', ingreso_estado_civil = '$ingreso_estado_civil', ingreso_nombre_pareja = '$ingreso_nombre_pareja', ingreso_carnet_blanco = '$ingreso_carnet_blanco', ingreso_numero_hijos = '$ingreso_numero_hijos', ingreso_numero_seguro_social = '$ingreso_numero_seguro_social', ingreso_hobby = '$ingreso_hobby', ingreso_edad = '$ingreso_edad', ingreso_sexo = '$ingreso_sexo', ingreso_carnet_verde = '$ingreso_carnet_verde', ingreso_afiliado_seguro_social = '$ingreso_afiliado_seguro_social', ingreso_nombre_madre = '$ingreso_nombre_madre', ingreso_telefono_madre = '$ingreso_telefono_madre', ingreso_nombre_padre = '$ingreso_nombre_padre', ingreso_telefono_padre = '$ingreso_telefono_padre', ingreso_vive_casa = '$ingreso_vive_casa', ingreso_fecha_solicitud = '$ingreso_fecha_solicitud', ingreso_estado_solicitud = '$ingreso_estado_solicitud' WHERE ingreso_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}