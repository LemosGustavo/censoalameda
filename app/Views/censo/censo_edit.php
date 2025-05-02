<?= form_open_multipart(base_url('censo/update'), array('data-toggle' => 'validator', 'id' => 'form_censo', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')); ?>
<?= csrf_field(); ?>
<div class="content-wrapper d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header text-center">
                            <h3>Editar Registro</h3>
                        </div>
                        <div class="card-body p-0">
                            <input type="hidden" name="member_id" value="<?= $data['member']->id ?>">

                            <div class="callout callout-personal">
                                <h5>Datos Personales</h5>
                                <!-- Foto de perfil -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="profile_photo">Foto de Perfil</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input"
                                                        id="profile_photo"
                                                        name="profile_photo"
                                                        accept="image/jpeg,image/png,image/gif"
                                                        capture="user">
                                                    <label class="custom-file-label" for="profile_photo">
                                                        <?= $data['member']->path_photo ?: 'Elegir foto' ?>
                                                    </label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button"
                                                        class="btn camera-button"
                                                        id="camera_button"
                                                        onclick="openCamera()">
                                                        <i class="fas fa-camera"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php if ($data['member']->path_photo): ?>
                                                <div class="mt-3 text-center">
                                                    <img id="photo_preview"
                                                        src="<?= base_url('app/Uploads/' . $data['member']->path_photo) ?>"
                                                        alt="Foto actual"
                                                        class="img-thumbnail rounded photo-preview"
                                                        style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Datos básicos -->
                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $data['fields']['name']['label']; ?>
                                        <input type="text" class="form-control" name="name" value="<?= $data['member']->name ?>" required>
                                    </div>
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $data['fields']['lastname']['label']; ?>
                                        <input type="text" class="form-control" name="lastname" value="<?= $data['member']->lastname ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $data['fields']['birthdate']['label']; ?>
                                        <input type="date" class="form-control" name="birthdate" value="<?= $data['member']->birthdate ?>" required>
                                    </div>
                                    <div class="form-group col-md-6 required-field">
                                        <label for="gender_drop">Género</label>
                                        <select id="gender_drop" name="gender_drop" class="form-control" required>
                                            <option value="">Seleccione su género</option>
                                            <?php foreach ($data['genders'] as $gender): ?>
                                                <option value="<?= $gender->id ?>" <?= $gender->id == $data['member']->gender_id ? 'selected' : '' ?>>
                                                    <?= $gender->name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <label for="civil_state_drop">Estado Civil</label>
                                        <select id="civil_state_drop" name="civil_state_drop" class="form-control" required>
                                            <option value="">Seleccione su estado civil</option>
                                            <?php foreach ($data['civil_states'] as $civil_state): ?>
                                                <option value="<?= $civil_state->id ?>" <?= $civil_state->id == $data['member']->civil_state_id ? 'selected' : '' ?>>
                                                    <?= $civil_state->name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $data['fields']['dni_document']['label']; ?>
                                        <input type="text" class="form-control" name="dni_document" value="<?= $data['member']->dni_document ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Resto de secciones del formulario... -->
                            <!-- Se mantiene la misma estructura que censo_home.php pero con los valores precargados -->

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <a href="<?= base_url('censo/search') ?>" class="btn btn-secondary btn-block">Cancelar</a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>

<!-- Scripts necesarios -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script {csp-script-nonce}>
    $(document).ready(function() {
        bsCustomFileInput.init();
        
        // Inicializar select2 y demás plugins
        initializeSelect2('#country', 'Seleccione un país');
        initializeSelect2('#state', 'Seleccione una provincia');
        initializeSelect2('#district', 'Seleccione un departamento');
        initializeSelect2('#locality', 'Seleccione una localidad');
        // ... resto de inicializaciones

        // Manejo de la previsualización de imagen
        $("#profile_photo").change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $("#photo_preview").attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Reutilizar las funciones de censo_home.php
    function openCamera() {
        // ... código existente
    }

    // ... resto de funciones necesarias
</script>