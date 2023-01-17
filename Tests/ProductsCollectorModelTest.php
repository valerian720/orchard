<?php
require_once __DIR__.'\..\Models\GardenModel.php';
require_once __DIR__.'\..\Models\ProductsCollectorModel.php';
// 
require_once __DIR__.'\..\Models\TreeModel.php';
require_once __DIR__.'\..\Models\ProductModel.php';
// 
require_once __DIR__.'\..\Models\Apple\AppleTreeModel.php';
require_once __DIR__.'\..\Models\Apple\AppleModel.php';

require_once __DIR__.'\..\Models\Pear\PearTreeModel.php';
require_once __DIR__.'\..\Models\Pear\PearModel.php';
 
class ProductsCollectorModelTest extends PHPUnit_Framework_TestCase {
  public function testProductsCollectorStartsEmpty() {
    $collector = new ProductsCollectorModel();
    $this->assertEquals(0, count($collector->getBucket()));
  }

  public function testProductsCollectorEmptyBucket() {
    $collector = new ProductsCollectorModel();
    $collector->emptyBucket();
    $this->assertEquals(0, count($collector->getBucket()));
  }

  public function testProductsCollectorCollectsProducts() {
    $config = parse_ini_file("input.ini");
    $config = json_encode($config);
    $config = json_decode($config);

    $garden = new GardenModel();
    $garden->addTrees("AppleTreeModel", $config->count_tree->apple, $config->apple_tree_data, $config->apple_data);
    $garden->addTrees("PearTreeModel", $config->count_tree->pear, $config->pear_tree_data, $config->pear_data);
    $garden->growProduct();

    $collector = new ProductsCollectorModel();
    $collector->fillBucket($garden);
    // 
    $this->assertTrue(count($collector->getBucket()) > 0);
  }

  public function testProductsCollectorFullyCollectsProducts() {
    $config = parse_ini_file("input.ini");
    $config = json_encode($config);
    $config = json_decode($config);

    $garden = new GardenModel();
    $garden->addTrees("AppleTreeModel", $config->count_tree->apple, $config->apple_tree_data, $config->apple_data);
    $garden->addTrees("PearTreeModel", $config->count_tree->pear, $config->pear_tree_data, $config->pear_data);
    $garden->growProduct();

    $collector = new ProductsCollectorModel();
    $collector->fillBucket($garden);
    // 
    $leftover_product_count = 0;
    foreach ($garden->getTrees() as $tree) {
      foreach ($tree->getProducts() as $product) {
        $leftover_product_count++;
      }
  }
    $this->assertTrue($leftover_product_count == 0);
  }
}