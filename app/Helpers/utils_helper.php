<?php

$CI_INSTANCE = [];  # It keeps a ref to global CI instance

if (!function_exists('register_ci_instance')) {
	function register_ci_instance(\App\Controllers\BaseController &$_ci) {
		global $CI_INSTANCE;
		$CI_INSTANCE[0] = &$_ci;
	}
}

if (!function_exists('&get_instance')) {
	function &get_instance(): \App\Controllers\BaseController {
		global $CI_INSTANCE;
		return $CI_INSTANCE[0];
	}
}

if (!function_exists('lm')) {
	function lm($val) {
		log_message('alert', print_r($val, TRUE));
	}
}

if (!function_exists('lq')) {
	function lq($db = null) {
		$db = \Config\Database::connect($db, true) ?? \Config\Database::connect();
		log_message('alert', $db->getLastQuery());
	}
}

if (!function_exists('flashData')) {
	function flashData($array) {
		$string = '';
		foreach ($array as $a) {
			$string .= $a . "<br>";
		}
		return $string;
	}
}

if (!function_exists('date_history')) {
	function date_history($periodo) {
		// Obtener fecha actual
		$today = new DateTime();
		// Obtener fecha hace X meses
		$date_range_back = new DateTime();
		$date_range_back->modify("-$periodo months");
		return $date_range_back->format('d/m/Y') . " - " . $today->format('d/m/Y');
	}
}

if (!function_exists('date_interval_history')) {
	function date_interval_history($start_date, $periodo, $date_range = "start_date") {
		// Convertir la fecha de entrada a objeto DateTime
		$start = new DateTime($start_date);

		// Clonar para evitar modificar el original
		$new_start = clone $start;

		// Aplicar la resta del período
		$new_start->modify("-$periodo month");

		// Formatear las fechas para devolver
		$start_date = $new_start->format('Y-m-d 00:00:00');
		$end_date = $new_start->format('Y-m-t 23:59:59');

		return "$date_range >='$start_date' and $date_range <='$end_date'";
	}
}

if (!function_exists('date_days')) {
	function date_days($periodo) {
		// Obtener fecha actual
		$today = new DateTime();
		// Obtener fecha hace X meses
		$date_range_back = new DateTime();
		$date_range_back->modify("-$periodo days");
		return $date_range_back->format('d/m/Y') . " - " . $today->format('d/m/Y');
	}
}

if (!function_exists('date_interval_days')) {
	function date_interval_days($periodo, $date_range = "create_time") {
		// Obtener fecha actual
		$today = new DateTime();
		$today = $today->format('Y-m-d H:i:s');
		// Obtener Fecha Start
		$start_date = date('Y-m-d 00:00:00', strtotime($today . ' -' . $periodo . 'days'));
		// Obtener Fecha End
		$end_date = date('Y-m-d 23:59:59', strtotime($today));
		return array("$date_range >= '$start_date' AND $date_range <= '$end_date'");
	}
}

if (!function_exists('date_interval_prev_days')) {
	function date_interval_prev_days($periodo, $date_range = "create_time") {
		// Obtener fecha actual
		$today = new DateTime();
		$today = $today->format('Y-m-d H:i:s');
		// Obtener Fecha End
		$end_date = date('Y-m-d 23:59:59', strtotime($today . ' -' . $periodo + 1 . 'days'));
		// Obtener Fecha Start
		$start_date = date('Y-m-d 00:00:00', strtotime($end_date . ' -' . $periodo . 'days'));

		return array("$date_range >= '$start_date' AND $date_range <= '$end_date'");
	}
}

if (!function_exists('date_start_end_prev_days')) {
	function date_start_end_prev_days($start_date, $diff, $date_range = "create_time") {
		$end_date = date('Y-m-d 23:59:59', strtotime($start_date . ' -1 days'));
		$start_date = date('Y-m-d 00:00:00', strtotime($start_date . ' -' . $diff + 1 . 'days'));

		return array("$date_range >= '$start_date' AND $date_range <= '$end_date'");
	}
}

if (!function_exists('date_month_actual')) {
	function date_month_actual($date_range = "closed_at") {
		// Obtener el primer día del mes actual
		$start_date = date('Y-m-01 00:00:00');

		// Obtener el último día del mes actual
		$end_date = date('Y-m-t 23:59:59');

		return array("$date_range >= '$start_date' AND $date_range <= '$end_date'");
	}
}

if (!function_exists('date_interval_actual')) {
    function date_interval_actual() {
        // Obtener el primer día del mes actual
        $start_date = date('01/m/Y');
        
        // Obtener el último día del mes actual
        $end_date = date('t/m/Y');
        
        return $start_date . ' - ' . $end_date;
    }
}


if (!function_exists('diff_days')) {
	function diff_days($start, $end) {

		$today = new DateTime(); // Fecha de hoy
		$fechaInicio = new DateTime($start); //Fecha Inicio
		$fechaFin = new DateTime($end); // Fecha final

		$diff_start = $today->diff($fechaInicio)->days;

		if ($diff_start == 0) {
			$date_string = "Hoy"; // Si la fecha de inicio es hoy
		} elseif ($diff_start == 1) {
			$date_string = "Ayer"; // Si la fecha de inicio es ayer
		} else {
			$date_string = "Otra"; // Si la fecha de inicio es otra
		}

		return (object) array(
			'diff' => $fechaFin->diff($fechaInicio)->days, // Calcular la diferencia en días
			'name_date' =>  $date_string // Diferencia entre hoy y la fecha de inicio
		);
	}
}

if (!function_exists('auto_version')) {
	function auto_version($url) {
		$path = pathinfo($url);
		$string = $path['basename'];
		$ver = '.version' . filemtime(FCPATH . $url) . '.';
		$str = '.';
		if (($pos = strrpos($string, $str)) !== false) {
			$search_length = strlen($str);
			$str = substr_replace($string, $ver, $pos, $search_length);
			return $path['dirname'] . '/' . $str;
		} else {
			return $url;
		}
	}
}

if (!function_exists('secret_datetime_expire')) {
	function secret_datetime_expire($days) {
		$currentDate = date('Y-m-d H:i:s');
		$futureDate = strtotime('+' . $days . ' days', strtotime($currentDate));
		$secretExpire = date('Y-m-d H:i:s', $futureDate);
		return $secretExpire;
	}
}

// Función para verificar si una IP está dentro de un rango de subred
if (!function_exists('ip_in_subnet')) {
	function ip_in_subnet($ip, $subnet) {
		list($subnet_ip, $subnet_cidr) = explode('/', $subnet);

		// Verificar si el CIDR es válido (entre 0 y 32)
		if ($subnet_cidr < 0 || $subnet_cidr > 32) {
			return false;
		}

		return (ip2long($ip) & ~((1 << (32 - $subnet_cidr)) - 1)) == ip2long($subnet_ip);
	}
}

// Función para buscar la red de una IP
if (!function_exists('find_network_for_ip')) {
	function find_network_for_ip($ip, $ip_declarate) {
		// Verificar primero las direcciones IP individuales
		foreach ($ip_declarate as $row) {
			$ip_db = $row->ip;
			if (strpos($ip_db, '/') === false && $ip == $ip_db) {
				return $row->name;
			}
		}
		// Si no se encontró la IP como individual, buscar en los rangos de subred
		foreach ($ip_declarate as $row) {
			$ip_db = $row->ip;
			if (strpos($ip_db, '/') !== false && ip_in_subnet($ip, $ip_db)) {
				return $row->name;
			}
		}
		return null; // Devolver null si no se encontró la IP en ninguna red conocida
	}
}

if (!function_exists('date_transform')) {
	function date_transform($start_date) {
		$start_period = DateTime::createFromFormat('d/m/Y', $start_date);
		$formatter = new \IntlDateFormatter('es_ES', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL, 'Europe/Madrid', \IntlDateFormatter::GREGORIAN, 'MMMM yyyy');
		$period = ucfirst($formatter->format($start_period));

		return $period;
	}
}

if (!function_exists('remove_tildes')) {
	function remove_tildes($string) {
		$tildes = array(
			'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
			'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
		);
		return strtr($string, $tildes);
	}
}