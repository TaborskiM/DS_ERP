<?php
$serveur = "localhost";
$base ="ds_erp";
$utilisateur="root";
$motdepasse="";

// Connexion à la base de données
$connexion = new PDO("mysql:host=$serveur;dbname=$base;charset=utf8", $utilisateur, $motdepasse);

// If the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the account details from the form
    $NUMCPTE = $_POST['NUMCPTE'];

    // Check if TOT_Credit is lower than Solde
    $requete = $connexion->prepare("SELECT TOT_Credit, Solde, TOT_Debit FROM compte WHERE NUMCPTE = ?");
    $requete->execute([$NUMCPTE]);
    $result = $requete->fetch(PDO::FETCH_ASSOC);

    if (($result['Solde'] - $result['TOT_Debit'] > 0)) {
        // Display an error message if TOT_Credit is lower than Solde
        echo "<script>alert('Cannot delete the account as the TOT_Credit value is higher than the Solde value you need to withdraw your money.')</script>";
    } else if (($result['Solde'] - $result['TOT_Debit'] < 0)) {
        // Display an error message if TOT_Credit is lower than Solde
        echo "<script>alert('Cannot delete the account as the TOT_Debit value is higher than the Solde value you need to clear your debt.')</script>";
    }else {
        // Delete the account from the database
        $requete = $connexion->prepare("DELETE FROM compte WHERE NUMCPTE = ?");
        $requete->execute([$NUMCPTE]);
    }
}

// Select all the accounts from the database
$sql = "SELECT * FROM compte";
$result = $connexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete an account</title>
    <style>
        body {
            text-align: center;
        }
        body {
        text-align: center;
        font-family: Arial, sans-serif;
        }

        h1 {
        margin-top: 40px;
        }

        form {
        display: inline-block;
        text-align: left;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        }

        label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        }

        input[type="text"] {
        width: 300px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        }

        button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        }

        button[type="submit"]:hover {
        background-color: #3e8e41;
        }

        table {
        border-collapse: collapse;
        margin: 0 auto;
        margin-top: 40px;
        }

        th, td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
        }

        th {
        background-color: #f2f2f2;
        font-weight: bold;
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
    <h1>Delete an account</h1>
    <form method="post">
        <label for="NUMCPTE">NUMCPTE:</label>
        <input type="text" id="NUMCPTE" name="NUMCPTE" required>
        <br>
        <button type="submit">Delete account</button>
    </form>
    <br>
    <h2>Accounts list:</h2>
    <table>
        <tr>
            <th>NUMCPTE</th>
            <th>Libelle_CPTE</th>
            <th>TOT_Debit</th>
            <th>TOT_Credit</th>
            <th>Solde</th>
            <th>CODAG</th>
            <th>CODCLT</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['NUMCPTE'] ?></td>
                <td><?php echo $row['Libelle_CPTE'] ?></td>
                <td><?php echo $row['TOT_Debit'] ?></td>
                <td><?php echo $row['TOT_Credit'] ?></td>
                <td><?php echo $row['Solde'] ?></td>
                <td><?php echo $row['CODAG'] ?></td>
                <td><?php echo $row['CODCLT'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
