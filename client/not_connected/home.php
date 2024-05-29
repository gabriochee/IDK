<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/style/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="not_connected_home">
    <?php require('../../inc/php/db.php'); ?>
    <?php require('../../inc/not_connected/header.php');?>      
    <main>
        <div class="container text-center m-auto">
            <div class="row">
                <div class="col-lg-6 m-auto p-4">
                    <img src="../../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid my-5" width="150px" height="150px">
                    <h1 class="mb-5">Phrase d'accroche</h1>
                    <p class="mb-5">Texte explicatif du service : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 mb-5">Commencer le questionnaire</button>
                </div>
            </div>
        </div>
        <div class="container marketing">
            <div class="row d-flex justify-content-around mb-5">
                <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                    <h2 class="mt-5">Un réseau de film qui évolue avec tous</h2>
                    <p class="mt-5">IDK apprends de vos choix pour affiner vos suggestions et vous offrir une expérience toujours plus personnalisé avec vos amis.</p>
                </div>
                <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                    <h2 class="mt-5">Un contrôle total sur vos listes</h2>
                    <p class="mt-5">Personnaliser votre univers cinéphile en toute intimité :<br>Partagez des listes sur mesure en désélectionnant ce que vous souhaitez garder secret.</p>
                </div>
                <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                    <h2 class="mt-5">Votre ami et vous êtes en désaccord ?</h2>
                    <p class="mt-5">Utilisez nos fonctionnalités fusion et anti-film. Ces fonctionnalités permettent ou de choisir un film parmis une selection lors ou de sélectionner le film que vous pourriez aimé mais qui est peu dans vos habitudes.</p>
                </div>
            </div>
        </div>

        <h1 class="text-center">Nouveauté</h1>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#E8EDDF"/></svg>
                    <div class="container">
                        <div class="carousel-caption text-start text-dark d-flex">
                            <div class="w-50">
                                <h1><br>Nom œuvre</h1>
                                <p><br><br>De Antoine Dupont<br>Genre<br>Sortie le jj/mm/aaaa<br><br><br></p>
                                <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                            </div>
                            <div class="w-50" style="background-color: #5956CA;"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#E8EDDF"/></svg>
                    <div class="container">
                        <div class="carousel-caption text-start text-dark d-flex">
                            <div class="w-50">
                                <h1><br>Nom œuvre</h1>
                                <p><br>De Antoine Dupont<br>Genre<br>Sortie le jj/mm/aaaa<br><br><br><br></p>
                                <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                            </div>
                            <div class="w-50" style="background-color: #5956CA;"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#E8EDDF"/></svg>
                    <div class="container">
                        <div class="carousel-caption text-start text-dark d-flex">
                            <div class="w-50">
                                <h1><br>Nom œuvre</h1>
                                <p><br>De Antoine Dupont<br>Genre<br>Sortie le jj/mm/aaaa<br><br><br><br></p>
                                <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                            </div>
                            <div class="w-50" style="background-color: #5956CA;"></div>
                        </div>
                    </div> 
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container marketing">
            <h1 class="text-center mb-5">Listes les plus populaires</h1>
            <div class="row d-flex justify-content-around">
                <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                    <h2 class="mt-5">Nom de la liste</h2>
                    <p class="text-start mb-4">Auteur : Antoine Dupont<br>Détails : Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3">En voir plus</button>
                </div>
                <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                    <h2 class="mt-5">Nom de la liste</h2>
                    <p class="text-start mb-4">Auteur : Antoine Dupont<br>Détails : Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3">En voir plus</button>
                </div>
                <div class="col-lg-3 border border-dark border-2 text-center rounded-2" style="height: 350px; background-color: #CFDBD5;">
                    <h2 class="mt-5">Nom de la liste</h2>
                    <p class="text-start mb-4">Auteur : Antoine Dupont<br>Détails : Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3">En voir plus</button>
                </div>
            </div>
        </div>

        <div class="container marketing">
            <hr class="featurette-divider">
            <h1 class="text-center mb-5">Films populaires du moment</h1>
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Nom œuvre</h2>
                    <p class="lead mb-4">De Antoine Dupont<br>Genre<br>Sortie le jj/mm/aaaa<br>Résumer : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a gasz jaeal.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                </div>
                <div class="col-md-5">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#5956CA"/></svg>
                </div>
            </div>
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading">Nom œuvre</span></h2>
                    <p class="lead mb-4">De Antoine Dupont<br>Genre<br>Sortie le jj/mm/aaaa<br>Résumer : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a gasz jaeal.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                </div>
                <div class="col-md-5 order-md-1">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#5956CA"/></svg>
                </div>
            </div>
            <hr class="featurette-divider">
            <div class="row featurette mb-5">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Nom œuvre</h2>
                    <p class="lead mb-4">De Antoine Dupont<br>Genre<br>Sortie le jj/mm/aaaa<br>Résumer : Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a gasz jaeal.</p>
                    <button class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 d-flex m-auto">En voir plus</button>
                </div>
                <div class="col-md-5">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#5956CA"/></svg>
                </div>
            </div>
        </div>

    </main>
    <?php require('../../inc/not_connected/footer.php'); ?>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>