<?php 
/**
* clase que genera la insercion y edicion  de dependientes en la base de datos
*/
class Page_Model_DbTable_Dependientes extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'dependientes';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'dependiente_id';

	/**
	 * insert recibe la informacion de un dependientes y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$dependiente_nombre = $data['dependiente_nombre'];
		$dependiente_parentesco = $data['dependiente_parentesco'];
		$dependiente_cedula_colaborador = $data['dependiente_cedula_colaborador'];
		$query = "INSERT INTO dependientes( dependiente_nombre, dependiente_parentesco, dependiente_cedula_colaborador) VALUES ( '$dependiente_nombre', '$dependiente_parentesco', '$dependiente_cedula_colaborador')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un dependientes  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$dependiente_nombre = $data['dependiente_nombre'];
		$dependiente_parentesco = $data['dependiente_parentesco'];
		$dependiente_cedula_colaborador = $data['dependiente_cedula_colaborador'];
		$query = "UPDATE dependientes SET  dependiente_nombre = '$dependiente_nombre', dependiente_parentesco = '$dependiente_parentesco', dependiente_cedula_colaborador = '$dependiente_cedula_colaborador' WHERE dependiente_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}