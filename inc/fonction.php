<?php
require('inc/pdo.php');


function validationEmail($errors,$email,$entry = 'mail')
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


function debug($tableau) {
    echo '<pre style="height:550px;overflow-y: scroll;font-size: .7rem;padding: .6rem;font-family: Consolas, Monospace; background-color: #000;color:#fff;">';
    print_r($tableau);
    echo '</pre>';
}




function redirectNotFound()
{
    header("HTTP/1.0 404 Not Found");
    header('Location: 404.php');
}

function validateDate($date) {
    $currentDate = date('Y-m-d'); // Date d'aujourd'hui au format 'Y-m-d'

    if ($date<= $currentDate) {
        return true; // Date valide
    } else {
        return false; // Date non valide
    }
}




function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function isLogged() {
    if(!empty($_SESSION['user']['id'])) {
        if(is_numeric($_SESSION['user']['id'])){
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

function isAdmin() {
    if(isLogged()) {
        if($_SESSION['user']['role'] == 'admin') {
            return true;
        }
    }
    return false;
}
function getVaccinById($id) {
    global $pdo;
    $sql = "SELECT * FROM vaccin WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();

    $ville = $query->fetch();}

 function getIdUser(){

global $pdo;
$sql = "SELECT * FROM user WHERE id = :id";
$query = $pdo->prepare($sql);
$query->bindValue('id',$id, PDO::PARAM_INT);
$query->execute();
return $query->fetch();
}

function getIdByUser($id){
    global $pdo;
    $sql = "SELECT * FROM user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}
/*function isprinceadmin(){
    if(isLogged()) {
        if($_SESSION['user']['prenom'] == 'Prince') {
            return true;
        }
    }
    return false;
}*/
