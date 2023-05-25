<?php
require('inc/pdo.php');

function ValidationText($errors, $elts, $val , $Val1, $Val2 ){
    if(!empty($elts)) {
        if(mb_strlen($elts) < $Val1 ){
            $errors[$val] = 'Veuillez renseigner plus de '.$Val1.' caractères';
        }
        elseif(mb_strlen($elts) > $Val2) {
            $errors[$val] = 'Veuillez renseigner moins de '.$Val2.' caractères';
        }
    }
    else {
        $errors[$val] = 'Veuillez saisir des caractères';
    }
    return $errors;
}


function validationEmail($errors, $email, $entry = 'mail')
{
    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[$entry] = 'L\'email n\'est pas valide';
        }
    } else {
        $errors[$entry] = 'Ce champ est obligatoire';
    }
    return $errors;
}


function debug($tableau)
{
    echo '<pre style="height:150px;overflow-y: scroll;font-size: .7rem;padding: .6rem;font-family: Consolas, Monospace; background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}


function redirectNotFound()
{
    header("HTTP/1.0 404 Not Found");
    header('Location: 404.php');
}


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function isLogged()
{
    if (!empty($_SESSION['user']['id'])) {
        if (is_numeric($_SESSION['user']['id'])) {
            /*if(!empty($_SESSION['user']['nom'])){
                if (!empty($_SESSION['user']['prenom'])) {*/
            if (!empty($_SESSION['user']['email'])) {
                if (!empty($_SESSION['user']['role'])) {
                    return true;
                }
            }
        }
        /* }*/
        /* }*/
    }
    return false;
}

function isAdmin()
{
    if (isLogged()) {
        if ($_SESSION['user']['role'] == 'admin') {
            return true;
        }
    }
    return false;
}

function isUser()
{
    if (isLogged()) {
        if ($_SESSION['user']['role'] == 'abonne') {
            return true;
        }
    }
    return false;
}

function isCount(){
    if (isLogged()) {
        if ($_SESSION['user']['role'] == 'admin') {
            return count($_SESSION);
        }
    }
    return false;
}

function isCountuser($role = 'abonne')
{
    global $pdo;
    $sql = 'SELECT * FROM user WHERE role = "abonne" ';
    $query = $pdo->prepare($sql);
    $query->execute();
    $user = $query->fetchAll();
    return count($user);

}


function cleanXss($key){
    return trim(strip_tags($_POST[$key]));
}

function isCountavis(){
    global $pdo;
    $sql = 'SELECT * FROM avis ';
    $query = $pdo->prepare($sql);
    $query->execute();
    $avis = $query->fetchAll();
    return count($avis);

}
function getAdminById($id) {
    global $pdo;
    $sql = "SELECT * FROM user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(); }

function getVaccinById($id) {
    global $pdo;
    $sql = "SELECT * FROM vaccin WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function updateVaccin($id,$nom_vaccin,$maladie,)
{
    global $pdo;
    $sql = "UPDATE vaccin SET title = :title, description = :description WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('title', $nom_vaccin, PDO::PARAM_STR);
    $query->bindValue('description', $maladie ,PDO::PARAM_STR);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
}

function updateAdmin($id,$nom, $prenom,)
{
    global $pdo;
    $sql = "UPDATE user SET nom = :nom, prenom = :prenom WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('nom', $nom, PDO::PARAM_STR);
    $query->bindValue('prenom', $prenom ,PDO::PARAM_STR);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
}


function getPostValue($key)
{
    if (!empty($_POST[$key])) {
        echo $_POST[$key];
    }
}
function getIdByUser($id){
    global $pdo;
    $sql = "SELECT * FROM user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function viewError ($errors, $key)
{
    if (!empty($errors[$key])) {
        echo $errors[$key];
    }
}