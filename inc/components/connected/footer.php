<footer class="bg-dark text-white pt-2 fw-light mt-3">
    <div class="container-fluid px-5">
        <div class="container-fluid d-md-flex justify-content-lg-center align-items-center border-bottom px-0">
            <div class="container-fluid p-0 d-flex flex-column align-items-md-start align-items-center my-3">
                <p class="col-10 text-md-start text-center m-auto m-md-0 pe-md-3 mb-5">
                    Here you can use rows and columns to organize your footer content.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </p>
            </div>
            <div class="container-fluid col-7 fs-6 pe-0 ps-xl-5">
                <ul class="nav justify-content-center justify-content-between">
                    <li class="nav-item">
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'questionnaire.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/connected/questionnaire.php" class="nav-link text-white text-start">Questionnaire</a>
                    </li>
                    <li class="nav-item">
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/connected/about.php" class="nav-link text-white text-start">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'terms_and_conditions.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/connected/terms_and_conditions.php" class="nav-link text-white text-start">Conditions générales</a>
                    </li>
                    <li class="nav-item">
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/connected/contact.php" class="nav-link text-white text-start">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid fw-light d-flex justify-content-center justify-content-evenly align-items-center p-2 m-0 border-bottom">
            <div class="container-fluid d-flex justify-content-center gap-3 align-items-center py-3">
                <form method="" action="../../inc/php/logout.php">
                    <button type="submit" name="logout" class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Déconnexion</button>
                </form>
            </div>
        </div>

        <div class="container-fluid d-flex justify-content-center gap-4 p-2 mb-2">
            <a href="#" class="icon-link">
                <i class="bi bi-instagram icon-white text-center fs-3"></i>
            </a>
            <a href="#" class="icon-link">
                <i class="bi bi-facebook icon-white text-center fs-3"></i>
            </a>
            <a href="#" class="icon-link">
                <i class="bi bi-linkedin icon-white text-center fs-3"></i>
            </a>
        </div>
    </div>
    <div class="container-fluid bg-black text-center">
        <p class="tiny-text p-3 mb-0">© Copyright : idk2watch.freeddns.org</p>
    </div>
</footer>