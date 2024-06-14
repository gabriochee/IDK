// Ce fichier concerne les listes de films des amis et PAS les listes d'amis
const listsResults = document.getElementById("lists-results");

function showFriendLists(elem){
    const friendId = elem.value;

    fetch("../../inc/php/show_friend_lists.php?" + new URLSearchParams({friendId : friendId}), {credentials : "same-origin"})
    .then(data => data.json())
    .then(json => {
        listsResults.innerHTML = "";
        listsResults.parentNode.parentNode.querySelector(".modal-title").innerText = "Les listes de " + elem.parentNode.querySelector(".username").innerText;

        if (json.length > 0){
            for (const list of json) {
                let link = document.createElement('a');
                link.classList.add("text-decoration-none", "text-center");
                link.href = "./private_list.php?id_liste=" + list.id_liste;
                link.innerText = list.nom;

                listsResults.appendChild(link);
            }
        } else {
            listsResults.innerText = "Cette utilisateur ne possède aucune liste.";
        }
    })
    .catch(error => console.error(error));
}