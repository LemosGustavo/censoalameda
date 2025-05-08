<?= form_open_multipart(base_url('censo/update'), array('data-toggle' => 'validator', 'id' => 'form_censo', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')); ?>
<?= csrf_field(); ?>
<div class="content-wrapper d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header text-center">
                            <div class="cabecera-imagen">
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Está editando un registro existente.
                            </div>

                            <input type="hidden" name="member_id" value="<?= $data['member']->id ?>">

                            <div class="callout callout-personal">
                                <h5>Datos Personales</h5>
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

                            <div class="callout callout-contact">
                                <h5>Contacto</h5>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $data['fields_contact']['email']['label']; ?>
                                        <input type="email" class="form-control" name="email" value="<?= $data['member']->email ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $data['fields_contact']['phone']['label']; ?>
                                        <input type="text" class="form-control" name="phone" value="<?= $data['member']->phone ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $data['fields_contact']['social_media_drop']['label']; ?>
                                        <?php echo $data['fields_contact']['social_media_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $data['fields_contact']['other_socialmedia']['label']; ?>
                                        <?php echo $data['fields_contact']['other_socialmedia']['form']; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="callout callout-house">
                                <h5>Residencia</h5>
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6 required-field">
                                        <div class="form-group required-field">
                                            <label for="country">País</label>
                                            <select id="country" name="country" class="form-control" required>
                                                <option value="">Seleccione un país</option>
                                                <?php foreach ($data['countries'] as $country): ?>
                                                    <option value="<?= $country->id ?>" <?= $country->id == $data['member']->country_id ? 'selected' : '' ?>>
                                                        <?= $country->name ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="state-container" class="col-md-6 col-lg-6 form-group hidden-container">
                                        <label for="state">Provincia</label>
                                        <select id="state" name="state" class="form-control" disabled>
                                            <option value="">Seleccione una provincia</option>
                                        </select>
                                    </div>
                                    <div id="district-container" class="col-md-6 col-lg-6 form-group hidden-container">
                                        <label for="district">Departamento</label>
                                        <select id="district" name="district" class="form-control" disabled>
                                            <option value="">Seleccione un departamento</option>
                                        </select>
                                    </div>
                                    <div id="locality-container" class="col-md-6 col-lg-6 form-group hidden-container">
                                        <label for="locality">Localidad</label>
                                        <select id="locality" name="locality" class="form-control" disabled>
                                            <option value="">Seleccione una localidad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields']['address']['label']; ?>
                                        <input type="text" class="form-control" name="address" value="<?= $data['member']->address ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="callout callout-vocation">
                                <h5>Vocación</h5>
                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $data['fields_vocation']['name_profession']['label']; ?>
                                        <input type="text" class="form-control" name="name_profession" value="<?= $data['member']->name_profession ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $data['fields_vocation']['artistic_skills']['label']; ?>
                                        <input type="text" class="form-control" name="artistic_skills" value="<?= $data['member']->artistic_skills ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>¿Sirves como voluntario en la iglesia?</label>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" id="voluntario_si" name="voluntario" value="si" onclick="toggle_dropdowns()" <?= $data['member']->voluntario == 'si' ? 'checked' : '' ?>>
                                        <label for="voluntario_si">SI</label>
                                    </div>
                                    <div class="icheck-carrot d-inline ml-4">
                                        <input type="radio" id="voluntario_no" name="voluntario" value="no" onclick="toggle_dropdowns()" <?= $data['member']->voluntario == 'no' ? 'checked' : '' ?>>
                                        <label for="voluntario_no">NO</label>
                                    </div>
                                </div>
                                <div id="dropdown_si" class="form-group hidden-container">
                                    <?php echo $data['fields_vocation']['voluntary_yes_drop']['label']; ?>
                                    <?php echo $data['fields_vocation']['voluntary_yes_drop']['form']; ?>
                                </div>
                                <div id="dropdown_no" class="form-group hidden-container">
                                    <?php echo $data['fields_vocation']['voluntary_no_drop']['label']; ?>
                                    <?php echo $data['fields_vocation']['voluntary_no_drop']['form']; ?>
                                </div>
                            </div>

                            <div class="callout callout-family">
                                <h5>Familia</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields_family']['family_drop']['label']; ?>
                                        <?php echo $data['fields_family']['family_drop']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>¿Eres jefe/a de hogar?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="jefe_si" name="jefe" value="si" onclick="toggle_hijos()" <?= $data['member']->boss_family == 1 ? 'checked' : '' ?>>
                                            <label for="jefe_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="jefe_no" name="jefe" value="no" onclick="toggle_hijos()" <?= $data['member']->boss_family == 0 ? 'checked' : '' ?>>
                                            <label for="jefe_no">NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="hijos_section" class="row hidden-container">
                                    <div class="form-group col-md-3">
                                        <label>¿Tienes hijos?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="hijo_si" name="hijo" value="si" onclick="toggle_sons()" <?= $data['member']->quantity_sons > 0 ? 'checked' : '' ?>>
                                            <label for="hijo_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="hijo_no" name="hijo" value="no" onclick="toggle_sons()" <?= $data['member']->quantity_sons == 0 ? 'checked' : '' ?>>
                                            <label for="hijo_no">NO</label>
                                        </div>
                                    </div>
                                    <div id="hijo_drop_si" class="form-group col-md-12 hidden-container">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php echo $data['fields_family']['quantity_sons']['label']; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" name="quantity_sons" id="quantity_sons" value="<?= $data['member']->quantity_sons ?>">
                                            </div>
                                        </div>
                                        <div id="children_inputs"></div>
                                    </div>
                                </div>
                                <div id="conyuge_section" class="row hidden-container">
                                    <div id="conyuge_drop" class="form-group col-md-12 hidden-container">
                                        <div id="conyuge_inputs"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="callout callout-cristians">
                                <h5>Crecimiento Cristiano</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>¿De qué manera vivís mayormente la celebración durante cada fin de semana?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="presencial" name="celebracion" value="presencial" <?= $data['member']->celebracion == 'presencial' ? 'checked' : '' ?>>
                                            <label for="presencial">Presencial</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="virtual" name="celebracion" value="virtual" <?= $data['member']->celebracion == 'virtual' ? 'checked' : '' ?>>
                                            <label for="virtual">Virtual</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields_cristians']['experiences_drop']['label']; ?>
                                        <?php echo $data['fields_cristians']['experiences_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields_cristians']['services_drop']['label']; ?>
                                        <?php echo $data['fields_cristians']['services_drop']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>¿Asistes a un Grupo Pequeño?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="grupo_peque_si_radio" name="grupo" value="si" onclick="toggle_group()" <?= $data['member']->grupo == 'si' ? 'checked' : '' ?>>
                                            <label for="grupo_peque_si_radio">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="grupo_peque_no_radio" name="grupo" value="no" onclick="toggle_group()" <?= $data['member']->grupo == 'no' ? 'checked' : '' ?>>
                                            <label for="grupo_peque_no_radio">NO</label>
                                        </div>
                                    </div>
                                    <div id="grupo_peque_si_div" class="form-group col-md-6 hidden-container">
                                        <div id="little_group_input"></div>
                                    </div>
                                    <div id="grupo_peque_no_div" class="form-group col-md-6 hidden-container">
                                        <label>¿Te gustaría participar?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="grupo_peque_no_si" name="participate_gp" value="si" <?= $data['member']->participate_gp == 'si' ? 'checked' : '' ?>>
                                            <label for="grupo_peque_no_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="grupo_peque_no_no" name="participate_gp" value="no" <?= $data['member']->participate_gp == 'no' ? 'checked' : '' ?>>
                                            <label for="grupo_peque_no_no">NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields_cristians']['interests_drop']['label']; ?>
                                        <?php echo $data['fields_cristians']['interests_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields_cristians']['needs_drop']['label']; ?>
                                        <?php echo $data['fields_cristians']['needs_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo $data['fields_cristians']['lifestage_drop']['label']; ?>
                                        <?php echo $data['fields_cristians']['lifestage_drop']['form']; ?>
                                    </div>
                                </div>
                            </div>

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

        // Inicializar los campos según los valores existentes
        if ($('#jefe_si').is(':checked')) {
            toggle_hijos();
        }
        if ($('#hijo_si').is(':checked')) {
            toggle_sons();
        }
        if ($('#voluntario_si').is(':checked')) {
            toggle_dropdowns();
        }
        if ($('#grupo_peque_si_radio').is(':checked')) {
            toggle_group();
        }
    });

    // Reutilizar las funciones de censo_home.php
    function openCamera() {
        const cameraInput = document.createElement('input');
        cameraInput.type = 'file';
        cameraInput.accept = 'image/*';
        cameraInput.capture = 'user';
        cameraInput.onchange = function(e) {
            const file = e.target.files[0];
            handleImageFile(file);
        };
        cameraInput.click();
    }

    function handleImageFile(file) {
        const preview = $("#photo_preview");
        const fileReader = new FileReader();
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        
        if (file && validImageTypes.includes(file.type)) {
            const maxSize = 3 * 1024 * 1024;
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'La imagen debe ser menor a 3MB',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            fileReader.onload = function(e) {
                preview.attr('src', e.target.result).show();
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                $("#profile_photo")[0].files = dataTransfer.files;
                $(".custom-file-label").text(file.name);
            };
            fileReader.readAsDataURL(file);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Archivo no válido',
                text: 'Por favor, selecciona una imagen (JPG, PNG o GIF)',
                confirmButtonText: 'Entendido'
            });
        }
    }

    function toggle_dropdowns() {
        var voluntario = $('input[name="voluntario"]:checked').val();
        if (voluntario === "si") {
            $('#dropdown_si').show();
            $('#dropdown_no').hide();
        } else if (voluntario === "no") {
            $('#dropdown_si').hide();
            $('#dropdown_no').show();
        }
    }

    function toggle_hijos() {
        var jefe = $('input[name="jefe"]:checked').val();
        if (jefe === "si") {
            $('#hijos_section').show();
        } else {
            $('#hijos_section').hide();
            $('input[name="hijo"]').prop('checked', false);
            $('#hijo_drop_si').hide();
            $('#quantity_sons').val('');
            $('#children_inputs').empty();
        }
    }

    function toggle_sons() {
        var hijo = $('input[name="hijo"]:checked').val();
        if (hijo === "si") {
            $('#hijo_drop_si').show();
        } else if (hijo === "no") {
            $('#hijo_drop_si').hide();
            $('#quantity_sons').val('');
            $('#children_inputs').empty();
        }
    }

    function toggle_group() {
        var grupo_peque = $('input[name="grupo"]:checked').val();
        if (grupo_peque === "si") {
            $('#grupo_peque_si_div').show();
            $('#grupo_peque_no_div').hide();
            generateGroupInputs();
        } else if (grupo_peque === "no") {
            $('#grupo_peque_si_div').hide();
            $('#grupo_peque_no_div').show();
            $('#little_group_input').empty();
        }
    }

    function generateGroupInputs() {
        const container = $('#little_group_input');
        container.empty();

        const childDiv = $(`
            <div class="row mb-2">
                <div class="col-md-6">
                    <label for="name_guia">Nombre completo de Guía/s</label>
                    <input type="text" class="form-control" id="name_guia" name="name_guia" value="<?= $data['member']->name_guia ?>">
                </div>
                <div class="col-md-6">
                    <label for="name_group">Nombre Grupo (opcional)</label>
                    <input type="text" class="form-control" id="name_group" name="name_group" value="<?= $data['member']->name_group ?>">
                </div>
            </div>
        `);
        container.append(childDiv);
    }

    function initializeSelect2(selector, placeholder) {
        $(selector).select2({
            placeholder: placeholder,
            dropdownAutoWidth: true,
            dropdownParent: $(selector).parent()
        });
    }

    function initializeSelect2Multiple(selector, placeholder) {
        $(selector).select2({
            placeholder: placeholder,
            dropdownAutoWidth: true,
            dropdownParent: $(selector).parent(),
            multiple: true,
            allowClear: true,
            tags: true
        });
    }
</script>