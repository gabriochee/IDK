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
    <header class="bg-dark text-white p-1">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between border-bottom p-0">
            <nav class="navbar col-lg-4 col-md-3">
            <img src="../../inc/logo.svg" alt="Logo IDK" class="navbar-brand img-fluid logo-white" width="50px" height="50px">
            </nav>

            <nav class="navbar navbar-expand-md navbar-dark bg-dark d-flex flex-lg-fill ms-3">
            <div class="container-fluid">
                <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

                <div class="offcanvas-header justify-content-start">
                    <img src="../../inc/logo.svg" alt="Logo IDK" width="50px" height="50px" class="img-fluid logo-white ms-3">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body d-md-flex gap-lg-5">
                    <ul class="nav justify-content-center fw-light me-lg-5 col-xl-5">
                    <li>
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'home.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/home.php" class="nav-link text-white">Acceuil</a>
                    </li>
                    <li>
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'questionnaire.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/questionnaire.php" class="nav-link text-white">Questionnaire</a>
                    </li>
                    <li>
                        <a <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="nav-link text-decoration-underline text-white"'; ?> class="nav-link text-white" href="../../client/not_connected/about.php" class="nav-link text-white">A propos</a>
                    </li>
                    </ul>

                    <ul class="navbar-nav d-flex justify-content-lg-end align-items-center gap-2 flex-grow-1 col-3 m-md-0 m-auto">
                    <li class="nav-item">
                        <a href="../../client/not_connected/signin.php">
                        <button class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Inscription</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../client/connected/login.php">
                        <button class="nav-btn btn btn-primary btn-sm btn-warning text-white border border-light border-2 rounded-3">Connexion</button>
                        </a>
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
            <input type="search" onkeydown="searchKeyword()" class="form-control bg-dark text-white form-control-dark" placeholder="Rechercher..." aria-label="Search" id="navbar_movie">
        </form>
        <div id="resultats"></div>
        <script>
            const searchKeyword = async () => {
                document.querySelector("#resultats").innerHTML = "";
                let keyword = document.querySelector("#navbar_movie").value;
                if(keyword.length > 3) {
                    const searchUrl = window.location.href; 
                    const req = await fetch(`../../inc/php/navbar_movie.php?keyword=${keyword}`);
                    const json = await req.json()
                    if(json.length > 0) {
                        json.forEach((post) => {
                            const linkUrl = `oeuvre_test.php?mv=${post.id_work}`;
                            document.querySelector("#resultats").innerHTML += `<a href="${linkUrl}">${post.primaryTitle}</a><br>`;
                        });
                    }
                }
            }
        </script>
    </header>    
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