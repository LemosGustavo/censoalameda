<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Image extends Controller {
    public function serve($filename) {
        // Verificar que el usuario está en sesión
        if (!session()->has('censo_preview_data')) {
            return $this->response->setStatusCode(403)->setBody('Acceso no autorizado');
        }

        // Obtener los datos de la sesión
        $preview_data = session()->get('censo_preview_data');

        // Verificar que la imagen solicitada coincide con la de la sesión
        $session_image = basename($preview_data['path_photo']);
        if ($filename !== $session_image) {
            return $this->response->setStatusCode(404)->setBody('Imagen no encontrada sigue buscando');
        }

        $path = APPPATH . 'Uploads/' . $filename;

        // Verificar que el archivo existe
        if (!file_exists($path)) {
            return $this->response->setStatusCode(404)->setBody('Imagen no encontrada');
        }

        // Verificar que es una imagen
        $mime = mime_content_type($path);
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
            return $this->response->setStatusCode(403)->setBody('Tipo de archivo no permitido');
        }

        // Servir la imagen
        return $this->response
            ->setContentType($mime)
            ->setBody(file_get_contents($path));
    }
}
