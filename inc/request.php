<?php



function insertArticle($titre,$content,$auteur)
{
    global $pdo;
    $sql = "INSERT INTO blog_articles (title, content, auteur,created_at,status) 
                VALUES (:titre,:contenu,:auteur,NOW(),'publish')";
    $query = $pdo->prepare($sql);
    $query->bindValue('titre', $titre, PDO::PARAM_STR);
    $query->bindValue('contenu', $content ,PDO::PARAM_STR);
    $query->bindValue('auteur', $auteur, PDO::PARAM_STR);
    $query->execute();
    return $pdo->lastInsertId();
}


function getAllPost() {
    global $pdo;
    $sql = "SELECT * FROM blog_articles";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}


function getAllPostByStatus($status = 'publish') {
    global $pdo;
    $sql = "SELECT * FROM blog_articles WHERE status = '$status' ORDER BY created_at DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function getArticleById($id) {
    global $pdo;
    $sql = "SELECT * FROM blog_articles WHERE ID = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue('id',$id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}