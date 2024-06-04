<?php 
session_start();

if(!(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin')) {
    header("Location: ../client/not_connected/login.php");
    exit();
}
?>
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
<body id="backoffice_edit_oeuvre" class="backoffice">
    <?php require('../inc/php/db.php'); ?>
    <?php require('../inc/backoffice/header.php');?>
    <div class="container-fluid">
        <div class="row">
            <?php require('../inc/backoffice/sidebar.php');?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <input class="form-control form-control-white w-100 my-3" type="text" placeholder="Recherche" aria-label="Search">
                <div class="container border border-black rounded-2 border-2 mt-3">
                    <p class="text-end mt-3">Date de modifications : 01/01/2024 00:00</p>
                    <hr class="featurette-divider my-2">
                    
                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="row col-12 col-lg-6" >
                                <img src="../inc/img/test.jpeg" alt="affiche de l'oeuvre">
                            </div>
                            <div class="col-12 col-lg-5">
                                <div>
                                    <h1 class="m-3">Titre oeuvre</h1>
                                    <p class="m-1">Genres :</p>
                                    <p class="m-1">Date de sortie :</p>
                                    <p class="m-1">Durée :</p>
                                    <p class="m-1">Crée par :</p>
                                    <p class="m-1">Réalisateur :</p>
                                    <p class="m-1">Acteurs principaux :</p>
                                    <p class="m-1">Nationalité :</p>                        
                                    <p class="m-1">Langue :</p>
                                </div>
                                <div class ="container mt-4">
                                    <div class="d-flex justify-content-center mt-2">
                                        <div class="card col-1 mx-1 p-3 color-custom-1 w-100">
                                            <div class="card-body d-flex flex-column justify-content-start align-items-center p-0">
                                                <p class="m-0 fw-bold fs-5">Public : 1,1</p>
                                                <div class="d-flex justify-content-center my-2">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                </div>
                                                <p class="mb-0 text-center">20 notes - 2 critiques</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>        
                            </div>
                        </div>
                        <div class="container mt-3">
                            <div>
                                <div>
                                    <div>
                                        <h2 class="m-5">Synopsis & infos</h2>
                                        <p class="m-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, perferendis. Numquam corrupti inventore, laborum odio nam aliquid. Reprehenderit doloribus beatae accusantium. Eum ullam blanditiis architecto. Tempora, esse. Porro aut suscipit accusantium. Nihil, temporibus quam quidem iste unde expedita repudiandae assumenda quaerat, voluptatibus ducimus modi laudantium! At, provident aspernatur? Quas, unde. Amet suscipit alias temporibus mollitia praesentium dolorum veritatis magnam illo, molestias ratione a nobis minus. Nihil ab inventore ratione, dolor ullam non exercitationem consequatur blanditiis a, eaque repellendus tenetur fuga quis, ea recusandae? Unde sunt neque dolore quasi voluptates assumenda nihil, ducimus vitae numquam consequuntur vero! Quos cupiditate sequi molestias?</p>
                                        <br>
                                        <p class="m-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis neque quisquam eos tempore, debitis reprehenderit aut in voluptate delectus porro? Vero, molestiae. Laudantium ex magnam dignissimos dolor excepturi modi quia maiores est doloremque. Necessitatibus enim fuga aperiam esse eligendi error assumenda illo explicabo commodi. Fugit ut expedita enim saepe est dolorum molestiae minima, dignissimos nemo quas! Dignissimos dolore explicabo labore repellat corporis nesciunt assumenda optio dolorem nihil quam obcaecati, corrupti iste nemo modi pariatur ducimus? Animi aliquam reiciendis dignissimos nulla et officia alias fugiat! Commodi aliquam odio nesciunt. Esse ducimus mollitia sint velit blanditiis harum perspiciatis fugiat odio quod officiis.</p>
                                        <br>
                                    </div>
                                    <div>
                                        <h3 class="m-3">Liste des épisodes :</h3>
                                        <ul>
                                            <li>Saison 1</li>
                                                <ul>
                                                    <li>Episode 1 : Nom oeuvre</li>
                                                    <li>Episode 2 : Nom oeuvre</li>
                                                    <li>Episode 3 : Nom oeuvre</li>
                                                    <li class="text-decoration-underline">Episode 4 : Nom oeuvre</li>
                                                    <li>Episode 5 : Nom oeuvre</li>
                                                    <li>Episode 6 : Nom oeuvre</li>
                                                </ul>
                                            <li>Saison 2</li>
                                                <ul>
                                                    <li>Episode 1 : Nom oeuvre</li>
                                                    <li>Episode 2 : Nom oeuvre</li>
                                                    <li>Episode 3 : Nom oeuvre</li>
                                                    <li>Episode 4 : Nom oeuvre</li>
                                                    <li>Episode 5 : Nom oeuvre</li>
                                                    <li>Episode 6 : Nom oeuvre</li>
                                                </ul>
                                            <li>Saison 3</li>
                                                <ul>
                                                    <li>Episode 1 : Nom oeuvre</li>
                                                    <li>Episode 2 : Nom oeuvre</li>
                                                    <li>Episode 3 : Nom oeuvre</li>
                                                    <li>Episode 4 : Nom oeuvre</li>
                                                    <li>Episode 5 : Nom oeuvre</li>
                                                    <li>Episode 6 : Nom oeuvre</li>
                                                </ul>
                                        </ul>
                                    </div>
                                    <br>
                                    <div>
                                        <h3 class="m-3">Distinction :</h3>
                                        <ul>
                                            <li>Récompense du blabla, le 12/02/2021</li>
                                            <li>Récompense du blabla, le 12/02/2021</li>
                                            <li>Récompense du blabla, le 12/02/2021</li>
                                            <li>Récompense du blabla, le 12/02/2021</li>
                                            <li>Récompense du blabla, le 12/02/2021</li>
                                            <li>Récompense du blabla, le 12/02/2021</li>
                                        </ul>
                                    </div>
                                    <br>
                                    <div>
                                        <h3 class="m-3">Critiques publiques :</h3>
                                        <div class="row justify-content-center">
                                            <h3 class="text fw-bold text-center">5/5 :</h3>
                                            <div class="col-12 border border-2 border-dark color-custom-2 mb-3">
                                                <div class="overflow-auto menu-oeuvre-2">
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 5/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 5/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                        <div class="row justify-content-center">
                                            <h3 class="text fw-bold text-center">4/5 :</h3>
                                            <div class="col-12 border border-2 border-dark color-custom-2 mb-3">
                                                <div class="overflow-auto menu-oeuvre-2">
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 4/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 4/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 4/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                        <div class="row justify-content-center">
                                            <h3 class="text fw-bold text-center">3/5 :</h3>
                                            <div class="col-12 border border-2 border-dark color-custom-2 mb-3">
                                                <div class="overflow-auto menu-oeuvre-2">
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 3/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 3/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 3/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                        <div class="row justify-content-center">
                                            <h3 class="text fw-bold text-center">2/5 :</h3>
                                            <div class="col-12 border border-2 border-dark color-custom-2 mb-3">
                                                <div class="overflow-auto menu-oeuvre-2">
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 2/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 2/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 2/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                        <div class="row justify-content-center">
                                            <h3 class="text fw-bold text-center">1/5 :</h3>
                                            <div class="col-12 border border-2 border-dark color-custom-2 mb-3">
                                                <div class="overflow-auto menu-oeuvre-2">
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 1/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 1/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 1/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                        <div class="row justify-content-center">
                                            <h3 class="text fw-bold text-center">0/5 :</h3>
                                            <div class="col-12 border border-2 border-dark color-custom-2 mb-3">
                                                <div class="overflow-auto menu-oeuvre-2">
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 0/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 0/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                    <div>
                                                        <p class="m-0 fw-bold fs-5">&#x2022; Eric123, inscrit depuis 14/04/2024, 123 abonnées, 123 critiques publiques, 12 listes publiques, publié le 14/04/2024 : 0/5</p>
                                                        <p class="mb-0">This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                                    </div>
                                                </div>
                                            </div>           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-75 my-3" id="modifier-home">Modifier</button>
                </div>

                <form method="post" id="form-oeuvre">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="titre" class="form-label">Titre</label>
                            <textarea class="form-control" id="titre" name="titre" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="genres" class="form-label">Genres</label>
                            <textarea class="form-control" id="genres" name="genres"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="date" class="form-label">Date de sortie</label>
                            <textarea class="form-control" id="date" name="date" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="duree" class="form-label">Durée</label>
                            <textarea class="form-control" id="duree" name="duree"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="realisateur" class="form-label">Réalisateur</label>
                            <textarea class="form-control" id="realisateur" name="realisateur" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="acteurs" class="form-label">Acteurs principaux</label>
                            <textarea class="form-control" id="acteurs" name="acteurs"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="nationalite" class="form-label">Nationalité</label>
                            <textarea class="form-control" id="nationalite" name="nationalite" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="langue" class="form-label">Langue</label>
                            <textarea class="form-control" id="langue" name="langue"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="synospis" class="form-label">Synopsis</label>
                            <textarea class="form-control" id="synospis" name="synospis"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="image-oeuvre" class="form-label">Image</label>
                            <textarea class="form-control" id="image-oeuvre" name="image-oeuvre"></textarea>
                        </div>
                        <button class="nav-btn btn btn-primary btn-lg btn-block btn-warning text-white border border-light border-2 rounded-3 w-100 my-3" type="submit" value="">Enregistrement</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>