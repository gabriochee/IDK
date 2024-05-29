document.addEventListener('DOMContentLoaded', () => {
    const app = document.getElementById('question_reponses');

    const questions = [
        {
            question: 'Regardez vous les avis avant de visionner une oeuvre ?',
            options: ['Toujours', 'De temps en temps', 'Jamais']
        },
        {
            question: 'La composition musical est elle importante pour vous ?',
            options: ['Oui !!', 'Non, je n\'y fais pas attention']
        },
        {
            question: 'Accorder-vous de l\'importance au effet-spéciaux d\'une oeuvre ?',
            options: ['Oui !!', 'Non, je n\'y fais pas attention']
        },
        {
            question: 'Lorsque vous recherchez une oeuvre à visionner vers qu\'elle catégorie vous orientez vous ?',
            options: ['Tendance', 'Nouveauté', 'Recommandation de l\'entourage', 'Aucun, au hasard']
        },
        {
            question: 'Accorder-vous de l\'importance au casting d\'une oeuvre ?',
            options: ['Toujours', 'De temps en temps', 'Jamais']
        },
        {
            question: 'Qu\'elle serais la durée souhaitez ?',
            options: ['Moins d\'une heure', 'Entre 1h et 1h30', 'Entre 1h30 et 2h', 'Plus de 2h']
        },
        {
            question: 'De qu\'elle pays d\'origine préféreriez-vous ? (3 maximum)',
            options: ['Etats-Unies', 'Inde', 'Chine', 'Japon', 'Angleterre', 'Allemagne', 'France', 'Corée du Sud', 'Bresil', 'Nigéria', 'Italie', 'Asie', 'Afrique', 'Amérique', 'Europe', 'Je ne sais pas']
        },
        {
            question: 'Qu\'elle genre vous attire ? (3 maximum)',
            options: ['Musical', 'Action', 'Romance', 'Talk-Show', 'Western', 'Sport', 'Drama', 'Sci-Fi', 'Animation', 'Documentary', 'Thriller', 'Film-Noir', 'Music', 'Comedy', 'Horror', 'Family', 'Reality-TV', 'Crime', 'Adventure', 'Game-Show', 'Biography', 'Mistery', 'History', 'News', 'Fantasy', 'War']
        },
        {
            question: 'De quelle année ?',
            options: ['Avant 1980', '1980-1990', '1990-2000', '2000-2010', '2010-2020', 'Après 2020', 'Cette année']
        },
        {
            question: 'Voulez vous prendre en comptes les film de votre liste à voir ?',
            options: ['Oui !!', 'Non']
        }
    ];

    let currentQuestionIndex = 0;
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
            ${question.options.map(option => `<div class="options container col-4 text-center py-1 py-md-1"><button class="option col nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-sm-5 px-3 w-100">${option}</button></div>`).join('')}
        `;

        document.querySelectorAll('.option').forEach(button => {
            button.addEventListener('click', () => {
                answers[currentQuestionIndex] = button.innerText;
                currentQuestionIndex++;
                renderQuestion();
            });
        });
    }

    function displayResults() {
        // Envoyer les réponses au backend pour obtenir les recommandations de films
        fetch('function_questionnaire.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(answers),
        })
        .then(response => response.json())
        .then(data => {
            app.innerHTML = `
                <h2>Vos recommandations :</h2>
                <ul>
                    ${data.movies.map(movie => `<li>${movie.title}</li>`).join('')}
                </ul>
            `;
        });
    }

    renderQuestion();
});
