function deleteMovieFromList(elem){
    const idListe = elem.getAttribute("list-id");
    const idMovie = elem.getAttribute("movie-id");

    fetch("http://localhost:3000/inc/php/delete_movie_from_list.php?" + new URLSearchParams({"movie-id" : idMovie, "list-id" : idListe}));

    elem.parentNode.parentNode.remove();

}