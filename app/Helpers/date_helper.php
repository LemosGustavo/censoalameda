<?php

if (!function_exists('calculate_age')) {
    function calculate_age($birthdate) {
        if (empty($birthdate) || $birthdate === '0000-00-00') {
            return null;
        }

        try {
            $birth = new \DateTime($birthdate);
            $today = new \DateTime();
            $age = $today->diff($birth);
            return $age->y;
        } catch (Exception $e) {
            // Si falla la conversión de fecha, devuelve null o puedes loguear el error
            return null;
        }
    }
}
