<?php
$data = session()->get('censo_preview_data');
log_message('info', 'Valor de path_photo en la vista: ' . ($data['path_photo'] ?? 'no definido'));
?>

<div class="content-wrapper d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header text-center">
                            <h3>Revisión de Datos</h3>
                            <p>Por favor, verifica que los datos ingresados sean correctos antes de confirmar.</p>
                        </div>
                        <div class="card-body">
                            <!-- Datos Personales -->
                            <div class="callout callout-personal">
                                <h5>Datos Personales</h5>
                                <div class="row">
                                    <div class="col-md-6">

                                        <?php if (!empty($data['photo_base64'])): ?>
                                            <div class="image-preview-container" style="max-width: 300px; margin: 0 auto;">
                                                <img src="data:image/jpeg;base64,<?= $data['photo_base64'] ?>"
                                                    alt="Foto de perfil"
                                                    class="img-thumbnail rounded"
                                                    style="max-width: 100%; height: auto;">
                                            </div>
                                        <?php else: ?>
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <?php if (!empty($data['path_photo'])): ?>
                                                    <br>
                                                    <small>Se detectó un nombre de archivo pero no su contenido: <?= $data['path_photo'] ?></small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <br>
                                        <p><strong>Nombre:</strong> <?= $data['name'] ?></p>
                                        <p><strong>Apellido:</strong> <?= $data['lastname'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Fecha de Nacimiento:</strong> <?= date('d/m/Y', strtotime($data['birthdate'])) ?></p>
                                        <p><strong>Género:</strong> <?= $data['gender'] ?></p>
                                        <p><strong>Estado Civil:</strong> <?= $data['civil_state'] ?></p>
                                        <p><strong>DNI:</strong> <?= $data['dni_document'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Contacto -->
                            <div class="callout callout-contact">
                                <h5>Contacto</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Email:</strong> <?= $data['email'] ?></p>
                                        <p><strong>Teléfono:</strong> <?= $data['phone'] ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Redes Sociales:</strong></p>
                                        <ul>
                                            <?php foreach ($data['social_media'] as $social): ?>
                                                <li><?= $social ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Residencia -->
                            <div class="callout callout-house">
                                <h5>Residencia</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>País:</strong> <?= $data['country'] ?></p>
                                        <p><strong>Provincia:</strong> <?= $data['state'] ?></p>
                                        <p><strong>Departamento:</strong> <?= $data['district'] ?></p>
                                        <p><strong>Localidad:</strong> <?= $data['locality'] ?></p>
                                        <p><strong>Dirección:</strong> <?= $data['address'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Vocación -->
                            <div class="callout callout-vocation">
                                <h5>Vocación</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Profesión:</strong> <?= $data['name_profession'] ?></p>
                                        <p><strong>Habilidades Artísticas:</strong> <?= $data['artistic_skills'] ?></p>
                                        <p><strong>¿Es Voluntario?:</strong> <?= $data['voluntario'] === 'si' ? 'Sí' : 'No' ?></p>
                                        <?php if ($data['voluntario'] === 'si'): ?>
                                            <p><strong>Áreas de Servicio:</strong> <?= implode(', ', $data['voluntary_areas']) ?></p>
                                        <?php else: ?>
                                            <p><strong>Áreas de Interés:</strong> <?= implode(', ', $data['voluntary_areas']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Familia -->
                            <div class="callout callout-family">
                                <h5>Familia</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Con quién vive:</strong></p>
                                        <ul>
                                            <?php foreach ($data['family'] as $member): ?>
                                                <li><?= $member ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php if (!empty($data['children'])): ?>
                                            <p><strong>Hijos:</strong> <?= count($data['children']) ?></p>
                                            <ul>
                                                <?php foreach ($data['children'] as $child): ?>
                                                    <li>
                                                        <?= $child['name'] ?> <?= $child['lastname'] ?>
                                                        (DNI: <?= $child['dni'] ?>,
                                                        Fecha Nacimiento: <?= $child['birthdate'] ?>,
                                                        Asiste a la iglesia: <?= $child['church'] ? 'Sí' : 'No' ?>)
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Crecimiento Cristiano -->
                            <div class="callout callout-cristians">
                                <h5>Crecimiento Cristiano</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Forma de Celebración:</strong> <?= $data['celebracion'] === 'presencial' ? 'Presencial' : 'Virtual' ?></p>
                                        <p><strong>Experiencias:</strong></p>
                                        <ul>
                                            <?php foreach ($data['experiences'] as $exp): ?>
                                                <li><?= $exp ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <p><strong>Servicios:</strong></p>
                                        <ul>
                                            <?php foreach ($data['services'] as $service): ?>
                                                <li><?= $service ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <p><strong>¿Asiste a Grupo Pequeño?:</strong> <?= $data['grupo'] === 'si' ? 'Sí' : 'No' ?></p>
                                        <?php if ($data['grupo'] === 'si'): ?>
                                            <p><strong>Nombre del Guía:</strong> <?= $data['name_guia'] ?></p>
                                            <p><strong>Nombre del Grupo:</strong> <?= $data['name_group'] ?></p>
                                        <?php else: ?>
                                            <p><strong>¿Le interesaría participar?:</strong> <?= $data['participate_gp'] === 'si' ? 'Sí' : 'No' ?></p>
                                        <?php endif; ?>
                                        <p><strong>Intereses:</strong></p>
                                        <ul>
                                            <?php foreach ($data['interests'] as $interest): ?>
                                                <li><?= $interest ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <p><strong>Necesidades:</strong></p>
                                        <ul>
                                            <?php foreach ($data['needs'] as $need): ?>
                                                <li><?= $need ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <p><strong>Etapa de Vida:</strong>
                                        <ul>
                                            <?php foreach ($data['life_stage'] as $life_stage): ?>
                                                <li><?= $life_stage ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <a href="<?= base_url('') ?>" class="btn btn-secondary btn-block">Volver a Editar</a>
                                </div>
                                <div class="col-md-6">
                                    <form action="<?= base_url('censo/confirm_save') ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="profile_photo" value="<?= $data['path_photo'] ?>">
                                        <input type="file" name="profile_photo" class="hidden-input">
                                        <button type="submit" class="btn btn-primary btn-block">Confirmar y Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>