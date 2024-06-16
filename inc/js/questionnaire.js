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
        }
    ];

    let currentQuestionIndex = 0;
    const answers = {};

    function renderQuestion() {
        if (currentQuestionIndex >= questions.length) {
            displayResults();
            return;
        }

        console.log("Rendering question:", currentQuestionIndex);

        const question = questions[currentQuestionIndex];

        // Si la question est "Quel genre vous attire ? (3 maximum)"
        if (question.question === 'Quel genre vous attire ? (3 maximum)') {
            app.innerHTML = `
                <div class="container text-center col-lg-6 my-md-5 py-2">
                    <h3>${question.question}</h3>
                </div>
                ${question.options.map(option => `
                    <div class="options container col-4 text-center py-1 py-md-1">
                        <button class="option col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3 w-50">${option}</button>
                    </div>
                `).join('')}
                <div class="container col-lg-6 my-md-5 py-2">
                    <button class="btn btn-success w-100">Suivant</button>
                </div>
            `;

            let selectedGenres = [];

            document.querySelectorAll('.option').forEach(button => {
                button.addEventListener('click', () => {
                    const genre = button.innerText;

                    // Vérifier si le genre est déjà sélectionné
                    if (selectedGenres.includes(genre)) {
                        // Désélectionner le genre si déjà sélectionné
                        selectedGenres = selectedGenres.filter(item => item !== genre);
                        button.classList.remove('btn-warning');
                    } else {
                        // Vérifier si déjà 3 genres sélectionnés
                        if (selectedGenres.length < 3) {
                            selectedGenres.push(genre);
                            button.classList.add('btn-warning');
                        } else {
                            // Empêcher de sélectionner plus de 3 genres
                            alert('Vous ne pouvez sélectionner que 3 genres au maximum.');
                        }
                    }
                    console.log("Selected genres:", selectedGenres);
                });
            });

            document.querySelector('button.btn-success').addEventListener('click', () => {
                answers[currentQuestionIndex] = selectedGenres;
                console.log("Answers so far:", answers);
                currentQuestionIndex++;
                renderQuestion();
            });

        } else {
            // Pour les autres questions à sélection unique
            app.innerHTML = `
                <div class="container text-center col-lg-6 my-md-5 py-2">
                    <h3>${question.question}</h3>
                </div>
                ${question.options.map(option => `
                    <div class="options container col-4 text-center py-1 py-md-1">
                        <button class="option col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3 w-50">${option}</button>
                    </div>
                `).join('')}
            `;

            document.querySelectorAll('.option').forEach(button => {
                button.addEventListener('click', () => {
                    answers[currentQuestionIndex] = button.innerText;
                    console.log("Answers so far:", answers);
                    currentQuestionIndex++;
                    renderQuestion();
                });
            });
        }
    }

    function displayResults() {
        console.log(JSON.stringify(answers));
        app.innerHTML = `
                <h2 class="text-center">Vos recommandations :</h2>
                <h3 class="text-center">Veuillez patientez que les resultats se chargent</h3>
            `;                
        fetch('http://localhost:8888/IDK/inc/php/function_questionnaire.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(answers),
        })
        .then(response => response.json())
        .then(data => {
            console.log("Data received from server:", data); // Ajoutez cette ligne pour voir les données reçues
            app.innerHTML = `
                <h2 class="text-center">Vos recommandations :</h2>
                <ul>
                    ${data.movies.map(movie => `<li><a href="oeuvre.php?mv=${movie.id_work}" class="text-decoration-none">${movie.primaryTitle}</a></li>`).join('')}
                </ul>
            `;
        })
        .catch(error => {
            console.error('Erreur :', error);
            alert('Une erreur est survenue. Veuillez réessayer plus tard.');
        });
    }

    renderQuestion();
});