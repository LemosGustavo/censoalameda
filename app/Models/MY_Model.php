<?php

namespace App\Models;

use DateTime;
use CodeIgniter\Model;

class MY_Model extends Model {

	protected $error;
	protected $row_id;
	protected $msg;
	protected $table_name;
	protected $class_name;
	protected $id_name;
	protected $id_foreign;
	protected $msg_name;
	protected $fields;
	protected $columnas;
	protected $requeridos;
	protected $unicos;
	protected $id_autoincrement = TRUE;
	protected $auditoria = FALSE;
	protected $db;
	public $default_join = array();

	public function __construct() {
		parent::__construct();
	}
	/**
	 * create: Crea un registro en la tabla.
	 *
	 * @param array $options
	 * @return bool ok
	 */
	public function create($options = array(), $trans_enabled = TRUE) {
		if (!$this->_required($this->requeridos, $options)) {
			$this->_set_error('Verifique que los campos requeridos contengan datos');
			return FALSE;
		}
		if (!$this->_unique($this->unicos, $options)) {
			$this->_set_error('Verifique que los datos ingresados no estén repetidos');
			return FALSE;
		}

		foreach ($options as $key => $option) {
			if (!in_array($key, $this->columnas)) {
				lm("$key no se encuentra en $this->table_name"); //No eliminar
			}
		}

		$builder = $this->db->table($this->table_name);
		foreach ($this->columnas as $columna) {
			if (isset($options[$columna])) {
				$builder->set($columna, ($options[$columna] == 'NULL' || $options[$columna] == '') ? NULL : $options[$columna]);
			}
		}

		if ($trans_enabled) {
			$this->db->transStart();
		}
		$builder->set('audi_user', '1');
		$builder->set('audi_date', date_format(new DateTime(), 'Y/m/d H:i:s'));
		$builder->set('audi_action', 'I');

		$ret_value = $builder->insert();
		if ($this->id_autoincrement) {
			$row_id_new =  $this->db->insertID();
		} elseif ($ret_value) {
			$row_id_new = $options[$this->id_name];
		} else {
			$row_id_new = -1;
		}

		if ($row_id_new > 0) {
			$this->_set_msg('Registro de ' . $this->msg_name . ' creado');
			$this->_set_row_id($row_id_new);
			if ($trans_enabled) {
				$this->db->transComplete();
			}
			return TRUE;
		} else {
			$this->_set_error('No se ha podido crear el registro de ' . $this->msg_name);
			if ($trans_enabled) {
				$this->db->transComplete();
			}
			return FALSE;
		}
	}

	/**
	 * update_modify: Modifica un registro en la tabla.
	 *
	 * @param array $options
	 * @return bool ok
	 */
	public function update_modify($options = array(), $trans_enabled = TRUE) {
		if (!$this->_required(array($this->id_name), $options)) {
			$this->_set_error('Verifique que los campos requeridos contengan datos');
			return FALSE;
		}
		if (!$this->_unique($this->unicos, $options, $options[$this->id_name])) {
			$this->_set_error('Verifique que los datos ingresados no estén repetidos');
			return FALSE;
		}

		foreach ($options as $key => $option) {
			if (!in_array($key, $this->columnas)) {
				lm("$key no se encuentra en $this->table_name"); //No eliminar
			}
		}
		$builder = $this->db->table($this->table_name);

		foreach ($this->columnas as $columna) {
			if (isset($options[$columna]) && $columna != $this->id_name) {
				$builder->set($columna, ($options[$columna] == 'NULL' || $options[$columna] == '') ? NULL : $options[$columna]);
			}
		}

		$builder->where($this->id_name, $options[$this->id_name]);

		if ($trans_enabled) {
			$this->db->transStart();
		}
		if ($this->auditoria) {
			if (isset($this->aud_table_name)) {
				$this->db->query("INSERT INTO $this->aud_table_name SELECT NULL as audi_id, $this->table_name.* FROM $this->table_name WHERE {$this->id_name}={$options[$this->id_name]}");
			} else {
				$this->db->query("INSERT INTO cedula_aud.$this->table_name SELECT NULL as audi_id, $this->table_name.* FROM $this->table_name WHERE {$this->id_name}={$options[$this->id_name]}");
			}
		}
		$builder->set('audi_user', '1');
		$builder->set('audi_date', date_format(new DateTime(), 'Y/m/d H:i:s'));
		$builder->set('audi_action', 'U');
		$builder->update();

		$rows = $this->db->affectedRows();
		if ($rows > -1) {
			$this->_set_msg('Registro de ' . $this->msg_name . ' modificado');
			if ($trans_enabled) {
				$this->db->transComplete();
			}
			return TRUE;
		} else {
			$this->_set_error('No se ha podido modificar el registro de ' . $this->msg_name);
			if ($trans_enabled) {
				$this->db->transComplete();
			}
			return FALSE;
		}
	}

	/**
	 * delete: Elimina un registro de la tabla.
	 *
	 * @param array $options
	 */
	public function delete_modify($options = array(), $trans_enabled = TRUE) {
		if (!$this->_required(array($this->id_name), $options)) {
			$this->_set_error('Verifique que los campos requeridos contengan datos');
			return FALSE;
		}

		if ($this->_can_delete($options[$this->id_name])) {
			$builder = $this->db->table($this->table_name);

			if ($trans_enabled) {
				$this->db->transStart();
			}
			
			$builder->where($this->id_name, $options[$this->id_name]);
			if ($builder->delete()) {
				$this->_set_msg('Registro de ' . $this->msg_name . ' eliminado');
				if ($trans_enabled) {
					$this->db->transComplete();
				}
				return TRUE;
			} else {
				$this->_set_error('No se ha podido eliminar el registro de ' . $this->msg_name);
				if ($trans_enabled) {
					$this->db->transComplete();
				}
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function delete_assign($options = array(), $trans_enabled = TRUE) {
		if (!$this->_required($this->requeridos, $options)) {
			$this->_set_error('Verifique que los campos requeridos contengan datos');
			return FALSE;
		}

		$builder = $this->db->table($this->table_name);

		if ($trans_enabled) {
			$this->db->transStart();
		}

		$builder->where($this->id_foreign, $options[$this->id_foreign]);
		if ($builder->delete()) {
			$this->_set_msg('Registro de ' . $this->msg_name . ' modificado');
			if ($trans_enabled) {
				$this->db->transComplete();
			}
			return TRUE;
		} else {
			$this->_set_error('No se ha podido modificar el registro de ' . $this->msg_name);
			if ($trans_enabled) {
				$this->db->transComplete();
			}
			return FALSE;
		}
	}

	/**
	 * _required: Retorna falso si el array $data no contiene los campos del array $required.
	 *
	 * @param array $required
	 * @param array $data
	 * @return bool
	 */
	protected function _required($required, $data) {
		foreach ($required as $field) {
			if (!isset($data[$field])) {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * _unique: Retorna falso si en la tabla para cada columna de $unique existe alguna fila con los mismos datos que $data.
	 *
	 * @param array $unique
	 * @param array $data
	 * @return bool
	 */
	protected function _unique($unique, $data, $id = -1, $id_name = 'id') {
		if (empty($unique)) {
			return TRUE;
		}
		// Verificar primero si en los ifs compuestos de $unique hay columnas que no vengan en data (para updates)
		$columnas_faltantes = array();
		if ($id > 0) {
			foreach ($unique as $field) {
				if (is_array($field)) {
					$faltantes = array_diff_key(array_flip($field), $data);
					// Si hay columnas faltantes del unique en el update y no son todas las columnas del unique, agregarlas
					if (count($faltantes) > 0 && count($faltantes) <> count($field)) {
						$columnas_faltantes = array_merge($columnas_faltantes, $faltantes);
					}
				}
			}
			if (!empty($columnas_faltantes)) {
				$data_faltante = $this->db->table($this->table_name)
					->select(array_flip($columnas_faltantes))
					->where($this->id_name, $id)
					->get()->getRowArray();
				$data = array_merge($data, $data_faltante);
			}
		}
		$where_uq = array();
		foreach ($unique as $field) {
			if (!is_array($field)) { //unique simple -> 1 columna
				if (!empty($data[$field])) {
					$where_uq[] = array($field => $data[$field]);
				}
			} else { //unique compuesto -> +1 columna
				if (empty(array_diff_key(array_flip($field), $data))) {
					$wheres_uq_arr = array();
					foreach ($field as $field_2) {
						$wheres_uq_arr[$field_2] = $data[$field_2];
					}
					$where_uq[] = $wheres_uq_arr;
				}
			}
		}
		if (empty($where_uq)) {
			return TRUE;
		}
		$builder = $this->db->table($this->table_name);
		$builder->groupStart();
		foreach ($where_uq as $where) {
			if (!is_array($where)) {
				$builder->orWhere(array($where));
			} else {
				$builder->orGroupStart();
				$builder->where($where);
				$builder->groupEnd();
			}
		}
		$builder->groupEnd();
		$builder->where($id_name . ' !=', $id);
		if ($builder->countAllResults() > 0) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * _can_delete: Retorna true si puede eliminarse el registro.
	 *
	 * @param int $delete_id
	 * @return bool
	 */
	protected function _can_delete($delete_id) {
		return TRUE;
	}

	/**
	 * _set_error: Guarda un error.
	 *
	 * @return void
	 */
	protected function _set_error($error) {
		$this->error = $error;
	}

	/**
	 * get_error: Devuelve el error.
	 *
	 * @return string
	 */
	public function get_error() {
		return $this->error;
	}

	/**
	 * _set_msg: Guarda un mensaje.
	 *
	 * @return void
	 */
	protected function _set_msg($msg) {
		$this->msg = $msg;
	}

	/**
	 * get_msg: Devuelve el mensaje.
	 *
	 * @return string
	 */
	public function get_msg() {
		return $this->msg;
	}

	/**
	 * _set_row_id: Guarda el id de un elemento creado.
	 *
	 * @return void
	 */
	protected function _set_row_id($id) {
		$this->row_id = $id;
	}

	/**
	 * get_row_id: Devuelve el id del último elemento creado.
	 *
	 * @return int
	 */
	public function get_row_id() {
		return $this->row_id;
	}

	public function get_one($id = NULL, $joins = array()) {
		if (empty($id)) {
			return FALSE;
		}
		$options[$this->id_name] = $id;
		if (empty($joins)) {
			$options['join'] = $this->default_join;
		} else {
			foreach ($this->default_join as $join) {
				if (in_array($join[0], $joins)) {
					$options['join'][] = $join;
				}
			}
		}
		$options['groupBy'] = "$this->table_name.id";

		$ret = $this->get_where($options);
		return is_array($ret) ? $ret[0] : $ret;
	}

	public function get_where($options = array()) {
		if (isset($options['from'])) {
			$query = $this->db->table($options['from']);
		} else {
			$query = $this->db->table($this->table_name);
		}

		if (isset($options['select'])) {
			$query->select($options['select']);
		} else {
			if (isset($options['join'])) {
				if (isset($options['from'])) {
					foreach ($this->columnas as $columna) {
						$query->select($options['from'] . '.' . $columna);
					}
				} else {
					foreach ($this->columnas as $columna) {
						$query->select($this->table_name . '.' . $columna);
					}
				}

				foreach ($options['join'] as $join) {
					if (isset($join['columnas'])) {
						$query->select($join['columnas']);
					} elseif (isset($join[3])) {
						$query->select($join[3][0]);
					}
				}
			} else {
				$query->select($this->columnas);
			}
		}

		if (isset($options['where'])) {
			foreach ($options['where'] as $where) {
				if (is_array($where)) {
					if (isset($where['override'])) {
						$query->where($where['column'], $where['value'], FALSE);
					} else {
						$query->where($where['column'], $where['value']);
					}
				} else {
					$query->where($where);
				}
			}
		}

		if (isset($options['where_in'])) {
			foreach ($options['where_in'] as $where_in) {
				$query->whereIn($where_in['column'], $where_in['value']);
			}
		}

		if (isset($options['having'])) {
			foreach ($options['having'] as $having) {
				if (is_array($having)) {
					if (isset($having['override'])) {
						$query->having($having['column'], $having['value'], FALSE);
					} else {
						$query->having($having['column'], $having['value']);
					}
				} else {
					$query->having($having);
				}
			}
		}

		if (isset($options['whereParam'])) {
			$query->where($options['whereParam'], '', FALSE);
		}

		foreach ($this->columnas as $columna) {
			$columna_mayor = $columna . ' >';
			$columna_menor = $columna . ' <';
			$columna_distinto = $columna . ' !=';
			$columna_mayor_igual = $columna . ' >=';
			$columna_menor_igual = $columna . ' <=';
			$columna_like_after = $columna . ' like after';
			$columna_like_before = $columna . ' like before';
			$columna_like_both = $columna . ' like both';
			if (isset($options[$columna])) {
				$query->where("$this->table_name.$columna", $options[$columna]);
			}
			if (isset($options[$columna_mayor])) {
				$query->where("$this->table_name.$columna_mayor", $options[$columna_mayor]);
			}
			if (isset($options[$columna_menor])) {
				$query->where("$this->table_name.$columna_menor", $options[$columna_menor]);
			}
			if (isset($options[$columna_distinto])) {
				$query->where("$this->table_name.$columna_distinto", $options[$columna_distinto]);
			}
			if (isset($options[$columna_mayor_igual])) {
				$query->where("$this->table_name.$columna_mayor_igual", $options[$columna_mayor_igual]);
			}
			if (isset($options[$columna_menor_igual])) {
				$query->where("$this->table_name.$columna_menor_igual", $options[$columna_menor_igual]);
			}
			if (isset($options[$columna_like_after])) {
				$query->like("$this->table_name.$columna", $options[$columna_like_after], 'after');
			}
			if (isset($options[$columna_like_before])) {
				$query->like("$this->table_name.$columna", $options[$columna_like_before], 'before');
			}
			if (isset($options[$columna_like_both])) {
				$query->like("$this->table_name.$columna", $options[$columna_like_both], 'both');
			}
		}

		if (isset($options['join'])) {
			foreach ($options['join'] as $join) {
				if (isset($join['table'])) {
					$query->join($join['table'], $join['where'], isset($join['type']) ? $join['type'] : '');
				} else {
					$query->join($join[0], $join[1], isset($join[2]) ? $join[2] : '');
				}
			}
		}

		if (isset($options['groupBy'])) {
			$groupBy = $options['groupBy'];
			$query->groupBy("$groupBy");
		}

		if (isset($options['limit']) && isset($options['offset'])) {
			$query->limit($options['limit'], $options['offset']);
		} elseif (isset($options['limit'])) {
			$query->limit($options['limit']);
		}

		if (isset($options['sortBy'])) {
			if (is_array($options['sortBy'])) {
				$query->orderBy($options['sortBy'][0], '', $options['sortBy'][1]);
			} else {
				$query->orderBy($options['sortBy']);
			}
		}

		if (isset($options['debug']) && $options['debug'] === TRUE) {
			lm($this->db->getLastQuery());
		}

		if (isset($options['return_array']) && $options['return_array']) {
			$result = $query->get()->getResultArray();
		} else {
			$result = $query->get()->getResult();
		}
		$queryCountAllResults = count($result);

		if ($queryCountAllResults === 0) {
			return FALSE;
		}
		
		return $result;
	}

	public function set_field_array($field_name, $new_array) {
		if (isset($this->fields[$field_name])) {
			$this->fields[$field_name]['array'] = $new_array;
			return true;
		} else {
			return false;
		}
	}

	public function get_options($options = array()) {
		$builder = $this->db->table($this->table);

		if (isset($options['orderBy'])) {
			$builder->orderBy($options['orderBy']);
		}

		if (isset($options['where'])) {
			$builder->where($options['where']);
		}

		if (isset($options['limit'])) {
			$builder->limit($options['limit']);
		}

		$query = $builder->get();
		return $query->getResult();
	}
}
