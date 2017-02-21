<?php
include_once 'unserialize.php';
function delete_produit($product_id){

if ($_POST[delete_product_id] == "Supprimer ID produit")
{
  $tab_prod = unser("../private/product");
  $i = 0;
  while ($tab_prod[$i])
    {
      if ($tab_prod[$i]['id'] == $product_id)
        {
          unset($tab_prod[$i]);
        }
      $i++;
    }
  file_put_contents("../private/product", serialize($tab_prod));
}
if ($_POST["add_product_id"] == "Ajouter produit")
  {
    $tab = unser("../private/product");
  }
}
?>
