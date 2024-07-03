const star1 = document.getElementById("rate-1");
const star2 = document.getElementById("rate-2");
const star3 = document.getElementById("rate-3");
const star4 = document.getElementById("rate-4");
const star5 = document.getElementById("rate-5");

const stars = [star1, star2, star3, star4, star5];
let note = 0;

const moviePoster = document.getElementById("movie-poster");
const movieSynposis = document.getElementById("movie-synopsis");
const movieTitle = document.getElementById("movie-title").innerText;
const movieYear = document.getElementById("movie-year").innerText;

var urlParams = new URLSearchParams(window.location.search);
var idMovie = urlParams.get('mv');

const searchFriend = async () => {
  const friendsResultsContainer = document.querySelector("#friends-result-container");
  friendsResultsContainer.innerHTML = "";

  let friendKeyword = document.getElementById("search-friend-input").value;
  const req = await fetch(`../../inc/php/search_friend.php?` + new URLSearchParams({friend_keyword : friendKeyword}), {credentials : "same-origin"});
  const res = await req.json();

  for (const user of res){
    friendsResultsContainer.innerHTML += `<div class="d-flex justify-content-between"><p>${user.pseudo}</p><button type="button" class="btn btn-warning" onclick="sendMovieToFriend(this, ${user.id_user})">Envoyer</button></div>`;
  }
}

const sendMovieToFriend = async (elem, idFriend) => {
  const url = location.protocol + '//' + location.host + location.pathname;

  let message = elem.parentNode.parentNode.parentNode.querySelector('textarea').value;
  let req = await fetch('../../inc/php/send_message_chat.php', {
  method: "post",
  credentials : "same-origin",
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  body : JSON.stringify({
    message : message + ' \r\n' + url + '?' + new URLSearchParams({mv : idMovie}),
    idFriend : idFriend
  })
})
}
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

if (star1 != undefined){
  stars.forEach((star) => {
    star.addEventListener("click", async function (clickEvent) {
      note = 0;
      for (let i = 0; i < stars.indexOf(star); i++) {
        stars[i].classList.remove("bi-star-half");
        stars[i].classList.remove("bi-star");
        stars[i].classList.add("bi-star-fill");
        note++;
      }

      for (let i = 4; i > stars.indexOf(star); i--) {
        stars[i].classList.remove("bi-star-half");
        stars[i].classList.remove("bi-star-fill");
        stars[i].classList.add("bi-star");
      }

      if (clickEvent.offsetX > 25) {
        star.classList.remove("bi-star");
        star.classList.remove("bi-star-half");
        star.classList.add("bi-star-fill");
        note++;
      } else {
        star.classList.remove("bi-star");
        star.classList.remove("bi-star-fill");
        star.classList.add("bi-star-half");
        note += .5;
      }

      fetch("../../inc/php/send_comment_and_note.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          note : note * 2,
          statut: "privee",
          idMovie: idMovie,
        }),
      })
        .then((response) => response.json())
        .catch((error) => {
          alert("Erreur lors u message : " + error.message);
        });

    });
  });
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
