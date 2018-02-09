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

/************ Suppression du dossier images **/
if (file_exists('images'))
{
	$files = array_diff(scandir('images'), array('.', '..'));
	foreach ($files as $file) {
		unlink('images/'.$file);
	}
	rmdir('images');
}
/************ Création des tables ************/
//tablue USER
$query = "CREATE TABLE User 
					( 
						id_user INT PRIMARY KEY AUTO_INCREMENT, 
						name VARCHAR(255) NOT NULL, 
						password VARCHAR(255) NOT NULL,  
						mail VARCHAR(255) NOT NULL,
						rang INT NOT NULL,
						notification BOOLEAN NOT NULL DEFAULT TRUE,
						cle VARCHAR(255) NOT NULL,
						valid INT,
						portrait VARCHAR(255))
						ENGINE=InnoDB;";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur table User: '.$e->getMessage());
}
//table IMAGE
$query = "CREATE TABLE Image 
					( 
						id_img INT PRIMARY KEY AUTO_INCREMENT, 
						img TEXT NOT NULL, 
						id_user INT, 
						likes INT,
						date_img TEXT NOT NULL,
						FOREIGN KEY (id_user) 
						REFERENCES User(id_user) 
						ON DELETE CASCADE
						)ENGINE=InnoDB;";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur table Image: '.$e->getMessage());
}
//table COMMENT
$query = "CREATE TABLE Comment
					(
						id_comment INT PRIMARY KEY AUTO_INCREMENT,
						id_user INT,
						id_img INT,
						message TEXT NOT NULL,
						date_comment TEXT NOT NULL,
						FOREIGN KEY (id_user)
						REFERENCES User(id_user)
						ON DELETE CASCADE,
						FOREIGN KEY (id_img)
						REFERENCES Image(id_img)
						ON DELETE CASCADE
						)ENGINE=InnoDB;";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur table Comment: '.$e->getMessage());
}
//table LIKES
$query = "CREATE TABLE Likes
					(
						id_likes INT PRIMARY KEY AUTO_INCREMENT,
						id_user INT,
						id_img INT,
						FOREIGN KEY (id_user)
						REFERENCES User(id_user)
						ON DELETE CASCADE,
						FOREIGN KEY (id_img)
						REFERENCES Image(id_img)
						ON DELETE CASCADE
						)ENGINE=InnoDB;";

try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur table Likes: '.$e->getMessage());
}
/*************** ajout de l'adminisrateur *********/
$user = 'root';
$mail = 'jsivanes@student.42.fr';
$pass = hash('whirlpool', 'root');
$query = sprintf("INSERT INTO User (name, password, mail, rang, cle, valid)
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