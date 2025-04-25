<?php
$success_message = session()->getFlashdata('success');
?>

<div class="content-wrapper d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header text-center">
                            <div style="width: 100%; height: 300px; background-image: url('/assets/img/logo_b.jpg'); background-size: cover; background-position: center;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                                <h3 class="mt-4">¡Datos guardados exitosamente!</h3>
                                <p class="lead">Los datos del censo han sido guardados correctamente en el sistema.</p>
                                
                                <div class="mt-4">
                                    <p>¿Desea llenar otra planilla de censo?</p>
                                    <a href="<?= base_url('') ?>" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Nueva Planilla
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 