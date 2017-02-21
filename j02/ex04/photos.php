#!/usr/bin/php 
<?PHP
if ($argc > 1)
{
	$c = curl_init($argv[1]);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$tab = explode(">", curl_exec($c));
	$link = array();
	foreach ($tab as $str)
	{
		if (preg_match("/<img/", $str))
		{
			$tab2 = explode("\"", $str);
			$i = 0;
			$len = count($tab2);
			while ($i < $len)
				if (preg_match("/src=/", $tab2[$i++]))
					$link[] = $tab2[$i];
		}
	}
	$tab = explode("/", $argv[1]);
		$file = "./".$tab[2];
	if (!is_dir($file))
		mkdir($file);
	$check = array();
	foreach ($link as $url)
	{
		if (preg_match("/\//", $url))
		{
			$tab = explode("/", $url);
			$img = $tab[count($tab) - 1];
			$len = strlen($img);
			if ($img[$len - 1] == '\\' )
				$img = substr($img, 0, strlen($img) - 1);
			if (!in_array($img, $check))
			{
				$check[] = $img;
				if (strlen($img))
					if (file_put_contents($img, $file))
						shell_exec("mv $img $file");
			}
		}
	}
}
?>
