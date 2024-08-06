<?php 
/**
* clase que genera la insercion y edicion  de datoslaborales en la base de datos
*/
class Page_Model_DbTable_Datoslaborales extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'datos_laborales';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'datos_laborales_id';

	/**
	 * insert recibe la informacion de un datoslaborales y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$datos_laborales_empleo = $data['datos_laborales_empleo'];
		$datos_laborales_fecha_inicio = $data['datos_laborales_fecha_inicio'];
		$datos_laborales_fecha_fin = $data['datos_laborales_fecha_fin'];
		$datos_laborales_motivo_retiro = $data['datos_laborales_motivo_retiro'];
		$datos_laborales_cedula_colaborador = $data['datos_laborales_cedula_colaborador'];
		$query = "INSERT INTO datos_laborales( datos_laborales_empleo, datos_laborales_fecha_inicio, datos_laborales_fecha_fin, datos_laborales_motivo_retiro, datos_laborales_cedula_colaborador) VALUES ( '$datos_laborales_empleo', '$datos_laborales_fecha_inicio', '$datos_laborales_fecha_fin', '$datos_laborales_motivo_retiro', '$datos_laborales_cedula_colaborador')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un datoslaborales  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$datos_laborales_empleo = $data['datos_laborales_empleo'];
		$datos_laborales_fecha_inicio = $data['datos_laborales_fecha_inicio'];
		$datos_laborales_fecha_fin = $data['datos_laborales_fecha_fin'];
		$datos_laborales_motivo_retiro = $data['datos_laborales_motivo_retiro'];
		$datos_laborales_cedula_colaborador = $data['datos_laborales_cedula_colaborador'];
		$query = "UPDATE datos_laborales SET  datos_laborales_empleo = '$datos_laborales_empleo', datos_laborales_fecha_inicio = '$datos_laborales_fecha_inicio', datos_laborales_fecha_fin = '$datos_laborales_fecha_fin', datos_laborales_motivo_retiro = '$datos_laborales_motivo_retiro', datos_laborales_cedula_colaborador = '$datos_laborales_cedula_colaborador' WHERE datos_laborales_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}