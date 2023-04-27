<?php
$serveur = "localhost";
$base ="ds_erp";
$utilisateur="root";
$motdepasse="";

// Connexion à la base de données
$connexion = new PDO("mysql:host=$serveur;dbname=$base;charset=utf8", $utilisateur, $motdepasse);
$sql = "SELECT CODCLT FROM client";
$result = $connexion->query($sql);

$sql = "SELECT CODAG FROM agence";
$result1 = $connexion->query($sql);
$sql = "SELECT NUMCPTE FROM compte ORDER BY NUMCPTE DESC LIMIT 1";
$result = $connexion->query($sql);
$lastNumCpte = $result->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
		function incrementValue() {
			var inputEl = document.getElementById("myInput");
			var currentValue = inputEl.value;
			var newValue = parseInt(currentValue.substring(currentValue.length - 2)) + 1;
			newValue = newValue < 10 ? '0' + newValue : newValue;
			var newValueStr = currentValue.substring(0, currentValue.length - 2) + newValue;
			inputEl.value = newValueStr;
		}
	</script>
    <meta charset="UTF-8">
    <title>Ajouter un compte</title>
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

select{
    width: 40%;
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
    <h1 style="text-align: center" >Ajouter un compte</h1>
    <form method="post">
        <label for="NUMCPTE">NUMCPTE :</label>
        <input type="text" id="NUMCPTE" name="NUMCPTE" value="<?php echo $lastNumCpte ;?>" required>
        <br>
        <label for="Libelle_CPTE">Libellé :</label>
        <input type="text" id="Libelle_CPTE" name="Libelle_CPTE" required>
        <br>
        <label for="TOT_Debit">Total débit :</label>
        <input type="number" id="TOT_Debit" name="TOT_Debit" required>
        <br>
        <label for="TOT_Credit">Total crédit :</label>
        <input type="number" id="TOT_Credit" name="TOT_Credit" required>
        <br>
        <label for="Solde">Solde :</label>
        <input type="number" id="Solde" name="Solde" required>
        <br>
        <label for="CODAG">Code agence :</label>
        <?php
        // Generate HTML code for select element
        echo '<select id="CODAG" name="CODAG">';
        while($row = $result1->fetch()) {
        echo '<option>' . $row["CODAG"] . '</option>';
        }
        echo '</select>';
        ?>
        <br>
        <label for="CODCLT">Code client :</label>
        <?php
        // Generate HTML code for select element
        echo '<select id="CODCLT" name="CODCLT">';
        while($row = $result->fetch()) {
        echo '<option>' . $row["CODCLT"] . '</option>';
    }
    echo '</select>';
    ?>
    <br>
    <input type="submit" value="Ajouter">
    </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Récupération des données du formulaire
                $NUMCPTE = "TN 59 10 006 " . str_pad(substr($lastNumCpte, -12) + 1, 12, "0", STR_PAD_LEFT) . " 32";
                $Libelle_CPTE = $_POST['Libelle_CPTE'];
                $TOT_Debit = $_POST['TOT_Debit'];
                $TOT_Credit = $_POST['TOT_Credit'];
                $Solde = $_POST['Solde'];
                $CODAG = $_POST['CODAG'];
                $CODCLT = $_POST['CODCLT'];
                // Insertion des données dans la base de données
                $requete = $connexion->prepare("INSERT INTO compte (NUMCPTE, Libelle_CPTE, TOT_Debit, TOT_Credit, Solde, CODAG, CODCLT) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $requete->execute([$NUMCPTE, $Libelle_CPTE, $TOT_Debit, $TOT_Credit, $Solde, $CODAG, $CODCLT]);
                $lastNumCpte = $NUMCPTE;
            }
        ?>
    </body>
    </html>