<!doctype html>
<html lang="es">
    <head>
        <title>Login | wcsstore</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            .main-login{
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
        
        <!--Sweet Alert-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>

    @if (( $errors_login = Session::get('errors_login') ))
        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
            <p>{{$errors_login}}</p>
        </div>

        <script>
            var alertList = document.querySelectorAll(".alert");
            alertList.forEach(function (alert) {
                new bootstrap.Alert(alert);
            });
        </script>
        
    @elseif ($success = Session::get('success') )
        <script>
            Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{$success}}",
            showConfirmButton: false,
            timer: 1500
          });
        </script>
    @endif
        <main class="container main-login">

            <div class="form-login bg-white shadow-lg p-3 w-50 pb-3 pt-3 rounded">
                  <h3 class="text-center mt-3 mb-5">Introduce tus credenciales</h3>
                <form class="m-3" action="{{route('login_provider')}}" method="POST">
                    @csrf
                    <input class="form-control mb-3" type="text" name="name" placeholder="Tu nombre">
                    <input class="form-control mb-3" type="text" name="password" placeholder="Tu contraseña">

                    <button class="btn btn-primary mt-2" type="submit">Iniciar sesión</button>
                </form>
            </div>
            
        </main>


        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
