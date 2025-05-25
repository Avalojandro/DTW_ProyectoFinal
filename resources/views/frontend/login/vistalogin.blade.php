<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/login/bootstrap.min.css') }}">

    
    <link href="{{ asset('images/fav-icon-cine-catalogo.png') }}" rel="icon">
    <!-- libreria -->
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />

    <!-- estilo de toast -->
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <!-- estilo de sweet -->
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">


    <style>
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url({{ asset('images/fondo-cine.jpg') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .demo-container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn-lg {
            padding: 12px 26px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        ::placeholder {
            font-size:14px;
            letter-spacing:0.5px;
        }

        .form-control-lg {
            font-size: 16px;
            padding: 25px 20px;
        }
        .font-500{
            font-weight:500;
        }
        .image-size-small{
            width:200px;
            margin:0 auto;
        }
        .image-size-small img{
            width:200px;
            margin-bottom:-70px;
        }
    </style>
</head>

<body>
<div class="container">
    <div>
        <div class="demo-container" style="margin-top: 30px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">

                        <div class="p-5 bg-white rounded shadow-lg">
                            <div class="text-center image-size-small position-relative">
                                <img src="{{ asset('images/logo-cine-catalogo.png') }}" class="p-2 rounded-circle">
                            </div>
                            <h3 class="mb-2 text-center pt-5"><strong>&nbsp;</strong></h3>
                            <p class="text-center lead" style="font-weight: bold">INICIAR SESIÓN</p>
                            <form>
                                <label style="margin-top: 10px" class="font-500">Usuario</label>
                                <input class="form-control form-control-lg mb-3" id="usuario" autocomplete="off" type="text">
                                <label class="font-500">Contraseña</label>
                                <input class="form-control form-control-lg" id="password" type="password">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="recordarUsuario">
                                    <label class="form-check-label" for="recordarUsuario">Recordar usuario</label>
                                </div>
                                <input type="button" value="ACCEDER" style="margin-top: 25px; width: 100%; font-weight: bold" onclick="login()" class="btn btn-dark btn-lg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/alertaPersonalizada.js') }}"></script>


<script type="text/javascript">

    // onkey Enter
    var input = document.getElementById("password");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            login();
        }
    });

    // Implementación localStorage
    document.addEventListener('DOMContentLoaded', function() {
    const usuarioGuardado = localStorage.getItem('usuarioRecordado');
    if(usuarioGuardado) {
        document.getElementById('usuario').value = usuarioGuardado;
        document.getElementById('recordarUsuario').checked = true;
    }
    });

    // inicio de sesion
    function login() {

        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;
        var recordarUsuario = document.getElementById('recordarUsuario').checked;

        if(usuario === ''){
            toastr.error('Usuario es requerido');
            return;
        }

        if(password === ''){
            toastr.error('Contraseña es requerida');
            return;
        }

        if(recordarUsuario) {
            localStorage.setItem('usuarioRecordado', usuario);
        } else {
            localStorage.removeItem('usuarioRecordado');
        }

        openLoading();

        let formData = new FormData();
        formData.append('usuario', usuario);
        formData.append('password', password);

        axios.post('/admin/login', formData, {
        })
            .then((response) => {
                closeLoading();
                verificar(response);
            })
            .catch((error) => {
                toastr.error('error al iniciar sesión');
                closeLoading();
            });
    }

    // estados de la verificacion
    function verificar(response) {

        if (response.data.success === 0) {
            toastr.error('Validación incorrecta')
        } else if (response.data.success === 1) {
            window.location = response.data.ruta;
        } else if (response.data.success === 2) {
            toastr.error('Contraseña incorrecta');
        } else if (response.data.success === 3) {
            toastr.error('Usuario no encontrado')
        } else if (response.data.success === 5) {
            Swal.fire({
                title: 'Usuario Bloqueado',
                text: "Contactar a la administración",
                icon: 'info',
                showCancelButton: false,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {

                }
            })
        }
        else {
            toastr.error('Error al iniciar sesión');
        }
    }


</script>
</body>

</html>
