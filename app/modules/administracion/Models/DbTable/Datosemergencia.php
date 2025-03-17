<?php 
/**
* clase que genera la insercion y edicion  de datosemergencia en la base de datos
*/
class Administracion_Model_DbTable_Datosemergencia extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'datos_emergencia';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'datos_emergencia_id';

	/**
	 * insert recibe la informacion de un datosemergencia y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$datos_emergencia_nombre = $data['datos_emergencia_nombre'];
		$datos_emergencia_telefono = $data['datos_emergencia_telefono'];
		$datos_emergencia_parentesco = $data['datos_emergencia_parentesco'];
		$datos_emergencia_cedula_colaborador = $data['datos_emergencia_cedula_colaborador'];
		$query = "INSERT INTO datos_emergencia( datos_emergencia_nombre, datos_emergencia_telefono, datos_emergencia_parentesco, datos_emergencia_cedula_colaborador) VALUES ( '$datos_emergencia_nombre', '$datos_emergencia_telefono', '$datos_emergencia_parentesco', '$datos_emergencia_cedula_colaborador')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un datosemergencia  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$datos_emergencia_nombre = $data['datos_emergencia_nombre'];
		$datos_emergencia_telefono = $data['datos_emergencia_telefono'];
		$datos_emergencia_parentesco = $data['datos_emergencia_parentesco'];
		$datos_emergencia_cedula_colaborador = $data['datos_emergencia_cedula_colaborador'];
		$query = "UPDATE datos_emergencia SET  datos_emergencia_nombre = '$datos_emergencia_nombre', datos_emergencia_telefono = '$datos_emergencia_telefono', datos_emergencia_parentesco = '$datos_emergencia_parentesco', datos_emergencia_cedula_colaborador = '$datos_emergencia_cedula_colaborador' WHERE datos_emergencia_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}