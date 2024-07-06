document.addEventListener('DOMContentLoaded', () => {
    const app = document.getElementById('question_reponses');
    const questions = [
        {
            question: 'Regardez-vous les avis avant de visionner une oeuvre ?',
            options: ['Toujours', 'De temps en temps', 'Jamais']
        },
        {
            question: 'La composition musicale est-elle importante pour vous ?',
            options: ['Oui !!', 'Non, je n\'y fais pas attention']
        },
        {
            question: 'Accordez-vous de l\'importance aux effets spéciaux d\'une oeuvre ?',
            options: ['Oui !!', 'Non, je n\'y fais pas attention']
        },
        {
            question: 'Accordez-vous de l\'importance au casting d\'une oeuvre ?',
            options: ['Toujours', 'De temps en temps', 'Jamais']
        },
        {
            question: 'Quelle serait la durée souhaitée ?',
            options: ['Moins d\'une heure', 'Entre 1h et 1h30', 'Entre 1h30 et 2h', 'Plus de 2h']
        },
        {
            question: 'De quel pays d\'origine préféreriez-vous ?',
            options: ['Etats-Unis', 'Inde', 'Chine', 'Japon', 'Angleterre', 'Allemagne', 'France', 'Corée du Sud', 'Brésil', 'Nigéria', 'Italie', 'Asie', 'Afrique', 'Amérique', 'Europe', 'Je ne sais pas']
        },
        {
            question: 'Quel genre vous attire ? (3 maximum)',
            options: ['Musical', 'Action', 'Romance', 'Talk-Show', 'Western', 'Sport', 'Drama', 'Sci-Fi', 'Animation', 'Documentary', 'Thriller', 'Film-Noir', 'Music', 'Comedy', 'Horror', 'Family', 'Reality-TV', 'Crime', 'Adventure', 'Game-Show', 'Biography', 'Mystery', 'History', 'News', 'Fantasy', 'War']
        },
        {
            question: 'De quelle année ?',
            options: ['Avant 1980', '1980-1990', '1990-2000', '2000-2010', '2010-2020', 'Après 2020', 'Cette année']
        },
        {
            question: 'Voulez vous prendre en comptes les film de votre liste "À voir" ?',
            options: ['Oui', 'Non']
        }
    ];
    
    let currentQuestionIndex = 0;
    const answersQuestions = {};
    const answers = {};
    
    function renderQuestion() {
        if (currentQuestionIndex >= questions.length) {
            displayResults();
            return;
        }
    
        const question = questions[currentQuestionIndex];
        
        app.innerHTML = `
            <div class="container text-center col-lg-6 my-md-5 py-2">
                <h3>${question.question}</h3>
            </div>
            <div class="options container text-center py-1 py-md-1 d-flex flex-wrap justify-content-center">
            ${question.options.map(option => `
                <button class="option col-5 col-md-3 nav-btn btn btn-warning border border-dark border-2 rounded-3 m-2">${option}</button>
            `).join('')}
            </div>
            ${question.question === 'Quel genre vous attire ? (3 maximum)' ? `
            <div class="container col-lg-6 my-md-5 py-2">
                <button class="btn btn-success w-100">Suivant</button>
            </div>` : ''}
            <div class="alert alert-danger text-center mt-3" style="display: none;" id="alert">Vous ne pouvez sélectionner que 3 genres au maximum.</div>
        `;
        
        if (question.question === 'Quel genre vous attire ? (3 maximum)') {
            let selectedGenres = [];
    
            document.querySelectorAll('.option').forEach(button => {
                button.addEventListener('click', () => {
                    const genre = button.innerText;
    
                    if (selectedGenres.includes(genre)) {
                        selectedGenres = selectedGenres.filter(item => item !== genre);
                        button.classList.remove('btn-warning');
                    } else {
                        if (selectedGenres.length < 3) {
                            selectedGenres.push(genre);
                            button.classList.add('btn-warning');
                        } else {
                            document.getElementById('alert').style.display = 'block';
                            setTimeout(() => {
                                document.getElementById('alert').style.display = 'none';
                            }, 2000);
                        }
                    }
                });
            });
    
            document.querySelector('button.btn-success').addEventListener('click', () => {
                answersQuestions[currentQuestionIndex] = question.question;
                answers[currentQuestionIndex] = selectedGenres;
                currentQuestionIndex++;
                renderQuestion();
            });
        } else {
            document.querySelectorAll('.option').forEach(button => {
                answersQuestions[currentQuestionIndex] = question.question;
                button.addEventListener('click', () => {
                    answers[currentQuestionIndex] = button.innerText;
                    currentQuestionIndex++;
                    renderQuestion();
                });
            });
        }
    }

    function displayResults() {
        app.innerHTML = `
            <div class="container text-center">
                <h2 class="my-4">Vos recommandations :</h2>
                <h3 class="my-3">Veuillez patientez que les résultats se chargent...</h3>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        
        fetch('../../inc/php/function_questionnaire_co.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({answers: answers, answersQuestions: answersQuestions}),
        })
        .then(response => response.json())
        .then(data => { 
            console.log(data);
            try {
                fetch(`../../inc/php/recommendation_for_questionnaire.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data.movies),
                });
            } catch (error) {
                console.error('Erreur lors de l\'ajout des film à la liste de recommandation', error);
            }

            app.innerHTML = `
                <div class="container">
                    <h2 class="text-center my-4">Vos recommandations :</h2>
                    <ul class="list-group">
                        ${data.movies.map(movie => `
                            <li class="list-group-item mt-1">
                                <a href="oeuvre.php?mv=${movie.id_work}" class="text-decoration-none">
                                    ${movie.primaryTitle}
                                </a>
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `;
        })
        .catch(error => {
            console.error(error);
            app.innerHTML = `
                <div class="container text-center">
                    <h2 class="text-center my-4">Erreur</h2>
                    <p>Une erreur est survenue. Veuillez réessayer plus tard.</p>
                </div>
            `;
        });
    }

    const currentURL = new URL(document.URL);
    const params = new URLSearchParams(currentURL.search);

    if (params.size == 0){
        renderQuestion();
    }
});
