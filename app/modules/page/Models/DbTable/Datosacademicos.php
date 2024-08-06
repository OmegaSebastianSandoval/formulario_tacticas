<?php 
/**
* clase que genera la insercion y edicion  de datosacademicos en la base de datos
*/
class Page_Model_DbTable_Datosacademicos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'datos_academicos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'datos_academicos_id';

	/**
	 * insert recibe la informacion de un datosacademicos y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$datos_academicos_formacion = $data['datos_academicos_formacion'];
		$datos_academicos_cedula_colaborador = $data['datos_academicos_cedula_colaborador'];
		$query = "INSERT INTO datos_academicos( datos_academicos_formacion, datos_academicos_cedula_colaborador) VALUES ( '$datos_academicos_formacion', '$datos_academicos_cedula_colaborador')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un datosacademicos  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$datos_academicos_formacion = $data['datos_academicos_formacion'];
		$datos_academicos_cedula_colaborador = $data['datos_academicos_cedula_colaborador'];
		$query = "UPDATE datos_academicos SET  datos_academicos_formacion = '$datos_academicos_formacion', datos_academicos_cedula_colaborador = '$datos_academicos_cedula_colaborador' WHERE datos_academicos_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}