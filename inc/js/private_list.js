const movieCards = document.querySelectorAll(".movie-card");
const listStatusRadios = document.querySelectorAll("input[name=list-status]");
const cardsContainer = document.getElementById("cards-container");

const options = {
  method: 'GET',
  headers: {
    accept: 'application/json',
    Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1OTBhYWMzNjU1YmExZTEwMTcyYWJlZjU3MDc0OTgwZCIsInN1YiI6IjY1ZjAyYTlhN2YwNTQwMDE2NDg1YzIxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.atWZDSfbE9mllUcg52T_TxrGckrUxIARkgiOhCxpaE4'
  }
};

const searchKeywordMovieList = async () => {
    document.querySelector("#results-movie").innerHTML = "";
    let keyword_movie = document.querySelector("#search-movie-input").value;
    if(keyword_movie.length > 3) {
        const req = await fetch(`../../inc/php/function_input_search_movie.php?keyword_movie=${keyword_movie}`);
        const json = await req.json()
        if(json.length > 0) {
            json.forEach((post) => {
                const linkUrl = `oeuvre.php?mv=${post.id_work}`;
                document.querySelector("#results-movie").innerHTML += `<div class="container d-flex justify-content-between mb-2"><a href="${linkUrl}" class="text-decoration-none text-start">${post.title}</a><button value=${post.id_work} onclick=addMovieToList(this) type="button" class="btn btn-warning py-0 px-1"><i class="bi bi-plus-square"></i></button></div>`;
            });
        }
    }
}

const searchFriend = async () => {
  const friendsResultsContainer = document.querySelector("#friends-result-container");
  friendsResultsContainer.innerHTML = "";

  let friendKeyword = document.getElementById("search-friend-input").value;
  const req = await fetch(`../../inc/php/search_friend.php?` + new URLSearchParams({friend_keyword : friendKeyword}), {credentials : "same-origin"});
  const res = await req.json();

  for (const user of res){
    friendsResultsContainer.innerHTML += `<div class="d-flex justify-content-between"><p>${user.pseudo}</p><button type="button" class="btn btn-warning" onclick="sendListToFriend(this, ${user.id_user})">Envoyer</button></div>`;
  }
}

const sendListToFriend = async (elem, idFriend) => {
  const url = location.protocol + '//' + location.host + location.pathname;

  let message = elem.parentNode.parentNode.parentNode.querySelector('textarea').value;
  await fetch('../../inc/php/share_list_counter.php?' + new URLSearchParams({idListe : id_liste}));
  let req = await fetch('../../inc/php/send_message_chat.php', {
  method: "post",
  credentials : "same-origin",
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  body : JSON.stringify({
    message : message + ' \r\n' + url + '?' + new URLSearchParams({id_liste : id_liste}),
    idFriend : idFriend
  })
})
}

const addMovieToList = async (btn) => {
    const id_work = btn.value;
    await fetch(`../../inc/php/add_to_list.php?id_work=${id_work}&id_liste=${id_liste}`).catch(error => console.error(error));
    let promise = await fetch("../../inc/php/get_movie_card.php?" + new URLSearchParams({mv: id_work, id_liste : id_liste}), {credentials : 'same-origin'});
    let card = await promise.text() 
    cardsContainer.innerHTML += card;
    setCardsContent();
}

function onError(error){
  console.error(error);
}

function onResponse(response, card){
    response.json().then(data => work(data, card)).catch(onError);
}

function work(jsonData, card) {
  const movie = jsonData.results[0];
  const posterPath = movie.poster_path;
  const rootPosterPath = "https://image.tmdb.org/t/p/w185/";

  card.src = rootPosterPath + posterPath;
}

async function setCardsContent() {
  for (const card of movieCards) {
    const movieTitle = card.getAttribute("movie-title").toString();
    const movieYear = card.getAttribute("movie-year").toString();

    await fetch(
      "https://api.themoviedb.org/3/search/movie?query=" +
        movieTitle +
        "&year=" +
        movieYear,
      options
    )
      .then(data => onResponse(data, card))
      .catch(onError);
  }
}

listStatusRadios.forEach((elem) => {
  elem.addEventListener('change', function () {
    fetch("../../inc/php/update_list_status.php?" + new URLSearchParams({id_liste : id_liste, list_status : elem.value})).catch(error => console.error(error));
  })
})

setCardsContent();
