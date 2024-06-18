<?php require_once('../inc/php/access.php'); ?>
<?php require_once('../inc/php/edit_contenu_public.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/style/style.css">
    <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="backoffice_edit_about" class="backoffice">
    <?php require_once('../inc/components/backoffice/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once('../inc/components/backoffice/sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container border border-black rounded-2 border-2 mt-3">
                    <h1 class="text-center mt-4">Page : <?php echo htmlspecialchars($file_location); ?></h1>
                    <p class="text-end mb-0">Auteur des modifications : <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></p>
                    <p class="text-end mt-0">Date de modifications : <?php echo htmlspecialchars($last_modif); ?></p>
                    <hr class="featurette-divider my-2">
                    
                    <div class="container col-9 my-5">
                    <?php
                        $content = '';
                        foreach ($results as $line) {
                            $content .= '<h3>' . htmlspecialchars($line['titre']) . '</h3>';
                            $content .= '<p>' . nl2br(htmlspecialchars($line['corps'])) . '</p><br/>';
                        }
                        echo $content;
                    ?>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="nav-btn btn btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3 d-block" id="modifier-about">Modifier</button>
                </div>

                <form method="POST" id="form-edit-about" class="d-none my-5">
                    <div class="row g-3 p-5">
                    <?php
                        $content2 = '';
                        foreach ($results as $line2) {
                            $content2 .= '<div class="col-12">';
                            $content2 .= '<label for="titre-bloc' . htmlspecialchars($line2['id_bloc']) . '" class="form-label">Titre du bloc ' . htmlspecialchars($line2['id_bloc']) . '</label>';
                            $content2 .= '<textarea class="form-control" id="titre-bloc' . htmlspecialchars($line2['id_bloc']) . '" name="titre-bloc' . htmlspecialchars($line2['id_bloc']) . '">'; 
                            if (isset($line2['titre'])) {
                                $content2 .= htmlspecialchars($line2['titre']);
                            }
                            $content2 .= '</textarea></div>';
                            $content2 .= '<div class="col-12">';
                            $content2 .= '<label for="texte-bloc' . htmlspecialchars($line2['id_bloc']) . '" class="form-label">Texte du bloc ' . htmlspecialchars($line2['id_bloc']) . '</label>';
                            $content2 .= '<textarea class="form-control" id="texte-bloc' . htmlspecialchars($line2['id_bloc']) . '" name="texte-bloc' . htmlspecialchars($line2['id_bloc']) . '">';
                            if (isset($line2['corps'])) {
                                $content2 .= htmlspecialchars($line2['corps']);
                            }
                            $content2 .= '</textarea></div>';
                        }
                        echo $content2;
                    ?>
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" type="submit" value="">Enregistrement</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script>
        const newAdmin = document.getElementById("form-edit-about");
        const btnNewAdmin = document.getElementById("modifier-about");
        btnNewAdmin.addEventListener("click", function() {
            newAdmin.classList.replace("d-none", "d-block");
            btnNewAdmin.classList.replace("d-block", "d-none");
        });
    </script>
    <script src="../inc/js/edit_about.js"></script>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
