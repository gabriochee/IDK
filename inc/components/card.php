<div class="card border border-dark border-2 rounded-3 col" style="background-color: #E8EDDE;">
    <img src="../../inc/img/film.svg" movie-title="<?php echo $filmName;?>" movie-year=<?php echo $filmYear;?> class="movie-card card-img-top rounded-0 border-2 border-dark mt-1 p-xl-4 p-md-2 p-sm-4" alt="<?php echo $filmName;?>">
    <div class="card-body text-center pt-0">
        <h5 class="card-title mb-2"><?php echo $filmName;?></h5>
        <a href="../../client/connected/oeuvre.php?mv=<?php echo $filmId;?>" class=" w-100 nav-btn btn btn-primary btn-sm btn-warning border border-dark border-2 rounded-3 fs-5">En voir plus</a>
        <br>
        <?php if ($isOwner) { echo '<button class="w-100 nav-btn btn btn-primary btn-sm btn-danger border border-dark border-2 rounded-3 fs-5 mt-2" onclick="deleteMovieFromList(this)" movie-id="' . $filmId . '" list-id="' . $_GET['id_liste'] . '">Retirer</button>'; } ?>
    </div>
</div>