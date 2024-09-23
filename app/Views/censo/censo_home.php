<style>
    /* Estilos personalizados del Stepper */
    .bs-stepper-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: radial-gradient(circle, #ffffff, #d1d8e0);
        box-shadow: inset -3px -3px 15px rgba(255, 255, 255, 0.9),
            inset 3px 3px 8px rgba(0, 0, 0, 0.1),
            6px 6px 20px rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        color: rgba(0, 0, 0, 0.5);
        font-weight: bold;
    }

    .step.active .bs-stepper-circle {
        background: radial-gradient(circle, #f0f0f0, #a4b0be);
        color: #333;
    }

    .bs-stepper-header .line {
        display: none;
    }

    .card {
        width: 80%;
        max-width: 1200px;
        margin: 20px auto;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .bs-stepper-content {
        padding: 20px;
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
                        <div class="card-header">
                            <h3 class="card-title">CENSO ALAMEDA</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#logins-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#information-part">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="bs-stepper-content">
                                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                        <div class="callout callout-info">
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
                                            </div>
                                        </div>
                                        <div class="callout callout-warning">
                                            <h5>Residencia</h5>
                                            <div class="row">
                                                <!-- Dropdown País -->
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

                                                <!-- Dropdown Provincia -->
                                                <div id="state-container" class="col-md-6 col-lg-6 form-group" style="display: none;">
                                                    <label for="state">Provincia</label>
                                                    <select id="state" class="form-control" disabled>
                                                        <option value="">Seleccione una provincia</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Dropdown Departamento -->
                                                <div id="district-container" class="col-md-6 col-lg-6 form-group" style="display: none;">
                                                    <label for="district">Departamento</label>
                                                    <select id="district" class="form-control" disabled>
                                                        <option value="">Seleccione un departamento</option>
                                                    </select>
                                                </div>

                                                <!-- Dropdown Localidad -->
                                                <div id="locality-container" class="col-md-6 col-lg-6 form-group" style="display: none;">
                                                    <label for="locality">Localidad</label>
                                                    <select id="locality" class="form-control" disabled>
                                                        <option value="">Seleccione una localidad</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-secondary align-items-md-end" onclick="stepper.next()">Siguiente</button>
                                    </div>
                                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                        <button class="btn btn-primary" onclick="stepper.previous()">Anterior</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>
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

        // Inicializar Select2 en cada uno de los dropdowns
        initializeSelect2('#country', 'Seleccione un país');
        initializeSelect2('#state', 'Seleccione una provincia');
        initializeSelect2('#district', 'Seleccione un departamento');
        initializeSelect2('#locality', 'Seleccione una localidad');

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

    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    });
</script>