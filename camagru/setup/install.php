<?PHP
/****************** création de la DB *********************/
// on teste avant si elle existe ou non (par sécurité)

$query = 'DROP DATABASE IF EXISTS '.DB_NAME;
try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}

$query = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
 
// on exécute la requête
try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}

$query = 'USE '.DB_NAME;
try	
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}

/************ Création des tables ************/

$query = "CREATE TABLE user 
					( 
						id_user INT NOT NULL AUTO_INCREMENT , 
						name VARCHAR(255) NOT NULL , 
						password VARCHAR(255) NOT NULL,  
						mail VARCHAR(255) NOT NULL ,
						rang INT NOT NULL,
						cle VARCHAR(255) NOT NULL,
						valid INT,
						portrait VARCHAR(255),
						PRIMARY KEY (id_user));";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}

$query = "CREATE TABLE image 
					( 
						id_img INT NOT NULL AUTO_INCREMENT , 
						img TEXT NOT NULL , 
						user_name VARCHAR(255) NOT NULL , 
						likes INT ,
						date_img DATE NOT NULL, 
						PRIMARY KEY (id_img)
						)";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}

$query = "CREATE TABLE comment
					(
						id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
						user_name VARCHAR(255) NOT NULL,
						id_img INT NOT NULL,
						message TEXT NOT NULL);";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}

/*************** ajout de l'adminisrateur *********/
$user = 'root';
$mail = 'jsivanes@student.42.fr';
$pass = hash('whirlpool', 'root');
$query = sprintf("INSERT INTO user (name, password, mail, rang, cle, valid)
				VALUES ('%s', '%s', '%s', '1', 'Boss', '1')", $user, $pass, $mail);
try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	echo ("Erreur ajout de l'admin : ".$e->getMessage());
}

?>