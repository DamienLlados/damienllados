<?php
require_once("php/controller/controller.php");
require_once("php/modele/sqlConnector.php");
session_start ();
$controller = new controller();

if (($_POST["loginuser"])){
    $controller->printHead();
    $controller->printNavBar();
    $controller->login($_POST["loginuser"],$_POST["loginpassword"]);
}

elseif (($_SESSION['login'] == "") and ($_SESSION['id'] == "")) {
    $controller->printHead();
    $controller->printLoginPage();
}

else{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $controller->printHead();
        $controller->printNavBar();
        if ($_GET["Page"] == 'Admin'){
            if ($_SESSION['is_Admin'] == 1){
                $controller->printUserFormular();
                $controller->printUsersList();
            }
            else{
                $controller->accessDenied();
            }
        }
        elseif ($_GET["Page"] == 'Deconnexion') {
            $controller->disconnectPage();
        }
        else {
            $controller->printTaskFormular();
            $controller->printTasksList();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller->printHead();
        $controller->printNavBar();
        if ($_GET["action"] == 'deleteTask'){
            if ($controller->taskIsUser($_POST['taskid'],$_SESSION['id'])){
                $controller->deleteTask($_POST['taskid']);
            }
        }
        elseif ($_GET["action"] == 'updateTask'){
            if ($controller->taskIsUser($_POST['taskid'],$_SESSION['id'])){
                $controller->updateTask($_POST['taskid'],$_POST['titletask'],$_POST['desctask']);
            }
        }
        elseif ($_GET["action"] == 'addTask'){
            $controller->addTask($_POST['createTitle'],$_POST['createDesc'],$_SESSION['id']);
        }
        elseif ($_GET["action"] == 'addUser'){
            if ($_SESSION['is_Admin'] == 1){
                $controller->addUser($_POST['createMail'],$_POST['createNom'],$_POST['createPrenom'],$_POST['CreatePassword'],$_POST['isAdmin']);
            }
        }
        elseif ($_GET["action"] == 'addUser'){
            $controller->addUser($_POST['createMail'],$_POST['createNom'],$_POST['createPrenom'],$_POST['CreatePassword'],$_POST['isAdmin']);
        }
        elseif ($_GET["action"] == 'updateUser'){
            if ($_SESSION['is_Admin'] == 1){
                $controller->updateUser($_POST['mail'],$_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['isAdmin'],$_POST['userid']);
            }
        }
        elseif ($_GET["action"] == 'deleteUser'){
            if ($_SESSION['is_Admin'] == 1){
                $controller->deleteUser($_POST['userid']);
            }
        }
        elseif ($_GET["action"] == 'disconnect'){
            $controller->disconnect($_POST['userid']);
        }
    }
}
