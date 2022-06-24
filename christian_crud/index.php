<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Annuaire</title>
</head>

<body>
    <?php require_once 'process.php'; ?>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php echo $_SESSION['message'];
            //unset($_SESSION['msg_type']);
            ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <br>
        <h1>Mon annuaire</h1>
        <br>
        <?php
        $mysqli = new mysqli('localhost', 'annuaire', 'aledoskour', 'annuaire') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        //pre_r($result->fetch_assoc());
        //function pre_r($array)
        //{
        //    echo '<pre>';
        //    print_r($array);
        //    echo '</pre>';
        //} 
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Mail</th>
                        <th>Téléphone</th>
                        <th colspan=2>Action</th>
                    </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row["prenom"]; ?></td>
                        <td><?php echo $row["nom"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["telephone"]; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Editer</a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Effacer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" value="<?php echo $name ?>" placeholder="Renseigner le prénom">
            </div>

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" value="<?php echo $lastName ?>" placeholder="Renseigner le nom">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $mail ?>" placeholder="Renseigner votre email">
            </div>

            <div class="form-group">
                <label>Télephone</label>
                <input type="tel" name="tel" value="<?php echo $tel ?>" placeholder="Renseigner votre télephone">
            </div>
            <div class="form-group">
                <?php if ($update == true): ?>
                <button type="submit" name="update" class="btn btn-info">Mettre à jour</button>
                <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Enregistrer</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

</html>