<?php
 $serveur = "localhost";
 $base ="ds_erp";
 $utilisateur="root";
 $motdepasse="";
 try{
       //création d'une instance de PDO
       $db = new PDO("mysql:host=$serveur;dbname=$base",$utilisateur,$motdepasse);
       $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $ex){
       echo "Echec de connexion :".$ex->getMessage();
 }
 $stmt = $db->prepare("SELECT * FROM `client` ;");
$stmt->execute([]);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
?>
<html>
<head>
    <title>Ajouter dans la table</title>
    <style>
        form {
            margin: 50px auto;
            width: 50%;
            text-align: center;
        }
        input[type="text"], input[type="number"] {
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 60%;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .menu {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    background-color: #333;
    color: #fff;
    padding: 40px;
}

.menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu li {
    margin-bottom: 30px;
}

.menu a {
    display: block;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}
.table{
    margin-top: 150px;
    margin-left: 300px;
    width: 60%;
}
th {
  height: 50px;
}
td {
  height: 50px;
}
    </style>
</head>
<body>
<div class="menu">
        <ul>
            <li><a href="dash.php">Dashboard</a></li>
            <li><a href="affiche.php">afficher les clients</a></li>
            <li><a href="ajouter.php">Ajouter un client</a></li>
            <li><a href="modifier.php">Modifier un client</a></li>
            <li><a href="ajoutercpt.php">Ajouter un compte</a></li>
            <li><a href="delete.php">supprimer un compte</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <h1 style="text-align: center" >Ajouter un client</h1>
    <form method="POST" action="ajouter.php">
        <label for="CODCLT">CODCLT :</label>
        <input type="number" id="CODCLT" name="CODCLT" required>
        <br>
        <label for="Nom_CLT">Nom_CLT :</label>
        <input type="text" id="Nom_CLT" name="Nom_CLT" required>
        <br>
        <label for="ADRS_CLT">ADRS_CLT :</label>
        <input type="text" id="ADRS_CLT" name="ADRS_CLT" required>
        <br>
        <input type="submit" value="Ajouter">
    </form>
    <?php
        //check if form has been submitted
        if(isset($_POST["CODCLT"], $_POST["Nom_CLT"], $_POST["ADRS_CLT"])){
			$CODCLT = $_POST["CODCLT"];
			$Nom_CLT = $_POST["Nom_CLT"];
			$ADRS_CLT = $_POST["ADRS_CLT"];
			try{
			//prepare the insert query
			$query = "INSERT INTO client (CODCLT, Nom_CLT, ADRS_CLT) VALUES (:CODCLT, :Nom_CLT, :ADRS_CLT)";
			$statement = $db->prepare($query);
			//bind the values
			$statement->bindParam(":CODCLT", $CODCLT);
			$statement->bindParam(":Nom_CLT", $Nom_CLT);
			$statement->bindParam(":ADRS_CLT", $ADRS_CLT);
			//execute the query
			$statement->execute();
			echo "<p style='text-align:center'>Client ajouté avec succès !</p>";
			}catch(PDOException $ex){
			echo "Erreur : ".$ex->getMessage();
		}
		}
	?>
	<table border="1" class='table'>
    <tr>
        <th>CODCLT</th>
        <th>Nom_CLT</th>
        <th>ADRS_CLT</th>
    </tr>
    <?php foreach($clients as $client){?>
        <tr>
            <td><?php echo $client["CODCLT"]; ?></td>
            <td><?php echo $client["Nom_CLT"]; ?></td>
            <td><?php echo $client["ADRS_CLT"]; ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
