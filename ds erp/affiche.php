<?php
// Inclusion de la connexion avec la base
include "connexion.php";

// Lire les données des étudiantes depuis la base de données
$stmt = $db->prepare("SELECT * FROM `client` ;");
$stmt->execute([]);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
    <title>Liste des client</title>
    <style type="text/css">
        body {
	font-family: Arial, sans-serif;
	font-size: 16px;
	line-height: 1.5;
	margin: 0;
	padding: 0;
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

.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
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
.titre {
    margin-left: 20%;
}
h2 {
    text-align: right;
    margin-right: 10%;
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
<br>
<h2>Welcome admin</h2>
<h1 class='titre'>Liste des client</h1>
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