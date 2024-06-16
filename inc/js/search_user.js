const searchKeywordUser = async () => {
    const resultatsUser = document.querySelector("#resultats_user");
    resultatsUser.innerHTML = "";
    let keywordUser = document.querySelector("#navbar_user").value;
    if (keywordUser.length > 3) {
        try {
            const req = await fetch(`../../inc/php/function_input_search_user.php?keyword_user=${encodeURIComponent(keywordUser)}`);
            const json = await req.json();
            if (json.error) {
                console.error('Erreur:', json.error);
                resultatsUser.innerHTML = '<div class="text-center text-danger">Une erreur s\'est produite. Veuillez réessayer plus tard.</div>';
            } else if (json.length > 0) {
                json.forEach((post) => {
                    let buttonHtml = '';
                    if (post.is_friend) {
                        buttonHtml = '<button class="nav-btn btn btn-sm btn-outline-secondary" disabled>Déjà amis</button>';
                    } else if (post.request_sent) {
                        buttonHtml = '<button class="nav-btn btn btn-sm btn-outline-secondary" disabled>Demande envoyée</button>';
                    } else if(post.request_received){
                        buttonHtml = '<button class="nav-btn btn btn-sm btn-outline-secondary" disabled>vas voir tes demandes là</button>';
                    } else {
                        buttonHtml = `<a href="my_friend_list.php?demande=attente_demande_ami&id=${post.id_user}" class="nav-btn btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Ajouter en amis</a>`;
                    }

                    resultatsUser.innerHTML += 
                    `<div class="d-flex flex-column align-items-center text-center">
                        <img class="mb-3" width="150px" src="../../inc/img/profile.svg">
                        <span class="text-black-50">#${post.id_user}</span>
                        <span>${post.pseudo}</span>
                        <span>${post.nom} ${post.prenom}</span>
                        ${buttonHtml}
                    </div>`;
                });
            } else {
                resultatsUser.innerHTML = '<div class="text-center">Aucun résultat trouvé</div>';
            }
        } catch (error) {
            console.error('Erreur:', error);
            resultatsUser.innerHTML = '<div class="text-center text-danger">Une erreur s\'est produite. Veuillez réessayer plus tard.</div>';
        }
    }
}
