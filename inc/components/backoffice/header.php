<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../admin/home_backoffice.php">
        <img src="../inc/img/logo.svg" alt="Logo IDK" class="logo-white" width="40px" height="40px">
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap d-flex align-items-center">
            <form method="" action="../inc/php/logout.php" class="me-2">
                <button type="submit" class="btn btn-link p-0">
                    <a class="nav-link px-3">Déconnexion</a>
                </button>
            </form>
            <button id="dark-mode" class="nav-link btn me-4">
                <i class="bi bi-moon-stars"></i>
            </button>
        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', (event) => {
            const toggleButton = document.getElementById('dark-mode');

            const enableDarkMode = () => {
                document.body.classList.add('dark-mode');
                localStorage.setItem('dark-mode', 'enabled');
            };

            const disableDarkMode = () => {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('dark-mode', 'disabled');
            };

            if (localStorage.getItem('dark-mode') === 'enabled') {
                enableDarkMode();
            } else if (localStorage.getItem('dark-mode') === 'disabled') {
                disableDarkMode();
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                enableDarkMode();
            }

            toggleButton.addEventListener('click', () => {
                if (document.body.classList.contains('dark-mode')) {
                    disableDarkMode();
                } else {
                    enableDarkMode();
                }
            });
        });

    </script>
</header>