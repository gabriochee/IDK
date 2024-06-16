<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column mt-5">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../client/not_connected/home.php">Acceuil non connecté</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../client/connected/home.php">Acceuil connecté</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'home_backoffice.php') echo 'class="nav-link active"'; ?> class="nav-link" aria-current="page" href="../admin/home_backoffice.php">Acceuil backoffice</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_about.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_about.php">Edit : À propos</a>
            </li>
            <li class="nav-item">
            <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_terms_and_conditions.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_terms_and_conditions.php">Edit : CG</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_newsletter.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_newsletter.php">Edit : Newsletter</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'edit_captcha.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/edit_captcha.php">Edit : Captcha</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'moderation_user.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/moderation_user.php">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'messagerie_adm.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/messagerie_adm.php">Messagerie</a>
            </li>
            <li class="nav-item">
                <a <?php if(basename($_SERVER['PHP_SELF']) == 'diary_log.php') echo 'class="nav-link active"'; ?> class="nav-link" href="../admin/diary_log.php">Log</a>
            </li>
        </ul>
    </div>
</nav>