<?php
class ProductModel
{
    public $weight = 0;

    public function __construct($min_weight, $max_weight) {
        $this->weight = rand($min_weight, $max_weight);
    }

    public function getWeight() {
        return $this->weight;
    }
}
?>