<?php

session_start();

//Par défault le mode édition n'est pas activé
$update = false;
//Par défaut le contenue des variables
$name = "";
$lastName = "";
$mail = "";
$tel  = "";

$id = 0;

$mysqli = new mysqli('localhost', 'annuaire', 'aledoskour', 'annuaire') or die(mysqli_error($mysqli));
//Insertion dans la BBD
if (isset($_POST['save'])) {
    $name = $_POST['prenom'];
    $lastName = $_POST['nom'];
    $mail = $_POST['email'];
    $tel = $_POST['tel'];

    $mysqli->query("INSERT INTO data (prenom, nom, email, telephone) VALUES('$name', '$lastName','$mail','$tel')") or die($mysqli->error());

    $_SESSION['message'] = "Contact enregistré";
    $_SESSION['msg_type'] = "success";

    //Redirection
    header("location:index.php");
}

//Effacer une ligne dans la BDD
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Contact effacé";
    $_SESSION['msg_type'] = "danger";

    //Redirection
    header("location:index.php");
}

//Editer une ligne dans la BDD
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if ($result->num_rows) {
        $row = $result->fetch_array();
        $name = $row['prenom'];
        $lastName = $row['nom'];
        $mail = $row['email'];
        $tel = $row['telephone'];
    }
}

//Envouer vers la BDD la mise à jour de l'édition
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['prenom'];
    $lastName = $_POST['nom'];
    $mail = $_POST['email'];
    $tel = $_POST['tel'];
    $result = $mysqli->query("UPDATE * data SET prenom='$name', nom='$lastName', email='$mail', tel='$tel' WHERE id=$id");

    $_SESSION['message'] = "Contact mis à jour !";
    $_SESSION['msg_type'] = "warning";

    //Redirection
    header("location:index.php");
}