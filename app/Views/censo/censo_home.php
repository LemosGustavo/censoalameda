<?= form_open_multipart(base_url('censo/preview'), array('data-toggle' => 'validator', 'id' => 'form_censo', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data')); ?>
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
                                                        capture="user"
                                                        required>
                                                    <label class="custom-file-label" for="profile_photo">Elegir foto</label>
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
                                            <small class="form-text text-muted mt-2">
                                                <i class="fas fa-info-circle"></i> Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 3MB
                                            </small>
                                            <div class="mt-3 text-center">
                                                <img id="photo_preview"
                                                    src="#"
                                                    alt="Vista previa"
                                                    class="img-thumbnail rounded photo-preview"
                                                    style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields['name']['label']; ?>
                                        <?php echo $fields['name']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields['lastname']['label']; ?>
                                        <?php echo $fields['lastname']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields['birthdate']['label']; ?>
                                        <?php echo $fields['birthdate']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields['gender_drop']['label']; ?>
                                        <?php echo $fields['gender_drop']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields['civil_state_drop']['label']; ?>
                                        <?php echo $fields['civil_state_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields['dni_document']['label']; ?>
                                        <?php echo $fields['dni_document']['form']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="callout callout-contact">
                                <h5>Contacto</h5>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $fields_contact['email']['label']; ?>
                                        <?php echo $fields_contact['email']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields_contact['phone']['label']; ?>
                                        <?php echo $fields_contact['phone']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $fields_contact['social_media_drop']['label']; ?>
                                        <?php echo $fields_contact['social_media_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields_contact['other_socialmedia']['label']; ?>
                                        <?php echo $fields_contact['other_socialmedia']['form']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="callout callout-house">
                                <h5>Residencia</h5>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group required-field">
                                            <label for="country">País</label>
                                            <select id="country" name="country" class="form-control" required>
                                                <option value="">Seleccione un país</option>
                                                <?php foreach ($countries as $country): ?>
                                                    <option value="<?= $country->id; ?>"><?= $country->name; ?></option>
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
                                        <?php echo $fields['address']['label']; ?>
                                        <?php echo $fields['address']['form']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="callout callout-vocation">
                                <h5>Vocación</h5>
                                <div class="row">
                                    <div class="form-group col-md-6 required-field">
                                        <?php echo $fields_vocation['name_profession']['label']; ?>
                                        <?php echo $fields_vocation['name_profession']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields_vocation['artistic_skills']['label']; ?>
                                        <?php echo $fields_vocation['artistic_skills']['form']; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>¿Sirves como voluntario en la iglesia?</label>
                                    <div class="icheck-success d-inline">
                                        <input type="radio" id="voluntario_si" name="voluntario" value="si" onclick="toggle_dropdowns()">
                                        <label for="voluntario_si">SI</label>
                                    </div>
                                    <div class="icheck-carrot d-inline ml-4">
                                        <input type="radio" id="voluntario_no" name="voluntario" value="no" onclick="toggle_dropdowns()">
                                        <label for="voluntario_no">NO</label>
                                    </div>
                                </div>
                                <!-- Dropdown for "SI" -->
                                <div id="dropdown_si" class="form-group hidden-container">
                                    <?php echo $fields_vocation['voluntary_yes_drop']['label']; ?>
                                    <?php echo $fields_vocation['voluntary_yes_drop']['form']; ?>
                                </div>

                                <!-- Question and Dropdown for "NO" -->
                                <div id="dropdown_no" class="form-group hidden-container">
                                    <?php echo $fields_vocation['voluntary_no_drop']['label']; ?>
                                    <?php echo $fields_vocation['voluntary_no_drop']['form']; ?>
                                </div>

                            </div>
                            <div class="callout callout-family">
                                <h5>Familia</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $fields_family['family_drop']['label']; ?>
                                        <?php echo $fields_family['family_drop']['form']; ?>
                                    </div>
                                </div>

                                <!-- JEFE DE HOGAR -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>¿Eres jefe/a de hogar?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="jefe_si" name="jefe" value="si" onclick="toggle_hijos()">
                                            <label for="jefe_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="jefe_no" name="jefe" value="no" onclick="toggle_hijos()">
                                            <label for="jefe_no">NO</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- HIJOS (se muestra solo si jefe de hogar es SI) -->
                                <div id="hijos_section" class="row hidden-container">
                                    <div class="form-group col-md-3">
                                        <label>¿Tienes hijos?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="hijo_si" name="hijo" value="si" onclick="toggle_sons()">
                                            <label for="hijo_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="hijo_no" name="hijo" value="no" onclick="toggle_sons()">
                                            <label for="hijo_no">NO</label>
                                        </div>
                                    </div>

                                    <!-- SI tiene hijos -->
                                    <div id="hijo_drop_si" class="form-group col-md-12 hidden-container">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php echo $fields_family['quantity_sons']['label']; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $fields_family['quantity_sons']['form']; ?>
                                            </div>
                                        </div>
                                        <div id="children_inputs"></div>
                                    </div>
                                </div>

                                <!-- CONYUGE (se muestra solo si EXISTE CONYUGE en drop) -->
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
                                            <input type="radio" id="presencial" name="celebracion" value="presencial">
                                            <label for="presencial">Presencial</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="virtual" name="celebracion" value="virtual">
                                            <label for="virtual">Virtual</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $fields_cristians['experiences_drop']['label']; ?>
                                        <?php echo $fields_cristians['experiences_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo $fields_cristians['services_drop']['label']; ?>
                                        <?php echo $fields_cristians['services_drop']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>¿Asistes a un Grupo Pequeño?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="grupo_peque_si_radio" name="grupo" value="si" onclick="toggle_group()">
                                            <label for="grupo_peque_si_radio">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="grupo_peque_no_radio" name="grupo" value="no" onclick="toggle_group()">
                                            <label for="grupo_peque_no_radio">NO</label>
                                        </div>
                                    </div>

                                    <!-- Dropdown for "SI" -->
                                    <div id="grupo_peque_si_div" class="form-group col-md-6 hidden-container">
                                        <div id="little_group_input"></div>
                                    </div>
                                    <!-- Dropdown for "NO" -->
                                    <div id="grupo_peque_no_div" class="form-group col-md-6 hidden-container">
                                        <label>¿Te gustaría participar?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="grupo_peque_no_si" name="participate_gp" value="si">
                                            <label for="grupo_peque_no_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="grupo_peque_no_no" name="participate_gp" value="no">
                                            <label for="grupo_peque_no_no">NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo $fields_cristians['interests_drop']['label']; ?>
                                        <?php echo $fields_cristians['interests_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo $fields_cristians['needs_drop']['label']; ?>
                                        <?php echo $fields_cristians['needs_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo $fields_cristians['lifestage_drop']['label']; ?>
                                        <?php echo $fields_cristians['lifestage_drop']['form']; ?>
                                    </div>
                                </div>

                            </div>
                            <?php echo form_submit(array('class' => 'btn btn-primary', 'title' => 'Enviar', 'form' => 'form_censo'), 'Enviar') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>

<!-- Agregar justo antes del script con {csp-script-nonce} -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

<script {csp-script-nonce}>
    $(document).ready(function() {
        console.log('Documento listo');

        // Agregar clase required-field a los campos requeridos
        $('input[required], select[required], textarea[required]').each(function() {
            $(this).closest('.form-group').addClass('required-field');
        });

        // Mapeo de nombres de campos a etiquetas en español
        const fieldLabels = {
            'profile_photo': 'Foto de perfil',
            'name': 'Nombre',
            'lastname': 'Apellido',
            'birthdate': 'Fecha de Nacimiento',
            'gender_drop': 'Género',
            'civil_state_drop': 'Estado Civil',
            'dni_document': 'DNI',
            'email': 'Email',
            'phone': 'Teléfono',
            'address': 'Dirección',
            'country': 'País',
            'state': 'Provincia',
            'district': 'Departamento',
            'locality': 'Localidad',
            'name_profession': 'Profesión/Oficio',
            'social_media_drop': 'Redes Sociales',
            'voluntary_yes_drop': 'Áreas de Servicio',
            'voluntary_no_drop': 'Áreas de Interés',
            'family_drop': 'Composición Familiar',
            'experiences_drop': 'Experiencias',
            'services_drop': 'Servicios',
            'interests_drop': 'Intereses',
            'needs_drop': 'Necesidades',
            'lifestage_drop': 'Etapa de Vida',
            'celebracion': 'Forma de Celebración',
            'grupo': 'Grupo Pequeño',
            'name_guia': 'Nombre del Guía',
            'name_group': 'Nombre del Grupo'
        };

        // Evento click en el botón de envío
        $('input[type="submit"]').on('click', function(event) {
            console.log('Validando formulario');
            event.preventDefault();

            let isValid = true;
            let invalidFields = [];

            // Validación de campos requeridos
            $('[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    let fieldName = $(this).attr('name') || $(this).attr('id');
                    invalidFields.push(fieldLabels[fieldName] || fieldName);
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            // Validación específica para DNI
            const dni = $('#dni_document').val();
            if (dni && (dni.length < 7 || dni.length > 8)) {
                isValid = false;
                invalidFields.push('DNI (debe tener entre 7 y 8 dígitos)');
                $('#dni_document').addClass('is-invalid');
            }

            // Validación de email si está presente
            const email = $('#email').val();
            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                isValid = false;
                invalidFields.push('Email (formato inválido)');
                $('#email').addClass('is-invalid');
            }

            // Validación de teléfono si está presente
            const phone = $('#phone').val();
            if (phone && (phone.length < 8 || phone.length > 20)) {
                isValid = false;
                invalidFields.push('Teléfono (debe tener entre 8 y 20 caracteres)');
                $('#phone').addClass('is-invalid');
            }

            // Validación de dirección si está presente
            const address = $('#address').val();
            if (address && (address.length < 5 || address.length > 100)) {
                isValid = false;
                invalidFields.push('Dirección (debe tener entre 5 y 100 caracteres)');
                $('#address').addClass('is-invalid');
            }

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Campos requeridos o inválidos',
                    html: 'Por favor, corrige los siguientes campos:<br><br>' +
                        invalidFields.map(field => `• ${field}`).join('<br>'),
                    confirmButtonText: 'Entendido'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: '¡Formulario válido!',
                    text: 'Todos los campos están correctamente completados',
                    confirmButtonText: 'Enviar',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form_censo').submit();
                    }
                });
            }
        });

        // Limpiar mensajes de error cuando el usuario empieza a escribir
        $('[required]').on('input', function() {
            $(this).removeClass('is-invalid');
            if ($(this).val().trim()) {
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
            }
        });

        // Inicialización de Select2 en todos los dropdowns
        function initializeSelect2(selector, placeholder) {
            $(selector).select2({
                placeholder: placeholder,
                dropdownAutoWidth: true, // Ajustar el ancho automáticamente
                dropdownParent: $(selector).parent(), // Garantiza que el dropdown se ancle al contenedor correcto
            });
        }

        function initializeSelect2Multiple(selector, placeholder) {
            $(selector).select2({
                placeholder: placeholder,
                dropdownAutoWidth: true,
                dropdownParent: $(selector).parent(),
                multiple: true,
                allowClear: true,
                tags: true // Permite la entrada de nuevas opciones
            });
        }

        // Inicializar Select2 en cada uno de los dropdowns
        initializeSelect2('#country', 'Seleccione un país');
        initializeSelect2('#state', 'Seleccione una provincia');
        initializeSelect2('#district', 'Seleccione un departamento');
        initializeSelect2('#locality', 'Seleccione una localidad');
        initializeSelect2Multiple('#social_media_drop', 'Seleccione Redes Sociales');
        initializeSelect2Multiple('#voluntary_yes_drop', 'Seleccione área de servicio');
        initializeSelect2Multiple('#voluntary_no_drop', 'Seleccione área de servicio');
        initializeSelect2Multiple('#family_drop', 'Seleccione familiar');
        initializeSelect2Multiple('#experiences_drop', 'Seleccione experiencia');
        initializeSelect2Multiple('#services_drop', 'Seleccione servicio');
        initializeSelect2Multiple('#interests_drop', 'Seleccione interés');
        initializeSelect2Multiple('#needs_drop', 'Seleccione necesidad');
        initializeSelect2Multiple('#lifestage_drop', 'Seleccione etapa de vida');

        // Ocultar dropdowns hasta que se seleccione "Argentina"
        $('#country').change(function() {
            let countryId = $(this).val();
            let countryName = $(this).find('option:selected').text();
            console.log(countryName);
            if (countryName === 'Argentina') { // Suponiendo que el id de Argentina es 'AR'
                $('#state-container').fadeIn(); // Mostrar el contenedor de provincias
                $.ajax({
                    url: '/location/get_states_by_country/' + countryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#state').prop('disabled', false).html('<option value="">Seleccione una provincia</option>');
                        $.each(data, function(key, state) {
                            $('#state').append('<option value="' + state.api_states_id + '" data-id="' + state.id + '">' + state.name + '</option>');
                        });
                    }
                });
            } else {
                // Ocultar dropdowns si no es Argentina
                $('#state-container, #district-container, #locality-container').fadeOut();
                $('#state').prop('disabled', true).html('<option value="">Seleccione una provincia</option>');
                $('#district').prop('disabled', true).html('<option value="">Seleccione un departamento</option>');
                $('#locality').prop('disabled', true).html('<option value="">Seleccione una localidad</option>');
            }
        });

        // Cargar departamentos al cambiar la provincia
        $('#state').change(function() {
            let stateVal = $(this).val();
            let stateId = $('#state option:selected').data('id');
            if (stateId) {
                $('#district-container').fadeIn(); // Mostrar el contenedor de departamentos
                $.ajax({
                    url: '/location/get_districts_by_state/' + stateVal,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district').prop('disabled', false).html('<option value="">Seleccione un departamento</option>');
                        $.each(data, function(key, district) {
                            $('#district').append('<option value="' + district.api_districts_id + '" data-id="' + district.id + '">' + district.name + '</option>');
                        });
                    }
                });
            } else {
                $('#district-container, #locality-container').fadeOut();
                $('#district').prop('disabled', true).html('<option value="">Seleccione un departamento</option>');
                $('#locality').prop('disabled', true).html('<option value="">Seleccione una localidad</option>');
            }
        });

        // Cargar localidades al cambiar el departamento
        $('#district').change(function() {
            let districtVal = $(this).val();
            let districtId = $('#district option:selected').data('id');
            if (districtId) {
                $('#locality-container').fadeIn(); // Mostrar el contenedor de localidades
                $.ajax({
                    url: '/location/get_localities_by_district/' + districtVal,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#locality').prop('disabled', false).html('<option value="">Seleccione una localidad</option>');
                        $.each(data, function(key, locality) {
                            $('#locality').append('<option value="' + locality.api_localities_id + '" data-id="' + locality.id + '">' + locality.name + '</option>');
                        });
                    }
                });
            } else {
                $('#locality-container').fadeOut();
                $('#locality').prop('disabled', true).html('<option value="">Seleccione una localidad</option>');
            }
        });

        $('#quantity_sons').on('input', function() {
            generateChildInputs();
        });

        // Detectar si es un dispositivo móvil
        const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

        // Mostrar/ocultar el botón de cámara según el dispositivo
        if (!isMobile) {
            $('#camera_button').hide();
        }

        // Mejorar la gestión de la cámara en móviles
        if ('mediaDevices' in navigator && 'getUserMedia' in navigator.mediaDevices) {
            $('#camera_button').prop('disabled', false);
        } else {
            $('#camera_button').prop('disabled', true);
            $('#camera_button').attr('title', 'Cámara no disponible');
        }
    });

    function toggle_dropdowns() {
        // Obtener el valor del radio seleccionado
        var voluntario = $('input[name="voluntario"]:checked').val();

        // Mostrar dropdown correspondiente si se selecciona "SI"
        if (voluntario === "si") {
            $('#dropdown_si').show();
            $('#dropdown_no_question').hide();
            $('#dropdown_no').hide();
        }
        // Mostrar dropdown y pregunta si se selecciona "NO"
        else if (voluntario === "no") {
            $('#dropdown_si').hide();
            $('#dropdown_no_question').show();
            $('#dropdown_no').show();
        }
    }

    function toggle_hijos() {
        var jefe = $('input[name="jefe"]:checked').val();
        // var family_drop = $('#family_drop').val();

        if (jefe === "si") {
            $('#hijos_section').show();
            // // Verificar si hay cónyuge seleccionado
            // if (family_drop && family_drop.includes('5')) { // 5 es el ID de Cónyuge en la tabla family
            //     $('#conyuge_section').show();
            //     $('#conyuge_drop').show();
            //     generateConyugeInputs();
            // } else {
            //     $('#conyuge_section').hide();
            //     $('#conyuge_drop').hide();
            //     $('#conyuge_inputs').empty();
            // }
        } else {
            // Ocultar todo y resetear valores si pone NO
            $('#hijos_section').hide();
            // $('#conyuge_section').hide();
            $('input[name="hijo"]').prop('checked', false);
            $('#hijo_drop_si').hide();
            $('#quantity_sons').val('');
            $('#children_inputs').empty();
            // $('#conyuge_inputs').empty();
        }
    }

    // Agregar evento change para family_drop
    $('#family_drop').on('change', function() {
        var jefe = $('input[name="jefe"]:checked').val();
        var family_drop = $(this).val();

        // if (jefe === "si" && family_drop && family_drop.includes('5')) {
        if (family_drop && family_drop.includes('5')) {
            $('#conyuge_section').show();
            $('#conyuge_drop').show();
            generateConyugeInputs();
        } else {
            $('#conyuge_section').hide();
            $('#conyuge_drop').hide();
            $('#conyuge_inputs').empty();
        }
    });

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
        // Obtener el valor del radio seleccionado
        var grupo_peque = $('input[name="grupo"]:checked').val();
        console.log(grupo_peque);

        // Mostrar dropdown correspondiente si se selecciona "SI"
        if (grupo_peque === "si") {
            $('#grupo_peque_si_div').show();
            $('#grupo_peque_no_div').hide();
            generateGroupInputs();
        }
        // Ocultar dropdown y borrar el contenido si se selecciona "NO"
        else if (grupo_peque === "no") {
            $('#grupo_peque_si_div').hide();
            $('#grupo_peque_no_div').show();
            $('#little_group_input').empty(); // Limpiar los inputs generados
        }
    }

    function generateGroupInputs() {
        const container = $('#little_group_input');
        container.empty(); // Clear previous inputs

        const childDiv = $(`
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="name_guia">Nombre completo de Guía/s</label>
                            <input type="text" class="form-control" id="name_guia" name="name_guia" >
                        </div>
                        <div class="col-md-6">
                            <label for="name_group">Nombre Grupo (opcional)</label>
                            <input type="text" class="form-control" id="name_group" name="name_group">                            
                        </div>
                    </div>
                `);
        container.append(childDiv);

    }

    function generateChildInputs() {
        const container = $('#children_inputs');
        const numChildren = parseInt($('#quantity_sons').val());
        container.empty(); // Limpiar inputs anteriores

        if (numChildren > 0 && numChildren <= 12) {
            for (let i = 1; i <= numChildren; i++) {
                const childDiv = $(`
                <div class="border p-2 mb-3 rounded bg-light">
                    <h6 class="mb-2">Hijo ${i}</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="name_${i}">Nombre</label>
                            <input type="text" class="form-control" id="name_${i}" name="name_${i}">
                        </div>
                        <div class="col-md-3">
                            <label for="surname_${i}">Apellido</label>
                            <input type="text" class="form-control" id="surname_${i}" name="surname_${i}">
                        </div>
                        <div class="col-md-3 date">
                            <label for="birthdate_${i}">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="birthdate_${i}" name="birthdate_${i}">
                        </div>
                        <div class="col-md-3">
                            <label for="dni_${i}">DNI</label>
                            <input type="text" placeholder="12345678 sin puntos" class="form-control" id="dni_${i}" name="dni_${i}" maxlength="15">
                        </div>
                        <div class="col-md-3">
                            <label for="church_${i}">Asiste iglesia</label>
                            <select class="form-control" id="church_${i}" name="church_${i}">
                                <option value="">Seleccione</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="coexists_${i}">Convive</label>
                            <select class="form-control" id="coexists_${i}" name="coexists_${i}">
                                <option value="">Seleccione</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>
            `);
                container.append(childDiv);
            }
        }
    }

    function generateConyugeInputs() {
        const container = $('#conyuge_inputs');
        container.empty(); // Limpiar inputs anteriores

        const conyugeDiv = $(`
            <div class="border p-2 mb-3 rounded bg-light">
                <h6 class="mb-2">Cónyuge</h6>
                <div class="row">
                    <div class="col-md-3">
                        <label for="name_conyuge">Nombre</label>
                        <input type="text" class="form-control" id="name_conyuge" name="name_conyuge">
                    </div>
                    <div class="col-md-3">
                        <label for="surname_conyuge">Apellido</label>
                        <input type="text" class="form-control" id="surname_conyuge" name="surname_conyuge">
                    </div>
                    <div class="col-md-3 date">
                        <label for="birthdate_conyuge">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthdate_conyuge" name="birthdate_conyuge">
                    </div>
                    <div class="col-md-3">
                        <label for="dni_conyuge">DNI</label>
                        <input type="text" placeholder="12345678 sin puntos" class="form-control" id="dni_conyuge" name="dni_conyuge" maxlength="15">
                    </div>
                    <div class="col-md-3">
                        <label for="church_conyuge">Asiste iglesia</label>
                        <select class="form-control" id="church_conyuge" name="church_conyuge">
                            <option value="">Seleccione</option>
                            <option value="si">Sí</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>
        `);
        container.append(conyugeDiv);
    }

    // Inicializar el plugin bs-custom-file-input
    $(document).ready(function() {
        bsCustomFileInput.init();

        // Previsualización de la imagen
        $("#profile_photo").change(function() {
            const file = this.files[0];
            const fileReader = new FileReader();
            const preview = $("#photo_preview");

            // Validar tamaño (máximo 3MB)
            const maxSize = 3 * 1024 * 1024; // 3MB en bytes
            if (file && file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'La imagen debe ser menor a 3MB',
                });
                this.value = ''; // Limpiar el input
                preview.hide();
                return;
            }

            // Validar el tipo de archivo
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (file && validImageTypes.includes(file.type)) {
                fileReader.onload = function(e) {
                    preview.attr('src', e.target.result);
                    preview.show();
                };
                fileReader.readAsDataURL(file);
            } else {
                // Si no es una imagen válida
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo no válido',
                    text: 'Por favor, selecciona una imagen (JPG, PNG o GIF)',
                });
                this.value = ''; // Limpiar el input
                preview.hide();
            }
        });
    });

    // Función para abrir la cámara
    function openCamera() {
        // Crear un input file temporal
        const cameraInput = document.createElement('input');
        cameraInput.type = 'file';
        cameraInput.accept = 'image/*';
        cameraInput.capture = 'user';

        // Manejar el cambio cuando se toma una foto
        cameraInput.onchange = function(e) {
            const file = e.target.files[0];
            handleImageFile(file);
        };

        // Simular clic en el input
        cameraInput.click();
    }

    // Función para manejar el archivo de imagen
    function handleImageFile(file) {
        const preview = $("#photo_preview");
        const fileReader = new FileReader();

        // Validar el tipo de archivo
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (file && validImageTypes.includes(file.type)) {
            // Validar tamaño
            const maxSize = 3 * 1024 * 1024; // 3MB
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'La imagen debe ser menor a 3MB',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            // Mostrar la imagen
            fileReader.onload = function(e) {
                preview.attr('src', e.target.result);
                preview.show();

                // Crear un nuevo DataTransfer y asignar el archivo
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                // Asignar los archivos al input
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

    // Actualizar el manejador del input file existente
    $("#profile_photo").change(function() {
        const file = this.files[0];
        if (file) {
            handleImageFile(file);
        }
    });
</script>

<script {csp-script-nonce}>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('profile_photo');
        const photoPreview = document.getElementById('photo_preview');
        const fileLabel = document.querySelector('.custom-file-label');

        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validar el tamaño del archivo (3MB máximo)
                if (file.size > 3 * 1024 * 1024) {
                    alert('El archivo es demasiado grande. El tamaño máximo permitido es 3MB.');
                    photoInput.value = '';
                    photoPreview.src = '#';
                    fileLabel.textContent = 'Elegir foto';
                    return;
                }

                // Validar el tipo de archivo
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Formato de archivo no válido. Por favor, selecciona una imagen JPG, PNG o GIF.');
                    photoInput.value = '';
                    photoPreview.src = '#';
                    fileLabel.textContent = 'Elegir foto';
                    return;
                }

                // Mostrar el nombre del archivo
                fileLabel.textContent = file.name;

                // Crear una vista previa de la imagen
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                photoPreview.src = '#';
                fileLabel.textContent = 'Elegir foto';
            }
        });

        // Función para abrir la cámara
        window.openCamera = function() {
            photoInput.click();
        };
    });
</script>