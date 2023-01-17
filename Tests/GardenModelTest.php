<?php
require_once __DIR__.'\..\Models\GardenModel.php';
// 
require_once __DIR__.'\..\Models\TreeModel.php';
require_once __DIR__.'\..\Models\ProductModel.php';
// 
require_once __DIR__.'\..\Models\Apple\AppleTreeModel.php';
require_once __DIR__.'\..\Models\Apple\AppleModel.php';

require_once __DIR__.'\..\Models\Pear\PearTreeModel.php';
require_once __DIR__.'\..\Models\Pear\PearModel.php';
 
class GardenModelTest extends PHPUnit_Framework_TestCase {
  public function testGardenStartsEmpty() {
    $garden = new GardenModel();
    $this->assertEquals(0, count($garden->getTrees()));
  }

  public function testGardenAddCorrectAmountAppleTrees() {
    $config = parse_ini_file("input.ini");
    $config = json_encode($config);
    $config = json_decode($config);

    $garden = new GardenModel();
    $garden->addTrees("AppleTreeModel", $config->count_tree->apple, $config->apple_tree_data, $config->apple_data);
    // 
    $this->assertEquals($config->count_tree->apple, count($garden->getTrees()));
  }

  public function testGardenAddCorrectAmountPearTrees() {
    $config = parse_ini_file("input.ini");
    $config = json_encode($config);
    $config = json_decode($config);

    $garden = new GardenModel();
    $garden->addTrees("PearTreeModel", $config->count_tree->pear, $config->pear_tree_data, $config->pear_data);
    // 
    $this->assertEquals($config->count_tree->pear, count($garden->getTrees()));
  }

  public function testGardenCanGrowProdicts() {
    $config = parse_ini_file("input.ini");
    $config = json_encode($config);
    $config = json_decode($config);

    $garden = new GardenModel();
    $garden->addTrees("AppleTreeModel", $config->count_tree->apple, $config->apple_tree_data, $config->apple_data);
    $garden->growProduct();
    // 
    $this->assertTrue(count( $garden->getTrees()[0]->getProducts() ) > 0);
  }

}