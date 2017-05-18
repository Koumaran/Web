<?php
function add_produit($tab, $name, $prix)
{
  $existe = -1;
  print_r($tab);
  while ($tab[$i])
  {
    if ($tab[$i][0] == $name)
    {
      $existe++;
      $tab[$i][2]++;
    }
  }
  if ($existe == -1)
  {
    $tab[] = array($name, $prix, 1);
  }
  return ($tab);
}
?>
