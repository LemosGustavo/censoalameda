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

<div class="content-wrapper d-flex align-items-center justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header text-center">
                            <div style="width: 100%; height: 300px; background-image: url('/assets/img/logo_b.jpg'); background-size: cover; background-position: center;"></div>

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
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script {csp-script-nonce}>
    $(document).ready(function() {

        $('#birthdate').datetimepicker({
            maxDate: new Date(),
            format: 'L'
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
</script>