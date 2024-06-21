const searchBar = document.querySelector("input[type=search]");
const listsContainer = document.getElementById("lists-container");

function searchPublicList(text){
    if (text.trim() != ""){
        fetch('../../inc/php/search_public_list.php?' + new URLSearchParams({keyword : text}))
        .then(data => data.json())
        .then(json => {
            listsContainer.innerHTML = "";
            if (json.length === 0){
                listsContainer.innerHTML += '<p class="container text-center">Aucune liste trouvée.</p>';
            } else {
                for (const list of json){
                    listsContainer.innerHTML += `<a href="./private_list.php?${new URLSearchParams({id_liste : list.id_liste})}">${list.nom}</a>`;
                }
            }
        })
        .catch(err => console.error(err));
    }
}