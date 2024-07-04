<header class="bg-dark text-white p-1">
  <div class="container d-flex align-items-center justify-content-center justify-content-md-between border-bottom p-0">
    <nav class="navbar col-lg-2">
      <a href="../../client/not_connected/home.php">
        <img src="../../inc/img/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid logo-white" width="50px" height="50px">
      </a>
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark d-flex flex-lg-fill ms-3">
      <div class="container-fluid ps-4 pe-0">
        <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

          <div class="offcanvas-header justify-content-start">
            <a href="../../client/not_connected/home.php">
              <img src="../../inc/img/logo.svg" alt="Logo IDK" width="50px" height="50px" class="img-fluid logo-white ms-3">
            </a>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body d-md-flex gap-lg-5">
            <ul class="nav justify-content-center fw-light col-1 col-sm-4 col-md-9 m-auto">
              <li>
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'home.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/home.php">Acceuil</a>
              </li>
              <li>
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'questionnaire.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/questionnaire.php">Questionnaire</a>
              </li>
              <li>
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'public_list.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/public_list.php">Listes publiques</a>
              </li>
              <li>
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/about.php">A propos</a>
              </li>
              <li>
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/contact.php">Contact</a>
              </li>
            </ul>

            <ul class="navbar-nav d-flex justify-content-lg-end align-items-center gap-2 flex-grow-1 col-3 m-md-0 m-auto">
              <li class="nav-item">
                <a href="../../client/not_connected/signin.php">
                  <button class="nav-btn btn btn-sm btn-warning text-white border border-light border-2 rounded-3">Inscription</button>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../client/not_connected/login.php">
                  <button class="nav-btn btn btn-sm btn-warning text-white border border-light border-2 rounded-3">Connexion</button>
                </a>
              </li>
              <li class="nav-item">
              <button id="dark-mode" class="nav-link btn">
                  <i class ="bi bi-moon-stars"></i>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <?php 
    if (isset($_SESSION['role_user']) &&  $_SESSION['role_user'] == 'admin') { 
      echo '<form method="" action="../../admin/home.php"><button type="submit" name="" class="nav-btn btn w-25 btn-info border border-light border-2 rounded-3 d-flex m-auto mt-3 justify-content-center">Backoffice</button></form>';
      echo '<form method="" action="../../client/connected/home.php"><button type="submit" name="" class="nav-btn btn w-25 btn-info border border-light border-2 rounded-3 d-flex m-auto mt-2 justify-content-center">Acceuil connecté</button></form>';
    }
  ?>
  <form class="d-flex justify-content-center col-5 m-auto mt-2 mb-2">
    <input type="search" onkeydown="searchKeywordMovie()" class="form-control bg-dark text-white form-control-dark" placeholder="Rechercher une oeuvre !" aria-label="Search" id="navbar_movie">
  </form>

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
  <script src="../../inc/js/search_movie.js"></script>

  <div id="resultats_movie"></div>
</header>