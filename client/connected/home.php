<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../inc/functions.php">
    <link rel="stylesheet" href="../../inc/style.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <title>IDK</title>
</head>
<body id="connected-home">
    <?php require('../../inc/connected/header.php'); ?>
    <main>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-3" width="150px" src="../../inc/profile.svg">
                        <span class="font-weight-bold">#1234</span>
                        <span class="text-black-50">Pseudo</span>
                        <span class="text-black-50">Léo Belarbi</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-3">Voir mes amis</button>
                    </div>
                </div>
                <div class="col-md-8 border-right">
                    <div class="py-3 d-flex justify-content-center">
                        <div class="row w-100">
                            <div class="col-12 border-1">
                                <div class="col-md-12 overflow-auto menu-oeuvre-2">
                                    <table class="table table-striped table-sm border border-1 border-dark mt-5">
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
                <h3>Mes Listes : </h3>

                <!-- <div class="py-3 d-flex justify-content-center">
                    <div class="row w-100">
                        <div class="col-md-12">
                            <label class="labels">Titre</label>
                            <input type="text" class="form-control" placeholder="Déja vu" value="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="labels">Commentaire</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                        </div>
                        <div class="col-md-12 overflow-auto menu-oeuvre-2">
                            <table class="table table-striped table-sm border-top border-1 border-dark">
                                <tbody>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
<!-- 
                <hr class="featurette-divider my-2">
                <div class="py-3 d-flex justify-content-center">
                    <div class="row w-100">
                        <div class="col-md-12">
                            <label class="labels">Titre</label>
                            <input type="text" class="form-control" placeholder="À voir" value="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="labels">Commentaire</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 mb-3">Supprimer</button>
                        </div>
                        <div class="col-md-12 overflow-auto menu-oeuvre-2">
                            <table class="table table-striped table-sm border-top border-1 border-dark">
                                <tbody>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                    <tr>
                                        <td class="table-cell" scope="row">Nom oeuvre</td>
                                        <td class="table-cell">Ajouté le 12/12/2023 13:12:23</td>
                                        <td class="table-cell"><button type="button" class="btn btn-sm btn-outline-secondary">Retirer</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div> -->

                <div>
                    <!-- <div class="container">
                        <div>
                            <div class="d-flex flex-column">
                                <p class="fs-6">Liste par défaut : A voir</p>
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
                        <div class="d-flex">
                                <h5>Déja vu :</h5>
                                <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Voir plus</button>
                                <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Partager</button>
                                <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Renommer</button>
                                <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Supprimer</button>
                        </div>
                        <div class="d-flex flex-wrap justify-content-around">
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/movie_card_placeholder.jpg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/movie_card_placeholder.jpg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/movie_card_placeholder.jpg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/movie_card_placeholder.jpg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/movie_card_placeholder.jpg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bd-highlight ">
                            <a href="#" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Voir plus</a>
                            <button type="button" href="#" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Partager</button>
                            <button type="button" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Supprimer</button>
                            <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Renommer</button>
                        </div>
                    </div>
                    <!-- <div class="container">
                        <div= >
                            <div class="d-flex flex-column">
                                <p class="fs-6">Liste par défaut : Vu</p>
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
                        <div class="d-flex flex-wrap justify-content-around">
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/movie_card_placeholder.jpg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bd-highlight ">
                            <a href="#" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Voir plus</a>
                            <button type="button" href="#" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Partager</button>
                            <button type="button" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Supprimer</button>
                            <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Renommer</button>
                        </div>
                    </div>
                    <!-- <div class="container">
                        <div= >
                            <div class="d-flex flex-column">
                                <p class="fs-6">Liste par défaut : Mes avis</p>
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
                        <div class="d-flex flex-wrap justify-content-around">
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card text-center btn-custom" style="width: 15rem;">
                                <img src="../../inc/film.svg" style="width: 13rem; margin: auto;" class="card-img-top border border-dark mt-3 " alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title text-center">Nom oeuvre</h5>
                                    <div class="d-flex row justify-content-around">
                                        <button type="button" class="btn btn-primary col-5 px-1 btn-warning text-white border border-light border-2"  >Supprimer</button>
                                        <a href="#" class="btn btn-primary col-6 px-1 btn-warning text-white border border-light border-2">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bd-highlight ">
                            <a href="#" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Voir plus</a>
                            <button type="button" href="#" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Partager</button>
                            <button type="button" class="m-3 btn btn-primary btn-warning text-white border border-light border-2 small-text">Supprimer</button>
                            <button type="button" class="m-3 p-2 btn btn-primary btn-warning text-white border border-light border-2 small-text">Renommer</button>
                        </div>
                    </div>
                    <div class="container text-center">
                        <a href="#" class="nav-btn btn btn-primary btn-lg btn-warning text-white border border-light border-2 rounded-3 px-5">+ créer une nouvelle liste</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require('../../inc/connected/footer.php'); ?>
</body>
</html>