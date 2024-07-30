<?php 
/**
* clase que genera la insercion y edicion  de conquienesvive en la base de datos
*/
class Page_Model_DbTable_Conquienesvive extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'vive_con';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'vive_con_id';

	/**
	 * insert recibe la informacion de un conquienesvive y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$vive_con_nombre = $data['vive_con_nombre'];
		$vive_con_telefono = $data['vive_con_telefono'];
		$vive_con_parentesco = $data['vive_con_parentesco'];
		$vive_con_cedula_colaborador = $data['vive_con_cedula_colaborador'];
		$query = "INSERT INTO vive_con( vive_con_nombre, vive_con_telefono, vive_con_parentesco, vive_con_cedula_colaborador) VALUES ( '$vive_con_nombre', '$vive_con_telefono', '$vive_con_parentesco', '$vive_con_cedula_colaborador')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un conquienesvive  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$vive_con_nombre = $data['vive_con_nombre'];
		$vive_con_telefono = $data['vive_con_telefono'];
		$vive_con_parentesco = $data['vive_con_parentesco'];
		$vive_con_cedula_colaborador = $data['vive_con_cedula_colaborador'];
		$query = "UPDATE vive_con SET  vive_con_nombre = '$vive_con_nombre', vive_con_telefono = '$vive_con_telefono', vive_con_parentesco = '$vive_con_parentesco', vive_con_cedula_colaborador = '$vive_con_cedula_colaborador' WHERE vive_con_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}