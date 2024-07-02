const moviePosters = document.querySelectorAll('.movie-poster');

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

function onResponse(response, poster){
    response.json().then(data => displayPoster(data, poster)).catch(onError);
}

function displayPoster(jsonData, poster) {
  const movie = jsonData.results[0];
  if (movie != undefined){
    const posterPath = movie.poster_path;

    const rootPosterPath = "https://image.tmdb.org/t/p/w300/";

    poster.src = rootPosterPath + posterPath;
    poster.classList.add('shadow')
    poster.parentNode.style.backgroundColor = 'transparent';
  }
}

for (const poster of moviePosters){
    const movieTitle = poster.getAttribute('movie-title');
    const movieYear = poster.getAttribute('movie-year');

    fetch('https://api.themoviedb.org/3/search/movie?query=' + movieTitle + '&year=' + movieYear, options).then(response => onResponse(response, poster)).catch(onError);
}