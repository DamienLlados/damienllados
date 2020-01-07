<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-dark">
    <h5 class="my-0 mr-md-auto text-white">TODO DADA</h5>
    <nav class="my-2 my-md-0 mr-md-3 ">
    <?php
    if ($_SESSION['is_Admin'] == 1){
        echo "    <a class='p-2 text-light' href=\"?Page=Admin\">Administration</a>";
    }
    ?>
    <a class='p-2 text-light' href="?Page=Taches">Taches</a>
    <a class='p-2 text-light' href="?Page=Deconnexion">Déconnexion</a>
    </nav>
</div>
