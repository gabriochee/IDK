function searchMyLists(elem, text){
    if (text.trim() != ""){
        fetch('../../inc/php/search_my_lists.php?' + new URLSearchParams({keyword : text, id_work : idMovie}), {credentials : 'same-origin'})
        .then(data => data.json())
        .then(json => {
            let listsContainer = elem.parentNode.querySelector('div');
            listsContainer.innerHTML = "";
            if (json.length === 0){
                listsContainer.innerHTML += '<p class="container text-center">Aucune liste trouvée.</p>';
            } else {
                for (const list of json){
                    if (list.contains_work){
                        listsContainer.innerHTML += `<div class="d-flex justify-content-between"><p>${list.nom}</p><span class="badge text-bg-secondary">Déjà présent</span></div>`;
                    } else {
                        listsContainer.innerHTML += `<div class="d-flex justify-content-between"><p>${list.nom}</p><button type="button" class="btn btn-warning" onclick="addMovieToUserList(${list.id_liste}, ${idMovie}); this.disabled = true;">Ajouter</button></div>`;
                    }
                }
            }
        })
        .catch(err => console.error(err));
    }
}

function addMovieToUserList(idListe, idMv) {
    fetch('../../inc/php/add_to_list.php?' + new URLSearchParams({ id_liste: idListe, id_work: idMv }))
        .then(data => data.json())
        .then(json => {
            if (json['error'] != undefined) {
                console.log(json['error']);
            }
        })
        .catch(error => console.error(error));
}