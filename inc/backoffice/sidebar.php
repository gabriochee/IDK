<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column mt-5">
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'home_backoffice.php') echo 'class="nav-link active"'; ?> class="nav-link" aria-current="page" href="../admin/home_backoffice.php">Home</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_home.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_home.php">Edit : Acceuil</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_about.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_about.php">Edit : À propos</a>
            </li>
            <li class="nav-item">
            <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_terms_and_conditions.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_terms_and_conditions.php">Edit : CG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Edit : Newsletter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../admin/edit_captcha.php">Edit : Captcha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Edit : Oeuvre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Messagerie</a>
            </li>
        </ul>
    </div>
</nav>