const cinq = document.getElementById("commentaire-cinq");
const quatre = document.getElementById("commentaire-quatre");
const trois = document.getElementById("commentaire-trois");
const deux = document.getElementById("commentaire-deux");
const un = document.getElementById("commentaire-un");
const zero = document.getElementById("commentaire-zero");

const moviePoster = document.getElementById("movie-poster");
const movieSynposis = document.getElementById("movie-synopsis");
const movieTitle = document.getElementById("movie-title").innerText;
const movieYear = document.getElementById("movie-year").innerText;

document.getElementById("note-cinq").addEventListener("click", function() {
        cinq.style.display = "block";
        quatre.style.display = "none";
        trois.style.display = "none";
        deux.style.display = "none";
        un.style.display = "none";
        zero.style.display = "none";
});
document.getElementById("note-quatre").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "block";
    trois.style.display = "none";
    deux.style.display = "none";
    un.style.display = "none";
    zero.style.display = "none";
});
document.getElementById("note-trois").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "block";
    deux.style.display = "none";
    un.style.display = "none";
    zero.style.display = "none";
});
document.getElementById("note-deux").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "none";
    deux.style.display = "block";
    un.style.display = "none";
    zero.style.display = "none";
});
document.getElementById("note-un").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "none";
    deux.style.display = "none";
    un.style.display = "block";
    zero.style.display = "none";
});
document.getElementById("note-zero").addEventListener("click", function() {
    cinq.style.display = "none";
    quatre.style.display = "none";
    trois.style.display = "none";
    deux.style.display = "none";
    un.style.display = "none";
    zero.style.display = "block";
});
    
const noConnectedElement = document.getElementById("no-connected");
if (noConnectedElement !== null) {
  noConnectedElement.addEventListener("click", function () {
    window.location.href = "../not_connected/signin.php";
  });
}

const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1OTBhYWMzNjU1YmExZTEwMTcyYWJlZjU3MDc0OTgwZCIsInN1YiI6IjY1ZjAyYTlhN2YwNTQwMDE2NDg1YzIxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.atWZDSfbE9mllUcg52T_TxrGckrUxIARkgiOhCxpaE4'
  }
};

function onError(error){
    console.error(error);
}

function onResponse(response){
    response.json().then(work).catch(onError);
}

function work(jsonData) {
  const movie = jsonData.results[0];
  const synopsis = movie.overview;
  const posterPath = movie.poster_path;

  const rootPosterPath = "https://image.tmdb.org/t/p/w500/";

  moviePoster.src = rootPosterPath + posterPath;
  movieSynposis.textContent = synopsis;
}

fetch('https://api.themoviedb.org/3/search/movie?query=' + movieTitle + '&year=' + movieYear, options).then(onResponse).catch(onError);
