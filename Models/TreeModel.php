<?php
class TreeModel
{
    private $children = [];
    private $child_metadata = null;
    private $child_count = 0;

    public function __construct($child_count_data, $child_data) {
        $child_count = rand($child_count_data->min_count, $child_count_data->max_count);
        $this->child_count = $child_count;
        $this->child_metadata = $child_data;
        print("child_count = ".$this->child_count."\n");
    }
    
    public function populateTree($child_type = "ProductModel") {
        for ($i=0; $i < $this->child_count; $i++) { 
            $this->children[] = new $child_type($this->child_metadata->min_weight, $this->child_metadata->max_weight);
        }
    }
    
    public function getProdicts() {
        $ret = $this->children;
        $this->children = [];

        return $ret;
    }
}
?>