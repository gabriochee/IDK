<header class="bg-dark text-white p-1">
  <div class="container d-flex align-items-center justify-content-center justify-content-md-between border-bottom p-0">
    <nav class="navbar col-lg-2">
      <img src="../../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid logo-white" width="50px" height="50px">
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark d-flex flex-lg-fill ms-3">
      <div class="container-fluid ps-4 pe-0">
        <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

          <div class="offcanvas-header justify-content-start">
            <img src="../../logo.svg" alt="Logo IDK" width="50px" height="50px" class="img-fluid logo-white ms-3">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body d-md-flex gap-lg-5">
            <ul class="nav justify-content-center fw-light me-xl-5 col-1 col-sm-4 col-md-9 m-auto">
              <li>
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'home.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/connected/home.php" class="nav-link text-white">Acceuil</a>
              </li>
              <li>
              <a <?php if(basename($_SERVER['PHP_SELF']) == 'questionnaire.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/connected/questionnaire.php" class="nav-link text-white">Questionnaire</a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">Fusion</a>
              </li>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu amitié
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="../../client/connected/show_user.php">Les utilisateurs</a></li>
                  <li><a class="dropdown-item" href="../../client/connected/my_requested_friend.php">Mes envoies de demandes(en attente)</a></li>
                  <li><a class="dropdown-item" href="../../client/connected/my_friend_req.php">Mes receptions de demandes(en cours)</a></li>
                  <li><a class="dropdown-item" href="../../client/connected/my_friend_list.php">Mes amis</a></li>
                </ul>
              </div>
              <li>
                <a href="#" class="nav-link text-white">Paramètres</a>
              </li>
            </ul>

            <ul class="navbar-nav d-flex justify-content-lg-end align-items-center gap-2 flex-grow-1 m-md-0 mt-5">
              <li class="nav-item">
                <button class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Déconnexion</button>
              </li>
              <li class="nav-item">
                <button class="nav-link btn">
                  <i class="bi bi-moon-stars"></i>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <form class="d-flex justify-content-center col-5 m-auto mt-2 mb-2">
    <input type="search" class="form-control bg-dark text-white form-control-dark" placeholder="Rechercher..." aria-label="Search" id="navbar_movie">
  </form>
</header>