const movieCards = document.querySelectorAll(".movie-card");

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

const addMovieToList = async (btn) => {
    const id_work = btn.value;
    await fetch(`../../inc/php/add_to_list.php?id_work=${id_work}&id_liste=${id_liste}`);
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

setCardsContent();
