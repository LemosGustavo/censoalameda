<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url("/assets/img/logo.png") ?>">
    <title>Iglesia Alameda | Buscar Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/fontawesome-free/css/all.min.css") ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("/assets/frames/dist/css/adminlte.min.css") ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url("/assets/frames/plugins/sweetalert2/sweetalert2.min.css") ?>">
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url("/assets/customize/css/censo_search.css") ?>">
</head>
<body class="hold-transition">
    <div class="wrapper">
        <!-- Header con logo -->
        <header class="site-header">
            <img src="<?= base_url("/assets/img/logo.png") ?>" alt="Iglesia Alameda" class="site-logo">
            <h2 class="site-title">Iglesia Alameda</h2>
            <a href="<?= base_url('') ?>" class="back-button">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </header>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            

            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header search-card">
                                    <h3 class="card-title"><i class="fas fa-filter mr-2"></i>Buscar por:</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="searchTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="dni-tab" data-toggle="tab" data-target="#dni" type="button" role="tab" aria-controls="dni" aria-selected="true">
                                                <i class="fas fa-id-card mr-1"></i> Por DNI
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="personal-tab" data-toggle="tab" data-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="false">
                                                <i class="fas fa-user mr-1"></i> Por Datos Personales
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-4" id="searchTabsContent">
                                        <div class="tab-pane fade show active" id="dni" role="tabpanel" aria-labelledby="dni-tab">
                                            <form id="dniForm">
                                                <div class="form-group">
                                                    <label for="documento_dni"><i class="fas fa-id-card mr-1"></i>DNI</label>
                                                    <input type="text" class="form-control" id="documento_dni" name="documento_dni" placeholder="Ingrese su DNI" required>
                                                    <small class="form-text text-muted">Ingrese su número de DNI sin puntos.</small>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-custom-censo btn-lg px-5">
                                                        <i class="fas fa-search mr-2"></i>Buscar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                            <form id="personalForm">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name"><i class="fas fa-user mr-1"></i>Nombre</label>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname"><i class="fas fa-user mr-1"></i>Apellido</label>
                                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ingrese su apellido" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="birthdate"><i class="fas fa-calendar-alt mr-1"></i>Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-custom-censo btn-lg px-5">
                                                        <i class="fas fa-search mr-2"></i>Buscar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url("/assets/frames/plugins/jquery/jquery.min.js") ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url("/assets/frames/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("/assets/frames/dist/js/adminlte.min.js") ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url("/assets/frames/plugins/sweetalert2/sweetalert2.min.js") ?>"></script>
    <script>
        $(document).ready(function() {
            const dniForm = $('#dniForm');
            const personalForm = $('#personalForm');
            const dniInput = $('#documento_dni');

            // Validación para DNI (solo números)
            dniInput.on('input', function() {
                let value = $(this).val();
                if (value) {
                    $(this).val(value.replace(/[^0-9]/g, ''));
                }
            });

            dniForm.on('submit', function(e) {
                e.preventDefault();
                const dni = dniInput.val();
                
                // Validación del DNI
                if (!dni) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo vacío',
                        text: 'Por favor ingrese un número de DNI',
                        confirmButtonColor: '#C32F27'
                    });
                    return;
                }

                if (!/^\d+$/.test(dni)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'DNI Inválido',
                        text: 'El DNI debe contener solo números',
                        confirmButtonColor: '#C32F27'
                    });
                    return;
                }

                if (dni.length < 7 || dni.length > 8) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'DNI Inválido',
                        text: 'El DNI debe tener 7 u 8 dígitos',
                        confirmButtonColor: '#C32F27'
                    });
                    return;
                }
                
                // Mostrar indicador de carga
                Swal.fire({
                    title: 'Buscando...',
                    html: 'Por favor espere mientras buscamos su registro',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                searchByDNI(dni);
            });

            personalForm.on('submit', function(e) {
                e.preventDefault();
                const name = $('#name').val();
                const lastname = $('#lastname').val();
                const birthdate = $('#birthdate').val();
                
                // Validación de campos
                if (!name || !lastname || !birthdate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campos incompletos',
                        text: 'Por favor complete todos los campos',
                        confirmButtonColor: '#C32F27'
                    });
                    return;
                }
                
                // Mostrar indicador de carga
                Swal.fire({
                    title: 'Buscando...',
                    html: 'Por favor espere mientras buscamos su registro',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                searchByPersonalData(name, lastname, birthdate);
            });

            function searchByDNI(dni) {
                $.ajax({
                    url: '<?= base_url("censo/search_by_dni") ?>',
                    method: 'POST',
                    data: JSON.stringify({ dni: dni }),
                    contentType: 'application/json',
                    dataType: 'json'
                })
                .done(function(data) {
                    handleSearchResponse(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al realizar la búsqueda. Por favor intente nuevamente.',
                        confirmButtonColor: '#C32F27'
                    });
                });
            }

            function searchByPersonalData(name, lastname, birthdate) {
                $.ajax({
                    url: '<?= base_url("censo/search_by_personal_data") ?>',
                    method: 'POST',
                    data: JSON.stringify({
                        name: name,
                        lastname: lastname,
                        birthdate: birthdate
                    }),
                    contentType: 'application/json',
                    dataType: 'json'
                })
                .done(function(data) {
                    handleSearchResponse(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al realizar la búsqueda. Por favor intente nuevamente.',
                        confirmButtonColor: '#C32F27'
                    });
                });
            }

            function handleSearchResponse(data) {
                Swal.close();
                if (data.found) {
                    if (data.is_head_of_household) {
                        showHouseholdManagement(data.member);
                    } else {
                        Swal.fire({
                            title: 'Registro encontrado',
                            text: '¿Desea editar sus datos?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Sí, editar',
                            confirmButtonColor: '#C32F27',
                            cancelButtonText: 'No, volver',
                            cancelButtonColor: '#6c757d'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Preparar datos para edición
                                $.ajax({
                                    url: '<?= base_url("censo/prepare_edit") ?>',
                                    method: 'POST',
                                    data: JSON.stringify(data.member),
                                    contentType: 'application/json',
                                    dataType: 'json'
                                })
                                .done(function(response) {
                                    if (response.success) {
                                        window.location.href = '/censo/edit_form';
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: response.message || 'Error preparando los datos para edición',
                                            confirmButtonColor: '#C32F27'
                                        });
                                    }
                                })
                                .fail(function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Error de conexión al preparar los datos',
                                        confirmButtonColor: '#C32F27'
                                    });
                                });
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        title: 'Registro no encontrado',
                        text: '¿Desea crear un nuevo registro?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, crear nuevo',
                        confirmButtonColor: '#C32F27',
                        cancelButtonText: 'No, volver a buscar',
                        cancelButtonColor: '#6c757d'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/censo/home';
                        }
                    });
                }
            }

            function showHouseholdManagement(member) {
                Swal.fire({
                    title: 'Gestión de Convivientes',
                    html: `
                        <div class="text-left">
                            <p>Usted es Jefe de Hogar. ¿Desea gestionar los datos de sus convivientes?</p>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="hasSpouse">
                                <label class="form-check-label" for="hasSpouse">
                                    <i class="fas fa-user-friends mr-2"></i>Tengo cónyuge
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hasChildren">
                                <label class="form-check-label" for="hasChildren">
                                    <i class="fas fa-child mr-2"></i>Tengo hijos
                                </label>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#C32F27',
                    cancelButtonText: 'Solo editar mis datos',
                    cancelButtonColor: '#6c757d',
                    preConfirm: () => {
                        return {
                            hasSpouse: document.getElementById('hasSpouse').checked,
                            hasChildren: document.getElementById('hasChildren').checked
                        };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/censo/edit/${member.id}?manage_household=1&spouse=${result.value.hasSpouse}&children=${result.value.hasChildren}`;
                    } else {
                        window.location.href = `/censo/edit/${member.id}`;
                    }
                });
            }
        });
    </script>
</body>
</html>