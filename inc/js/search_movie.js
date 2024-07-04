const searchKeywordMovie = async () => {
    document.querySelector("#resultats_movie").innerHTML = "";
    let keyword_movie = document.querySelector("#navbar_movie").value;
    if(keyword_movie.length > 3) {
        const req = await fetch(`../../inc/php/function_input_search_movie.php?keyword_movie=${keyword_movie}`);
        const json = await req.json()
        if(json.length > 0) {
            json.forEach((post) => {
                const linkUrl = `oeuvre.php?mv=${post.id_work}`;
                document.querySelector("#resultats_movie").innerHTML += `<a href="${linkUrl}" class="text-white text-decoration-none" onclick="addMovieToRecommandation(${post.id_work})">• ${post.title}</a><br>`;
            });
        }
    }
}   
 
const addMovieToRecommandation = async (id_work) => {
    try {
        await fetch(`../../inc/php/recommendation_for_search.php?id_work=${id_work}`, {
            credentials: 'same-origin'
        });
    } catch (error) {
        console.error('Erreur lors de l\'ajout du film à la liste:', error);
    }
}