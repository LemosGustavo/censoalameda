<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class FotoController extends ResourceController
{
    public function obtener($filename = null)
    {
        $token = $this->request->getGet('token');
        $secret = getenv('FOTO_API_SECRET');

        if (!$filename || $token !== $secret) {
            return $this->failUnauthorized('Token inválido');
        }

        $path = WRITEPATH . '../app/Uploads/' . basename($filename);
        if (!is_file($path)) {
            return $this->failNotFound('Archivo no encontrado');
        }

        return $this->response->download($path, null)->setFileName($filename);
    }
}