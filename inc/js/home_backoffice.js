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

