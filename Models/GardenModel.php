<?php
class GardenModel
{
    private $trees = [];

    public function addTrees($tree_type, $count, $tree_data, $product_data) {
        for ($i=0; $i < $count; $i++) { 
            $this->trees[] = new $tree_type($tree_data, $product_data);
        }
    }

    public function growProduct(){
        foreach ($this->trees as $tree) {
            $tree->populateTree();
        }
    }

    public function getTrees() { 
        return $this->trees;
    }
}
?>