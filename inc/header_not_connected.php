<header class="bg-dark text-white p-1">
  <div class="container d-flex align-items-center justify-content-center justify-content-md-between border-bottom p-0">
    <nav class="navbar col-lg-4 col-md-3">
      <img src="../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid logo-white" width="50px" height="50px">
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark d-flex flex-lg-fill ms-3">
      <div class="container-fluid">
        <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

          <div class="offcanvas-header justify-content-start">
            <img src="../inc/logo.svg" alt="Logo IDK" width="50px" height="50px" class="img-fluid logo-white ms-3">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body d-md-flex gap-lg-5">
            <ul class="nav justify-content-center fw-light me-lg-5 col-xl-5">
              <li>
                <a href="#" class="nav-link text-white">Acceuil</a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">Questionnaire</a>
              </li>
              <li>
                <a href="#" class="nav-link text-white">A propos</a>
              </li>
            </ul>

            <ul class="navbar-nav d-flex justify-content-lg-end align-items-center gap-2 flex-grow-1 col-3 m-md-0 m-auto">
              <li class="nav-item">
                <button class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Inscription</button>
              </li>
              <li class="nav-item">
                <button class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Connexion</button>
              </li>
              <li class="nav-item">
                <button class="nav-link btn">
                  <i class="bi bi-moon-stars"></i>
                  <!-- <img src="../inc/dark_mode_logo.svg" alt="Mode sombre"> -->
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <form class="d-flex justify-content-center col-5 m-auto mt-2 mb-2">
    <input type="search" class="form-control bg-dark text-white form-control-dark" placeholder="Rechercher..." aria-label="Search">
  </form>
</header>