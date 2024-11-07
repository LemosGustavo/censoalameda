<style>
    .content-wrapper {
        background-image: url('/assets/img/fondo.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-body {
        flex-grow: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .select2-container .select2-dropdown {
        top: 100% !important;
        /* Asegura que siempre se abra hacia abajo */
        bottom: auto !important;
        /* Evita que se abra hacia arriba */
    }
</style>

<?= form_open(base_url('censo/ajax_save'), array('data-toggle' => 'validator', 'id' => 'form_censo', 'autocomplete' => 'off')); ?>
<?// php= csrf_field(); ?>
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
                        <div class="card-body p-0">
                            <!-- Removido el Stepper, solo dejar el contenido necesario -->
                            <div class="callout callout-personal">
                                <h5>Datos Personales</h5>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['name']['label']; ?>
                                        <?php echo $fields['name']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['lastname']['label']; ?>
                                        <?php echo $fields['lastname']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['birthdate']['label']; ?>
                                        <?php echo $fields['birthdate']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['gender_drop']['label']; ?>
                                        <?php echo $fields['gender_drop']['form']; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['civil_state_drop']['label']; ?>
                                        <?php echo $fields['civil_state_drop']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['dni']['label']; ?>
                                        <?php echo $fields['dni']['form']; ?>
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
                                        <div class="form-group">
                                            <label for="country">País</label>
                                            <select id="country" class="form-control">
                                                <option value="">Seleccione un país</option>
                                                <?php foreach ($countries as $country): ?>
                                                    <option value="<?= $country->id; ?>"><?= $country->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="state-container" class="col-md-6 col-lg-6 form-group" style="display: none;">
                                        <label for="state">Provincia</label>
                                        <select id="state" class="form-control" disabled>
                                            <option value="">Seleccione una provincia</option>
                                        </select>
                                    </div>
                                    <div id="district-container" class="col-md-6 col-lg-6 form-group" style="display: none;">
                                        <label for="district">Departamento</label>
                                        <select id="district" class="form-control" disabled>
                                            <option value="">Seleccione un departamento</option>
                                        </select>
                                    </div>
                                    <div id="locality-container" class="col-md-6 col-lg-6 form-group" style="display: none;">
                                        <label for="locality">Localidad</label>
                                        <select id="locality" class="form-control" disabled>
                                            <option value="">Seleccione una localidad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['address']['label']; ?>
                                        <?php echo $fields['address']['form']; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo $fields['address_number']['label']; ?>
                                        <?php echo $fields['address_number']['form']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="callout callout-vocation">
                                <h5>Vocación</h5>
                                <div class="row">
                                    <div class="form-group col-md-6">
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
                                <div id="dropdown_si" class="form-group" style="display: none;">
                                    <?php echo $fields_vocation['voluntary_yes_drop']['label']; ?>
                                    <?php echo $fields_vocation['voluntary_yes_drop']['form']; ?>
                                </div>

                                <!-- Question and Dropdown for "NO" -->
                                <div id="dropdown_no" class="form-group" style="display: none;">
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
                                <div class="row">
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
                                    <!-- Dropdown for "SI" -->
                                    <div id="hijo_drop_si" class="form-group col-md-6" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <?php echo $fields_family['quantity_sons']['label']; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $fields_family['quantity_sons']['form']; ?>
                                            </div>
                                        </div>
                                        <div id="children_inputs"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>¿Eres jefe/a de hogar?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="jefe_si" name="jefe" value="si">
                                            <label for="jefe_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="jefe_no" name="jefe" value="no">
                                            <label for="jefe_no">NO</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="callout callout-cristians">
                                <h5>Crecimiento Cristiano</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>¿De qué manera vivís la celebración cada fin de semana?</label>
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
                                    <div id="grupo_peque_si_div" class="form-group col-md-6" style="display: none;">
                                        <div id="little_group_input"></div>
                                    </div>
                                    <!-- Dropdown for "NO" -->
                                    <div id="grupo_peque_no_div" class="form-group col-md-6" style="display: none;">
                                        <label>¿Te gustaría participar?</label>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="grupo_peque_no_si" name="grupo_peque_no_check" value="si">
                                            <label for="grupo_peque_no_si">SI</label>
                                        </div>
                                        <div class="icheck-carrot d-inline ml-4">
                                            <input type="radio" id="grupo_peque_no_no" name="grupo_peque_no_check" value="no">
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


<script {csp-script-nonce}>
    $(function() {
        // Establecer el mensaje personalizado al campo requerido que no es válido
        $('[required]').on('invalid', function() {
            this.setCustomValidity('Por favor, completa este campo');
        });

        // Limpiar el mensaje de error personalizado cuando el usuario empieza a escribir
        $('[required]').on('input', function() {
            this.setCustomValidity('');
        });

        // Manejar el evento submit del formulario
        $('#form_censo').on('submit', function(event) {
            let isValid = true;

            // Comprobar si hay campos requeridos no completados
            $('[required]').each(function() {
                if (!this.checkValidity()) {
                    isValid = false;
                    this.setCustomValidity('Completa el campo'); // Mensaje personalizado
                    $(this).addClass('is-invalid'); // Añadir clase de error (opcional)
                } else {
                    $(this).removeClass('is-invalid'); // Remover clase de error
                }
            });

            // Si el formulario no es válido, prevenir el envío
            if (!isValid) {
                event.preventDefault(); // Prevenir el envío del formulario
            }
        });
    });



    $(document).ready(function() {

        // $('#form_censo').on('submit', function(e) {
        //     e.preventDefault(); // Previene el envío por defecto
        //     // Aquí se puede agregar la lógica de validación si es necesario
        //     if ($(this).data('bs.validator').isValid()) {
        //         // Si es válido, se envía el formulario
        //         this.submit();
        //     } else {
        //         // Manejar errores de validación
        //         alert('Por favor, completa los campos requeridos.');
        //     }
        // });

        $('#birthdate').datetimepicker({
            maxDate: new Date(),
            format: 'L',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar-alt',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'far fa-trash-alt',
                close: 'far fa-times-circle'
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

        // Evento para manejar el cambio en family_drop
        $('#family_drop').on('change', function() {
            var selectedValues = $(this).find('option:selected').text();
            console.log(selectedValues);
            // Verifica si "Hijo/s" está seleccionado
            if (selectedValues && selectedValues.includes('Hijo/s')) {
                $('#hijo_si').prop('checked', true); // Marca el radio de "Sí"
                toggle_sons(); // Llama a la función para mostrar los campos de hijos
            } else {
                $('#hijo_no').prop('checked', true); // Marca el radio de "No"
                toggle_sons(); // Llama a la función para ocultar los campos de hijos
            }
        });

        // // Añadir el tooltip a cada campo `required`
        // $('input[required], select[required], textarea[required]').each(function() {
        //     const $input = $(this);

        //     // Añadir tooltip con icono de información dentro
        //     $input.attr('data-toggle', 'tooltip')
        //         .attr('data-placement', 'top')
        //         .attr('title', '<i class="fas fa-info-circle"></i> Completa este campo')
        //         .tooltip({
        //             html: true, // Permitir HTML dentro del tooltip
        //             trigger: 'focus' // Mostrar tooltip al enfocar el campo
        //         })
        //         .on('focus', function() {
        //             $(this).tooltip('show'); // Mostrar tooltip al enfocar
        //         })
        //         .on('blur', function() {
        //             $(this).tooltip('hide'); // Ocultar tooltip al perder el foco
        //         });
        // });
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

    function toggle_sons() {
        // Obtener el valor del radio seleccionado
        var hijo = $('input[name="hijo"]:checked').val();

        // Mostrar dropdown correspondiente si se selecciona "SI"
        if (hijo === "si") {
            $('#hijo_drop_si').show();
        }
        // Ocultar dropdown y borrar el contenido si se selecciona "NO"
        else if (hijo === "no") {
            $('#hijo_drop_si').hide();
            $('#quantity_sons').val(''); // Borrar el valor del campo quantity_sons
            $('#children_inputs').empty(); // Limpiar los inputs generados
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
        container.empty(); // Clear previous inputs

        if (numChildren > 0 && numChildren <= 12) {
            for (let i = 1; i <= numChildren; i++) {
                const childDiv = $(`
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="age_${i}">Edad Hijo ${i}</label>
                            <input type="number" class="form-control" id="age_${i}" name="age_${i}" min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="church_${i}">Asiste iglesia Hijo ${i}</label>
                            <select class="form-control" id="church_${i}" name="church_${i}">
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                `);
                container.append(childDiv);
            }
        }
    }
</script>