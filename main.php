<?php
function custom_autoloader( $class_name ){
  $files = [
   __DIR__.'/Models/'.$class_name.'.php',
   __DIR__.'/Models/Apple/'.$class_name.'.php',
   __DIR__.'/Models/Pear/'.$class_name.'.php',
  ];
  foreach ($files as $file) {
    if ( file_exists($file) ) {
      require_once $file;
    }
  }

}
spl_autoload_register( 'custom_autoloader' );

//input struct
/*
- apple tree count
- pear tree count
- minmax apple count per tree
- minmax pear count per tree
- minmax apple weight
- minmax pear weight
*/

// objects
/*
- garden
- fruit collector
- apple tree
- apple
- pear tree
- pear
*/

// ***************
// load ini as object
$config = parse_ini_file("input.ini");
$config = json_encode($config);
$config = json_decode($config);

// add trees
$garden = new GardenModel();
$garden->addTrees("AppleTreeModel", $config->count_tree->apple, $config->apple_tree_data, $config->apple_data);
$garden->addTrees("PearTreeModel", $config->count_tree->pear, $config->pear_tree_data, $config->pear_data);

// grow fruit on trees
$garden->growProduct();

// collect products
$collector = new ProductsCollectorModel();
$collector->fillBucket($garden);

// count products per type
$collector->reportProductCount();

// weight products per type
$collector->reportProductWeight();

//
$collector->emptyBucket();
?>