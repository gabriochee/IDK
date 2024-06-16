const cinq = document.getElementById("commentaire-cinq");
const quatre = document.getElementById("commentaire-quatre");
const trois = document.getElementById("commentaire-trois");
const deux = document.getElementById("commentaire-deux");
const un = document.getElementById("commentaire-un");
const zero = document.getElementById("commentaire-zero");

const star1 = document.getElementById("rate-1");
const star2 = document.getElementById("rate-2");
const star3 = document.getElementById("rate-3");
const star4 = document.getElementById("rate-4");
const star5 = document.getElementById("rate-5");

const stars = [star1, star2, star3, star4, star5];

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

stars.forEach(star => {
  star.addEventListener("click", function (clickEvent) {
    for (let i = 0; i < stars.indexOf(star); i++){
      stars[i].classList.remove("bi-star-half");
      stars[i].classList.remove("bi-star");
      stars[i].classList.add("bi-star-fill");
    }

    for (let i = 4; i > stars.indexOf(star); i--){
      stars[i].classList.remove("bi-star-half");
      stars[i].classList.remove("bi-star-fill");
      stars[i].classList.add("bi-star");
    }

    if (clickEvent.offsetX > 25) {
      star.classList.remove("bi-star");
      star.classList.remove("bi-star-half");
      star.classList.add("bi-star-fill");
    } else {
      star.classList.remove("bi-star");
      star.classList.remove("bi-star-fill");
      star.classList.add("bi-star-half");
    }
  });
})

star1.onclick = function(e){
  if (e.offsetX > 25){
    star1.classList.remove('bi-star');
    star1.classList.remove('bi-star-half');
    star1.classList.add('bi-star-fill');
  } else {
    star1.classList.remove('bi-star');
    star1.classList.remove('bi-star-fill');
    star1.classList.add('bi-star-half');
  }
}

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
