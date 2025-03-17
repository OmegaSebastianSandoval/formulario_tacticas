<?php

/**
 * clase que genera la insercion y edicion  de cargos en la base de datos
 */
class Page_Model_DbTable_Cargos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'tacticas.cargos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'tacticas.cargo_id';
}
