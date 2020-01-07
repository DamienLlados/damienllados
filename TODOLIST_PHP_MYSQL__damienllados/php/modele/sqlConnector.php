<?php
class Sqlconnector{
    function __construct(){
        $this->dsn = "mysql:host=localhost;dbname=todolist";
        $this->user = "toto";
        $this->passwd = "toto";
        $this->pdo = new PDO($this->dsn, $this->user, $this->passwd);
    }
    
    public function getTasks($userid,$with_deleted){
        if ($with_deleted == 1){
            $result = $this->pdo->query("SELECT * from todo WHERE id_user=$userid;");
        }
        else{
            $result = $this->pdo->query("SELECT * from todo WHERE id_user=$userid AND is_deleted=0;");
        }
        return($result->fetchAll(PDO::FETCH_ASSOC));
    }
    public function deleteTask($id_task){
        $this->pdo->exec("UPDATE todo set is_deleted=1 WHERE id=$id_task;");
    }
    public function addTask($title_task,$desc_task,$id_User){
        $this->pdo->exec("INSERT INTO todo (titre,description,is_deleted,id_user) VALUES (\"$title_task\",\"$desc_task\",\"0\",\"$id_User\");");
    }
    public function updateTask($id_task,$newtitle_task,$newdesc_task){
        $this->pdo->exec("UPDATE todo SET titre=\"$newtitle_task\", description=\"$newdesc_task\" WHERE id=$id_task;");
    }
    public function loginUser($mail){
        $result = $this->pdo->query("SELECT * from user WHERE mail = \"$mail\"");
        return($result->fetchAll(PDO::FETCH_ASSOC));
    }
    public function getTaskUser($id_task){
        $result = $this->pdo->query("SELECT id_user from todo WHERE id=$id_task;");
        return($result->fetchAll(PDO::FETCH_ASSOC));
    }
    public function getUsers(){
        $result = $this->pdo->query("SELECT * from user ;");
        return($result->fetchAll(PDO::FETCH_ASSOC));
    }
    public function deleteUser($id_user){
        $this->pdo->exec("DELETE FROM user WHERE id=$id_user");
    }
    public function addUser($mail_user,$nom_user,$prenom_user,$password,$is_admin){
        $this->pdo->exec("INSERT INTO user (mail,nom,prenom,pass,is_admin) VALUES (\"$mail_user\",\"$nom_user\",\"$prenom_user\",\"$password\",$is_admin);");
    }
    public function updateUser($id_user,$mail_user,$nom_user,$prenom_user,$password,$is_admin){
        if ($password == ""){
            $this->pdo->exec("UPDATE user SET mail=\"$mail_user\", nom=\"$nom_user\", prenom=\"$prenom_user\", is_admin=\"$is_admin\" WHERE id=$id_user;");
        }
        else{
            $password = password_hash($password,PASSWORD_DEFAULT);
            $this->pdo->exec("UPDATE user SET mail=\"$mail_user\", nom=\"$nom_user\",pass=\"$password\" , prenom=\"$prenom_user\", is_admin=\"$is_admin\" WHERE id=$id_user;");
        }
    }
}
