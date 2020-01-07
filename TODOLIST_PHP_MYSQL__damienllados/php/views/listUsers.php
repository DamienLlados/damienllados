<?php
echo "
        <h5 class='small-marge'>Liste des Utilisateurs :</h5>
        <div id='todo' class=' '>
";
foreach ($userlist as $user) {

    $userid = $user["id"];
    $usernom = $user["nom"];
    $userprenom = $user["prenom"];
    $usermail = $user["mail"];
    $userisadmin = $user["is_admin"];

    echo"
            <form id='form$$userid' class='small-marge-down small-marge ' method='post' action='?action=deleteUser'>
            <input  name='userid' type='hidden' value='$userid'>
                <div class='row'>
                    <div class='col-md-1'></div>
                    <div class='col-md-3'>
                        <p>Mail :</p>
                        <input id='mail$userid' name='mail' class='form-control' type='text' value=\"$usermail\">
                    </div>
                    <div class='col-md-2'>
                        <p>Nom :</p>
                        <input id='nom$userid' name='nom' class='form-control' type='text' value=\"$usernom\">
                    </div>
                    <div class='col-md-2'>
                        <p>Prénom :</p>
                        <input id='prenom$userid' name='prenom' class='form-control' type='text' value=\"$userprenom\">
                    </div>
                    <div class='col-md-2'>
                        <p>Pass :</p>
                        <input type='password' id='password$userid' name='password' class='form-control' type='text' value=\"\">
                    </div>
                    <div class='col-md-2 text-center'>
                        <p>Admin :</p>";
    if ($userisadmin == 1){
        echo "                        <input name='isAdmin' id='isAdmin' type='checkbox' class='form-check-input' checked>";
    }
    else{
        echo "                        <input name='isAdmin' id='isAdmin' type='checkbox' class='form-check-input'>";
    }
        echo"
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-1'></div>
                    <div class='col-md-4'>
                        <button type='submit' formaction='?action=updateUser' class='btn btn-primary tiny-marge'>Modifier</button>
                        <button type='submit' formaction='?action=deleteUser' class='btn btn-primary tiny-marge'>Supprimer</button>
                    </div>
                </div>
            </form>
            ";
}

?>