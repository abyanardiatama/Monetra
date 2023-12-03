<!--=============== NAV ===============-->
<div class="nav" id="nav">
    <nav class="nav__content">
        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-chevron-right' ></i>
        </div>

        <a href="#" class="nav__logo">
            <img src="../assets/img/favicon/favicon-1.png" class="mt-3" style="max-height: 25px; width: 25px;" />
            <span class="nav__logo-name">Monetra</span>
        </a>

        <div class="nav__list">
            <a href="/dashboard" class="nav__link {{ Request::is('dashboard') ? 'active-link' : '' }}">
                <i class='bx bx-home-alt' ></i>
                <span class="nav__name">Dashboard</span>
            </a>

            <a href="/dashboard/transaksi" class="nav__link {{ Request::is('dashboard/transaksi') ? 'active-link' : '' }}">
                <i class='bx bx-file'></i>
                <span class="nav__name">Transaksi</span>
            </a>
            <a href="/dashboard/kategori" class="nav__link {{ Request::is('dashboard/kategori') ? 'active-link' : '' }}">
                <i class='bx bx-category' ></i>
                <span class="nav__name">Kategori</span>
            </a>
            <a href="/dashboard/saldo" class="nav__link {{ Request::is('dashboard/saldo') ? 'active-link' : '' }}">
                <i class='bx bx-wallet-alt' ></i>
                <span class="nav__name">Saldo</span>
            </a>
            <form action="/logout" method="POST" id="logoutForm">
                @csrf
                <a href="logout" class="nav__link" id="logoutButton" onclick="document.getElementById('logoutForm').submit()">
                    <i class='bx bx-exit' style="color: #fc3903"></i>
                    <span class="nav__name" style="color: #fc3903">Logout</span>
                </a>
                <script>
                    const logoutButton = document.getElementById('logoutButton');
                    logoutButton.addEventListener('click', function(e) {
                        logoutButton.removeAttribute('href');
                    });
                </script>
            </form>
        </div>
    </nav>
</div>
