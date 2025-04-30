<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;
use Config\Services;

class RebuildDatabase extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:rebuild';
    protected $description = 'Elimina todas las tablas, ejecuta migraciones y seeders.';

    public function run(array $params)
    {
        $db     = Database::connect();
        $forge  = \Config\Database::forge();

        // Paso 1: Eliminar todas las tablas
        $tables = $db->listTables();

        if (!empty($tables)) {
            foreach ($tables as $table) {
                $forge->dropTable($table, true);
                CLI::write("Tabla '$table' eliminada.", 'green');
            }
            CLI::write('Todas las tablas fueron eliminadas.', 'light_green');
        } else {
            CLI::write('No hay tablas en la base de datos para eliminar.', 'yellow');
        }

        // Paso 2: Ejecutar migraciones
        CLI::write('Ejecutando migraciones...', 'cyan');
        $migrate = Services::migrations();
        try {
            $migrate->latest();
            CLI::write('Migraciones completadas.', 'light_green');
        } catch (\Throwable $e) {
            CLI::error($e->getMessage());
            return;
        }

        // Paso 3: Ejecutar seeders
        CLI::write('Ejecutando seeders...', 'cyan');
        $seeder = Database::seeder();
        try {
            $seeder->call('PopulationDBSeeder');
            CLI::write('Seeders completados.', 'light_green');
        } catch (\Throwable $e) {
            CLI::error($e->getMessage());
        }

        CLI::write('Base de datos reconstruida correctamente.', 'light_green');
    }
}
