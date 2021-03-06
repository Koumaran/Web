<?php   session_start();
            include_once "login_exist.php";
            include_once "gestion_produit.php";
            if (!$_SESSION['loggued_on_user'] || $_SESSION['loggued_on_user'] == "")
                $_SESSION["guest"] = "OK";
            if ($_GET[user] && $_GET[product])
            {
                $tab = unserialize(file_get_contents("../private/passwd"));
                $i = login_exist($tab, $_GET[user]);
                $tab[$i]['order'][] = add_produit($tab[$i]['oreder'], $_GET[product], $_GET[prix]);
                if ($i != -1)
                    file_put_contents("../private/passwd", serialize($tab));
            }
            if ($_SESSION["guest"] == "OK")
            {
                if (!isset($_SESSION["tmp"]))
                {
                    $tmp = array();
                    $_SESSION["tmp"] = $tmp;
                }
                $i = 1;
                if ($_GET[product])
                    array_push($_SESSION["tmp"], array($_GET[product], $_GET[prix]));
			}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Food World</title>
	<link href='http://fonts.googleapis.com/css?family=Dancing+Script:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div id="header">
		<div id="logo">
			<h1><a href="index.php">Food World</a></h1>
		</div>
		<?php if (!$_SESSION['loggued_on_user']) : ?>
				<div id="form">
					<form id="form1" method="POST" action="check_user.php">
						<div id="log">
                    		<input type="text" name="login" placeholder="Nom d'utilisateur">
                   		 	<input type="password" name="passwd" placeholder="Mot de passe">
                  		  	<input class="button" type="submit" name="register" value="Se connecter">
                		</div>
                		<input id="reg" class="button" type="submit" name="register" value="S'inscrire">
            		</form>
				</div>
		<?php endif ?>
		<?php if ($_SESSION['loggued_on_user']) : ?>
				<div id="logout">
					<form  method="POST" action="logout.php">
            <input class="button" type="submit" name="deconnexion" value="logout">
            <input class="button" type="submit" name="modifier" value="modifier mon compte">
        	</form>
				</div>
		<?php endif ?>
	</div>
	<div id="main">
        <div id="menu">
            <form>
                <ul>
                    <li><a href="./index.php?cat=/fr/">Gourmandise francaise</a></li>
                    <li><a href="./index.php?cat=/asie/">Delices d'Asie</a></li>
                    <li><a href="./index.php?cat=/dessert/">Desserts</a></li>
                </ul>
            </form>
        </div>
        <div id="cart">
            <img src="Ressources/cart.png" title="cart">
            <ul>
                <form>
                    <?php
                        $tab = unserialize(file_get_contents("../private/passwd"));
                        $i = login_exist($tab, $_SESSION['loggued_on_user']);
                        if ($i > 0)
                        {
                          foreach ($tab[$i][order] as $key => $value) {
                              foreach ($value as $produit) {
                                echo("<li>{$produit[0]}: {$produit[1]}$</li>");
                                $total = $total + $product[2];
                              }
                          }
                          echo("<br><li>Total : {$total}$</li><br>");
                        }
                        else if ($i == -1)
                        {
                          $tab = $_SESSION["tmp"];
								          foreach ($tab as $key => $product) {
                                    echo("<li>{$product[0]}: {$product[1]}$</li>");
                                    $total = $total + $product[1];
                          }
                          echo("<br><li>Total : {$total}$</li>");
                        }
                        if ($_SESSION["guest"] != "OK")
                            echo("<input class='button' type='submit' name='valid_order' value='Envoyer commande'>");
                    ?>
                </form>
            </ul>
		</div>
		<?php
            if (!isset($_GET['cat']))
                $cat = "/fr/";
            else
                $cat = $_GET['cat'];
			$tab = unserialize(file_get_contents("../private/product"));
            echo("<div id='catalog'>");
			for ($i = 0; $tab[$i]; $i++)
			{
        if (preg_match($cat, $tab[$i]['cat']))
        {
                $photo = $tab[$i]['img'];
                $name = $tab[$i]['name'];
                $prix = $tab[$i]['prix'];
                if (isset($_SESSION["loggued_on_user"]))
                    $user = $_SESSION["loggued_on_user"];
                else
                    $user = "guest";
				echo("<div class='col5'><img class='food' src=$photo><a href='./index.php?cat={$cat}&user={$user}&product={$name}&prix={$prix}'><input type='image' class='buy' src='Ressources/fork_knife.png' title='buy food' name=$name></a>$name : $prix $</div>");
      }
      }
            echo("</div>");
		?>
    </div>
</div>
</body>
</html>
