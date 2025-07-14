<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>REGISTROS</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">

    <link href="{{ asset('librerias') }}/assets/css/default/app.min.css" rel="stylesheet" />
    <link href="{{ asset('librerias') }}/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('librerias') }}/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('librerias') }}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('librerias') }}/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="{{ asset('librerias') }}/assets/js/jquery.min.js"></script>
     @vite('resources/css/button.css')
     @vite('resources/css/inicio.css') 
</head>

<body>
<div id="loader" class="loader-screen" >
    <img src= "{{ asset('images/logotipo.png') }}" height="" width="100" alt="">
    <h1>Cargando...</h1>
    <div class="progress-bar-container">
        <div class="progress-bar"></div>
    </div>
</div> 
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <div id="app" class="app app-header-fixed app-sidebar-grid  appSidebarGrid" value="1"  style="display: none;">
        <div id="header" class="app-header" style="background-color: #3c869d;">
            <div class="navbar-header text-center" style="background-color: #03abcf;">
                <a href="#" class="navbar-brand">
                    <p class="navbar-logo text-white text-center" style="font-size: 21px; margin: 0; line-height: 1.2;">
                        BIENVENIDO
                        @auth
                        <span style="display: block; font-size: 15px; margin-top: 5px;">
                            {{ auth()->user()->name }}
                        </span>
                        @endauth
                    </p>
                </a>

                <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
                    <span class="icon-bar" style="background:white;"></span>
                    <span class="icon-bar" style="background:white;"></span>
                    <span class="icon-bar" style="background:white;"></span>
                </button>
            </div>
            <div class="navbar-nav">

                <div class="navbar-item navbar-user dropdown">

                    <a href="{{route('logout')}}"> <button class="btn btn-warning">Log Out</button></a>

                </div>
            </div>
        </div>
        <div id="sidebar" class="app-sidebar app-sidebar-transparent">
            <!-- <div id="sidebar" class="app-sidebar app-sidebar-transparent"> app-sidebar-transparent /// AGREGAR ESTA LINEA PARA PONER DE FONDO UNA IMAGEN -->

            <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
                <div class="menu">

                    <!-- 
                    <div class="menu-item bg-info">
                        <a href="../index.php" class="menu-link">
                            <div class="menu-icon">
                                <i class="fa fa-home text-white"></i>
                            </div>
                            <div class="menu-text text-white">TABLERO PRINCIPAL </div>
                        </a>
                    </div> -->
                    @auth
                    @if (auth()->user()->hasRole('medico'))
                    <div class="menu-item  active">
                        <a href="{{route('historial.index')}}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fa fa-file  text-info"></i>
                            </div>
                            <div class="menu-text text-white">HISTORIA CLINICA </div>
                        </a>
                    </div>
                    @endif
                    @endauth
                    @auth
                    @if (auth()->user()->hasRole('residente'))
                    <div class="menu-item  active">
                        <a href="{{route('evolucion.index')}}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fa fa-file text-info"></i>
                            </div>
                            <div class="menu-text text-white">SOAP </div>
                        </a>
                    </div>
                    @endif
                    @endauth

                    @auth
                    @if (auth()->user()->hasRole('medico'))
                    <div class="menu-item  active">
                        <a href="{{route('kardex.index')}}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fa fa-file text-info"></i>
                            </div>
                            <div class="menu-text text-white">KARDEX</div>
                        </a>
                    </div>
                    @endif
                    @endauth

                    @auth
                    @if (auth()->user()->hasRole('administrador'))
                    <div class="menu-item  active">
                        <a href="{{ route('servicios.index')}}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="menu-text text-white">ADMINISTRACION </div>
                        </a>
                    </div>
                    @endif
                    @endauth
                    @auth
                    @if (auth()->user()->hasRole('administrador'))
                    <div class="menu-item  active">
                        <a href="{{ route('auditoria.index')}}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div class="menu-text text-white">AUDITORIA </div>
                        </a>
                    </div>
                    @endif
                    @endauth
                    @auth
                    @if (auth()->user()->hasRole('administrador'))
                    <div class="menu-item  active">
                        <a href="{{ route('usuarios.index') }}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="menu-text text-white">USUARIOS</div>
                        </a>
                    </div>
                    @endif
                    @endauth

                    <div class="menu-header"></div>

                    <div class="menu-item d-flex">
                        <a href="javascript:;" class="app-sidebar-minify-btn ms-auto bg-info" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left text-white"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-sidebar-bg"></div>
        <div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>



        <div id="content" class="app-content">
            <div class="row g-3">

                @yield('content')

                <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
            </div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


            <script src="{{ asset('librerias') }}/assets/js/vendor.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/js/app.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/js/theme/default.min.js"></script>


            <script src="{{ asset('librerias') }}/assets/plugins/select2/dist/js/select2.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
            <script src="{{ asset('librerias') }}/assets/js/demo/ui-modal-notification.demo.js" type="b10b3b37bdd2098d0b641017-text/javascript"></script>

            <script src="{{ asset('librerias') }}/assets/plugins/select-picker/dist/picker.min.js"></script>

            <script src="{{ asset('librerias') }}/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
            <script type="text/javascript" src="{{ asset('librerias') }}/sweetalert/sweetalert2.min.js"></script>
            <script src="{{ asset('librerias') }}/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="0688136b2ce03af2f011e985-|49" defer=""></script>


            <script>
                $('#table').DataTable({
                    "language": {
                        "sProcessing": "Procesando....",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron registros",
                        "info": "mostrando registros del _START_ al _END_ de un total de  _TOTAL_ ",
                        "infoEmpty": "Ningun dato disponible en esta tabla",
                        "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                        "infoPostFix": "",
                        "search": "BUSCAR:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "searchPlaceholder": "Buscar...",
                        "sLoadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "paginate": {
                            "first": "Primera",
                            "last": "Última",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "oAria": {
                            "sortAscending": "Activar para ordenar la columna de manera ascendente",
                            "sortDescending": "Activar para ordenar la columna de manera descendente"
                        }

                    },
                    "order": [
                        [0, "desc"]
                    ], // Añade esta línea (0 = primera columna)
                    responsive: true
                });
            </script>



            <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict'

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('.needs-validation')

                    // Loop over them and prevent submission
                    Array.prototype.slice.call(forms)
                        .forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })
                })()
            </script>

            <script>
                //<![CDATA[
                function validaNumero(campo) {
                    var elcampo = document.getElementById(campo);
                    if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                        elcampo.value = "";
                        elcampo.focus();
                        $(".mensaje_error").html("<i class='icon-cancel-circle2 mr-1'></i>Debe ingresar un numero");
                    } else {
                        $(".mensaje_error").html("");

                        // Aqui pones el resto de las condiciones usando comparadores u operadores aritmÃ©ticos, ya que estÃ¡s seguro de que trabajas con nÃºmeros 

                    }
                }

                function validarNumero(input) {
                    return (!isNaN(input) && parseInt(input) == input) || (!isNaN(input) && parseFloat(input) == input);
                }

            </script>
            <script>
                window.addEventListener('load', () => {
                    const loader = document.getElementById('loader');
                    const content = document.getElementById('app');

                 
                    setTimeout(() => {
                        loader.classList.add('fade-out');
                        setTimeout(() => {
                            loader.style.display = 'none';
                            content.style.display = 'block';
                        }, 400);
                    }, 1800); 
                });
            </script> 
@stack('scripts')
</body>
</html>            