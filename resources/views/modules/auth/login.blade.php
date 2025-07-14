<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="description" content="CERAMICA TITAN">
    <title>Login | Hospital</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS [ REQUIRED ] -->
    <link rel="stylesheet" href="{{ asset('librerias') }}/assets/css/bootstrap.min.75a07e3a3100a6fed983b15ad1b297c127a8c2335854b0efc3363731475cbed6.css">
    <link rel="stylesheet" href="{{ asset('librerias') }}/assets/css/nifty.min.4d1ebee0c2ac4ed3c2df72b5178fb60181cfff43375388fee0f4af67ecf44050.css">
</head>

<body style="background-color: white;">
    <div id="root" class="root front-container">
        <section id="content" class="content">
            <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="content__wrap">

                    <!-- Login card -->
                    <div class="card shadow-lg  border" style="background-color: white">
                        <div class="card-header text-center">
                            <img src= "{{ asset('images/logotipo.png') }}" height="" width="100" alt="">
                        </div>
                        <form action="{{route('loguear')}}" method="POST" class="fs-13px" autocomplete="off">
                            <div class="card-body">
                                @csrf
                                @method('POST')
                                <div class="text-center">
                                    <h1 class="h3">LOGIN CLOUD BOLIVIA </h1>
                                    <br>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email" placeholder="Escriba email...." required >
                                </div>

                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Escriba Password...." required>
                                </div>
                                <div class="d-grid mt-5">
                                    <button class="btn btn-danger btn-lg" type="submit">ACCEDER</button>

                                </div>

                            </div>
                        </form>
                                           <!-- <div class=" d-grid mt-5 text-center">
                            <a href="{{ route('registro')}}"> <button class="btn btn-primary ">Registrate</button></a>
                        </div>-->
                    </div>
                    <!-- END : Login card -->



                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('librerias') }}/assets/js/bootstrap.min.bdf649e4bf3fa0261445f7c2ed3517c3f300c9bb44cb991c504bdc130a6ead19.js" defer></script>
    <script src="{{ asset('librerias') }}/assets/js/nifty.min.b53472f123acc27ffd0c586e4ca3dc5d83c0670a3a5e120f766f88a92240f57b.js" defer></script>

</body>

</html>