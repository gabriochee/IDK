// <?php require_once('../inc/php/access.php'); ?>
// <!DOCTYPE html>
// <html lang="fr">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <link rel="stylesheet" href="../inc/library/bootstrap/css/bootstrap.min.css">
//     <link rel="stylesheet" href="../inc/style/style.css">
//     <link rel="stylesheet" href="../inc/library/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
//     <title>IDK</title>
// </head>
// <body id="backoffice_home" class="backoffice">
//     <?php require_once('../inc/php/affichage_data_user.php'); ?>
//     <?php require_once('../inc/components/backoffice/header.php');?>
//     <div class="container-fluid">
//         <div class="row">
//             <?php require_once('../inc/components/backoffice/sidebar.php');?>
//             <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

//                 <div class="row row-cols-1 row-cols-md-3 mb-3 text-center mt-5">
//                     <div class="col">
//                         <div class="card mb-4 rounded-3 shadow-sm">
//                             <div class="card-header py-3">
//                                 <h4 class="my-0 fw-normal">Nombres d'utilisateurs connectées</h4>
//                             </div>
//                             <div class="card-body">
//                                 <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">10</small></h1>
//                             </div>
//                         </div>
//                         <div class="card mb-4 rounded-3 shadow-sm">
//                             <div class="card-header py-3">
//                                 <h4 class="my-0 fw-normal">Nombres d'oeuvre stockée dans la base <small>(le 12/12/2024 12:12:12)</small></h4>
//                             </div>
//                             <div class="card-body">
//                                 <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">8 000 000</small></h1>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col">
//                         <div class="card mb-4 rounded-3 shadow-sm">
//                             <div class="card-header py-3">
//                                 <h4 class="my-0 fw-normal">Moyennes d'ages des utilisateurs</h4>
//                             </div>
//                             <div class="card-body">
//                                 <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">34 ans</small></h1>
//                             </div>
//                         </div>
//                         <div class="card mb-4 rounded-3 shadow-sm">
//                             <div class="card-header py-3">
//                                 <h4 class="my-0 fw-normal">Moyennes d'ages des utilisateurs connectées</h4>
//                             </div>
//                             <div class="card-body">
//                                 <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">29 ans</small></h1>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col d-flex align-items-center"><canvas id="proportion_sexe"></canvas></div>
//                     <div class="col-md-6 mt-3"><canvas id="nb_inscription"></canvas></div>
//                     <div class="col-md-6 mt-3"><canvas id="creation_listes"></canvas></div>
//                     <div class="col-md-12 mt-3">
//                         <div class="card mb-4 rounded-3 shadow-sm">
//                             <div class="card-header py-3">
//                                 <h4 class="my-0 fw-normal">Nombres moyennes de listes par utilisateurs <small>(hors "A voir" et "Déja vu")</small></h4>
//                             </div>
//                             <div class="card-body">
//                                 <h1 class="card-title pricing-card-title"><small class="text-muted fw-light">2</small></h1>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="col-md-6 mt-3"><canvas id="nb_questionnaire"></canvas></div>
//                     <div class="col-md-6 mt-3"><canvas id="nb_fusion"></canvas></div>
//                     <div class="col-md-4 mt-3"><canvas id="repart_genre_all"></canvas></div>
//                     <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_day"></canvas></div>
//                     <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_week"></canvas></div>
//                     <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_month"></canvas></div>
//                     <div class="col-md-2 mt-3 d-flex align-items-center"><canvas id="repart_genre_year"></canvas></div>
//                     <div class="col-12">
//                         <h1>mettre tableau des pages les plus visiter filtrable (jour:defaut, semaine, mois, année, all)</h1>
//                     </div>
//                 </div>
//             </main>

//         </div>
//     </div>
//     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
//     <script src="../inc/js/home_backoffice.js"></script>
//     <script src="../inc/library/bootstrap/js/bootstrap.bundle.min.js"></script>
// </body>
// </html>

const proportion_sexe = document.getElementById('proportion_sexe');
const nb_inscription = document.getElementById('nb_inscription');
const creation_listes = document.getElementById('creation_listes');
const nb_questionnaire = document.getElementById('nb_questionnaire');
const nb_fusion = document.getElementById('nb_fusion');
const repart_genre_day = document.getElementById('repart_genre_day');
const repart_genre_week = document.getElementById('repart_genre_week');
const repart_genre_month = document.getElementById('repart_genre_month');
const repart_genre_year = document.getElementById('repart_genre_year');
const repart_genre_all = document.getElementById('repart_genre_all');

new Chart(proportion_sexe, {
    type: 'doughnut',
    data: {
        labels: ['Homme', 'Femme', 'Autre'],
        datasets: [{ 
            data: [12, 19, 3] 
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Proportions des genres' 
            }
        }
    }
});
new Chart(nb_inscription, {
    type: 'bar',
    data: {
        labels: ['Aujourd\'hui', 'Cette semaine', 'Ce mois', 'Cette année', 'Total'],
        datasets: [{ 
            label: 'Nombres d\'inscriptions',
            data: [12, 19, 30, 320, 1920] 
        }]
    }
});
new Chart(creation_listes, {
    type: 'bar',
    data: {
        labels: ['Aujourd\'hui', 'Cette semaine', 'Ce mois', 'Cette année', 'Total'],
        datasets: [{ 
            label: 'Nombres de listes crée',
            data: [1, 9, 18, 60, 192] 
        }]
    }
});
new Chart(nb_questionnaire, {
    type: 'bar',
    data: {
        labels: ['Aujourd\'hui', 'Cette semaine', 'Ce mois', 'Cette année', 'Total'],
        datasets: [{ 
            label: 'Nombres de questionnaires remplis, utilisateur connecté et non-connecté',
            data: [12, 19, 30, 320, 1920] 
        }]
    }
});
new Chart(nb_fusion, {
    type: 'bar',
    data: {
        labels: ['Aujourd\'hui', 'Cette semaine', 'Ce mois', 'Cette année', 'Total'],
        datasets: [{ 
            label: 'Nombres de fusion effectué',
            data: [1, 9, 18, 60, 192] 
        }]
    }
});
new Chart(repart_genre_all, {
    type: 'doughnut',
    data: {
        labels: ['Action', 'Music', 'Comedy', 'War', 'News', 'Fantasy', 'History', 'Reality-TV', 'Mistery', 'Romance', 'Sci-Fi', 'Horror', 'Biography', 'Musical', 'Drama', 'Game-Show', 'Adventure', 'Animation', 'Documentary', 'Family', 'Western', 'Thriller', 'Sport', 'Film-Noir', 'Crime'],
        datasets: [{ 
            data: [12, 19, 3, 5, 2, 3] 
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false 
            },
            title: {
                display: true,
                text: 'Répartition des genres totaux' 
            }
        }
    }
});
new Chart(repart_genre_day, {
    type: 'doughnut',
    data: {
        labels: ['Action', 'Music', 'Comedy', 'War', 'News', 'Fantasy', 'History', 'Reality-TV', 'Mistery', 'Romance', 'Sci-Fi', 'Horror', 'Biography', 'Musical', 'Drama', 'Game-Show', 'Adventure', 'Animation', 'Documentary', 'Family', 'Western', 'Thriller', 'Sport', 'Film-Noir', 'Crime'],
        datasets: [{ 
            data: [12, 19, 3, 5, 2, 3] 
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false 
            },
            title: {
                display: true,
                text: 'Répartition des genres journalier' 
            }
        }
    }
});
new Chart(repart_genre_week, {
    type: 'doughnut',
    data: {
        labels: ['Action', 'Music', 'Comedy', 'War', 'News', 'Fantasy', 'History', 'Reality-TV', 'Mistery', 'Romance', 'Sci-Fi', 'Horror', 'Biography', 'Musical', 'Drama', 'Game-Show', 'Adventure', 'Animation', 'Documentary', 'Family', 'Western', 'Thriller', 'Sport', 'Film-Noir', 'Crime'],
        datasets: [{ 
            data: [12, 19, 3, 5, 2, 3] 
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false 
            },
            title: {
                display: true,
                text: 'Répartition des genres hebdomadaire' 
            }
        }
    }
});
new Chart(repart_genre_month, {
    type: 'doughnut',
    data: {
        labels: ['Action', 'Music', 'Comedy', 'War', 'News', 'Fantasy', 'History', 'Reality-TV', 'Mistery', 'Romance', 'Sci-Fi', 'Horror', 'Biography', 'Musical', 'Drama', 'Game-Show', 'Adventure', 'Animation', 'Documentary', 'Family', 'Western', 'Thriller', 'Sport', 'Film-Noir', 'Crime'],
        datasets: [{ 
            data: [12, 19, 3, 5, 2, 3] 
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false 
            },
            title: {
                display: true,
                text: 'Répartition des genres mensuelle' 
            }
        }
    }
});
new Chart(repart_genre_year, {
    type: 'doughnut',
    data: {
        labels: ['Action', 'Music', 'Comedy', 'War', 'News', 'Fantasy', 'History', 'Reality-TV', 'Mistery', 'Romance', 'Sci-Fi', 'Horror', 'Biography', 'Musical', 'Drama', 'Game-Show', 'Adventure', 'Animation', 'Documentary', 'Family', 'Western', 'Thriller', 'Sport', 'Film-Noir', 'Crime'],
        datasets: [{ 
            data: [12, 19, 3, 5, 2, 3] 
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false 
            },
            title: {
                display: true,
                text: 'Répartition des genres annuelle' 
            }
        }
    }
});

// tab des pages les plus visiter avec filtres (jour:defaut, semaine, mois, année, all)

