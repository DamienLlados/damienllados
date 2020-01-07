<?php
class controller{
    function __construct(){
        $this->conn = new Sqlconnector();
    }
    public function printHead(){
        include('php/views/htmlHead.php');
    }
    public function printNavBar(){
        include('php/views/htmlNavBar.php');
    }
    public function accessDenied(){
        include("php/views/htmlErrorNoAuthorized.php");
    }
    public function printLoginPage(){
        include('php/views/htmlLogin.php');
    }
    public function printTaskFormular(){
        include('php/views/htmlTaskFormular.php');
    }
    public function printTasksList(){
        $tasklist = $this->conn->getTasks($_SESSION['id'],0);
        include('php/views/listTask.php');
    }
    public function printUserFormular(){
        include('php/views/htmlUserFormular.php');
    }
    public function addTask($titleTask,$descTask,$idUser){
        if ($titleTask != ""){
            $this->conn->addTask($titleTask,$descTask,$idUser);
            echo "<p>La tache <strong>$titleTask</strong> a été créé.</p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
        else {
            echo "<p><strong>ERREUR</strong></p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
    }
    public function deleteTask($idTask){
        if ($idTask != ""){
            $this->conn->deleteTask($idTask);
            echo "<p>La tache <strong>$titleTask</strong> a été supprimé.</p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
        else {
            echo "<p><strong>ERREUR</strong></p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
    }
    public function updateTask($idTask,$titleTask,$descTask){
        if ($titleTask == "") {
            echo "<p>C'est mieux avec le <strong>Titre</strong></p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
        elseif ($idTask != ""){
            $this->conn->updateTask($idTask,$titleTask,$descTask);
            echo "<p>La tache <strong>$titleTask</strong> a était mise a jour.</p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
        else {
            echo "<p><strong>ERREUR</strong></p>";
            echo "<meta http-equiv='refresh' content='3;URL=/'>";
        }
    }
    function taskIsUser($idTask,$idUser){
            $idUserTask = $this->conn->getTaskUser($idTask);
            if ($idUserTask[0][id_user] == $idUser){
                return true;
            }
            else {
                return false;
            }
    }
    public function printUsersList(){
        $userlist = $this->conn->getUsers();
        include('php/views/listUsers.php');
    }
    public function addUser($mailUser,$nomUser,$prenomUser,$passUser,$isAdminUser){
        if ((filter_var($mailUser, FILTER_VALIDATE_EMAIL)) and ($nomUser != "") and ($passUser != "")){
            if ($isAdminUser == "on"){ $isAdmin = 1; }
            else { $isAdmin = 0; }
            $this->conn->addUser($mailUser,$nomUser,$prenomUser,password_hash($passUser,PASSWORD_DEFAULT),$isAdmin);
            echo "<p>L'utilisateur <strong>$nomUser</strong> a été créé.</p>";
            echo "<meta http-equiv='refresh' content='3;URL=/?Page=Admin'>";
        }
        else {
            echo "<p><strong>Il faut mail et nom à l'utilisateur.</strong></p>";
            echo "<meta http-equiv='refresh' content='3;URL=/?Page=Admin'>";
        }
    }
    
    public function updateUser($mailUser,$nomUser,$prenomUser,$passUser,$isAdminUser,$userId){
        if ((filter_var($mailUser, FILTER_VALIDATE_EMAIL)) and ($nomUser != "")){
            if ($isAdminUser == "on"){ $isAdmin = 1; }
            else { $isAdmin = 0; }
            $this->conn->updateUser($userId,$mailUser,$nomUser,$prenomUser,$passUser,$isAdmin);
            echo "<p>L'utilisateur <strong>$nomUser</strong> a été mis à jour.</p>";
            echo "<meta http-equiv='refresh' content='3;URL=/?Page=Admin'>";
        }
        else {
            echo "<p><strong>Il faut mail, nom et mot de passe à un utilisateur.</strong></p>";
            echo "<meta http-equiv='refresh' content='3;URL=/?Page=Admin'>";
        }
    }
    public function deleteUser($userId){
        if ($userId != ""){
            $this->conn->deleteUser($userId);
            echo "<p>L'utilisateur <strong>$nomUser</strong> a été supprimé.</p>";
            echo "<meta http-equiv='refresh' content='3;URL=/?Page=Admin'>";
        }
    }
    public function login($loginuser,$loginpassword){
        $userinfo = $this->conn->loginUser($loginuser);
        foreach ($userinfo as $user){
            $userId = $user["id"];
            $userPass = $user["pass"];
            $userNom = $user["nom"];
            $userPrenom = $user["prenom"];
            $userMail = $user["mail"];
            $userIsAdmin = $user["is_admin"];
        }
        if (password_verify($loginpassword,$userPass)){
            $_SESSION['login'] = $userMail;
            $_SESSION['id'] = $userId;
            $_SESSION['prenom'] = $userPrenom;
            $_SESSION['nom'] = $userNom;
            $_SESSION['is_Admin'] = $userIsAdmin;
            include('php/views/htmlOkLogin.php');
        }
        else{
            include('php/views/htmlErrorLogin.php');
        }
    }
    public function disconnectPage(){
        include('php/views/htmlDisconnect.php');
    }
    public function disconnect(){
        session_destroy();
        echo "<p><strong>Vous êtes bien déconnecté</strong></p>";
        echo "<meta http-equiv='refresh' content='3;URL=/'>";
    }
}
?>
