<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== BOXICONS ===============-->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <!--=============== ICON TITLE ===============-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />
        
        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="{{ asset('sidebar/css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('main/styles.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" /> 
        {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" /> --}}
        
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Monetra | Dashboard</title>
    </head>
    <body>
        <main class="container section">
            <div class="header">
                <h1>Hi, {{ Auth::user()->name }}</h1>
                <div class="header_img" onclick="toggleDropdown()">
                    <img src="{{ asset('assets/img/avatars/profil.png') }}" alt="">
                    <div class="dropdown" id="dropdown">
                        <a href="/dashboard/settings"><i class='bx bxs-cog' style="margin-right: 10px"></i>Pengaturan</a>
                        <form action="/logout" method="POST" id="logoutForm">
                            @csrf
                            <a href="logout" style="color: #fc3903" class="nav__link" id="logoutButtonProfile" onclick="document.getElementById('logoutForm').submit()">
                                <i class='bx bx-exit' style="color: #fc3903; margin-right: 6px"></i>
                                Logout
                            </a>
                            <script>
                                const logoutButtonProfile = document.getElementById('logoutButtonProfile');
                                logoutButtonProfile.addEventListener('click', function(e) {
                                    logoutButtonProfile.removeAttribute('href');
                                });
                            </script>
                        </form>
                    </div>
                    <script>
                        function toggleDropdown() {
                            var dropdown = document.getElementById("dropdown");
                            dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
                            //add transition
                            dropdown.style.transition = "all 0.5s ease";
                            //add transformy
                            dropdown.style.transform = "translateY(10%)";
                        }
                        document.addEventListener("click", function(event) {
                            var dropdown = document.getElementById("dropdown");
                            var headerImg = document.querySelector(".header_img");
        
                            if (event.target !== headerImg && !headerImg.contains(event.target) && event.target !== dropdown && !dropdown.contains(event.target)) {
                                dropdown.style.display = "none";
                            }
                        });
                    </script>
                </div>
            </div>
            @yield('container')
        </main>
    </body>
</html>