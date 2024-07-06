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
                        buttonHtml = '<button class="btn btn-sm btn-outline-secondary" disabled>Déjà amis</button>';
                    } else if (post.request_sent) {
                        buttonHtml = '<button class="btn btn-sm btn-outline-secondary" disabled>Demande envoyée</button>';
                    } else if (post.request_received) {
                        buttonHtml = '<button class="btn btn-sm btn-outline-secondary" disabled>Vas voir tes demandes</button>';
                    } else {
                        buttonHtml = `<a href="my_friend_list.php?demande=attente_demande_ami&id=${post.id_user}" class="btn btn-sm btn-outline-secondary" type="submit" name="envoyer_ami">Ajouter en amis</a>`;
                    }

                    resultatsUser.innerHTML += 
                    `<div class="card mb-3" style="width: 18rem;">
                        
                        <div class="card-body text-center">
                            <h5 class="card-title">#${post.id_user}</h5>
                            <p class="card-text">${post.pseudo}</p>
                            <p class="card-text">${post.nom} ${post.prenom}</p>
                            ${buttonHtml}
                        </div>
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