<?php
    session_start();
?>
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
<body id="connected-home">
    <?php require('../../inc/php/db.php'); ?>
    <?php require('../../inc/connected/header.php'); ?>
    <main>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-3" width="150px" src="../../inc/profile.svg">
                        <span class="text-black-50">#1234</span>
                        <span>Pseudo</span>
                        <span>
                            <?php
                                $req = $bdd->prepare("SELECT pseudo FROM UTILISATEUR WHERE id_user = :id_user;");
                                $req->execute(
                                    array(
                                        "id_user" => $_SESSION['id_user']
                                    )
                                );
                                $reponse = $req->fetch();
                                echo $reponse['pseudo'];
                            ?>
                        </span>
                        <span>1 amis</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-3">Voir mes amis</button>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="py-3 d-flex justify-content-center">
                        <div class="row w-100">
                            <div class="col-12 border-1">
                                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                                    <h3>Notifications :</h3>
                                    <table class="table table-striped table-sm border border-1 border-dark mt-3">
                                        <tbody>
                                            <tr>
                                                <td class="table-cell" scope="row">Eric123</td>
                                                <td class="table-cell">le 14/04/2024</td>
                                                <td class="table-cell text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Accepter</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Refuser</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Eric123</td>
                                                <td class="table-cell">le 14/04/2024</td>
                                                <td class="table-cell text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Accepter</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Refuser</button>
                                                </td>                                        
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Eric123</td>
                                                <td class="table-cell">le 14/04/2024</td>
                                                <td class="table-cell text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Accepter</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Refuser</button>
                                                </td>                                        
                                            </tr>
                                            <tr>
                                                <td class="table-cell" scope="row">Eric123</td>
                                                <td class="table-cell">le 14/04/2024</td>
                                                <td class="table-cell text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Accepter</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">Refuser</button>
                                                </td>                                        
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="featurette-divider my-4">
                <h3 class="text-center">Listes : </h3>
                <div class="container">
                        <div class="d-flex flex-column">
                            <p class="fs-6">Liste par défaut : A voir</p>
                            <div class="col-md-12 mb-3">
                                <label class="labels">Commentaire :</label>
                                <div class="d-none">
                                    <input type="text" class="form-control" value="">
                                    <button class="nav-btn btn btn-warning text-white border border-light border-2 rounded-3 w-100 my-1">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  flex-wrap justify-content-around">
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                        </div>
                        <div class="d-flex  flex-row-reverse bd-highlight">
                            <button type="button" href="#" class="m-3 btn btn-warning text-white border border-light border-2 small-text">En voir plus</button>
                        </div>
                </div>
                <div class="container">
                        <div class="d-flex flex-column">
                            <p class="fs-6">Liste par défaut : Deja vu</p>
                            <div class="col-md-12 mb-3">
                                <label class="labels">Commentaire :</label>
                                <div class="d-none">
                                    <input type="text" class="form-control" value="">
                                    <button class="nav-btn btn btn-warning text-white border border-light border-2 rounded-3 w-100 my-1">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  flex-wrap justify-content-around">
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary btn-warning text-white border border-light border-2">Retirer de la liste</button>
                                    </div>
                                </div>
                                <p>Ajouté le 12/12/2023 13:12:23</p>
                            </div>
                        </div>
                        <div class="d-flex  flex-row-reverse bd-highlight">
                            <button type="button" href="#" class="m-3 btn btn-warning text-white border border-light border-2 small-text">En voir plus</button>
                        </div>
                </div>
                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                    <table class="table table-striped"> <!-- Rendre overflow -->
                        <tbody>
                            <tr>
                                <td class="table-cell" scope="row">Nom_de_la_liste</td>
                                <td class="table-cell text-end"><button type="button" class="btn btn-sm btn-outline-secondary">En voir plus</button></td>
                            </tr>
                            <tr>
                                <td class="table-cell" scope="row">Nom_de_la_liste</td>
                                <td class="table-cell text-end"><button type="button" class="btn btn-sm btn-outline-secondary">En voir plus</button></td>
                            </tr>
                            <tr>
                                <td class="table-cell" scope="row">Nom_de_la_liste</td>
                                <td class="table-cell text-end"><button type="button" class="btn btn-sm btn-outline-secondary">En voir plus</button></td>
                            </tr>
                            <tr>
                                <td class="table-cell" scope="row">Nom_de_la_liste</td>
                                <td class="table-cell text-end"><button type="button" class="btn btn-sm btn-outline-secondary">En voir plus</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container text-center">
                    <a href="#" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 px-5 mb-3">+ créer une nouvelle liste</a>
                </div>   
                <hr class="featurette-divider my-2">
                <h1 class="text-center mt-3">Nouveauté</h1>
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
            </div>
        </div>
    </main>

<?php require('../../inc/connected/footer.php'); ?>
</body>
</html>