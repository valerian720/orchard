<?php
class ProductsCollectorModel
{
    private $bucket = [];

    public function reportProductCount() {
        $prod_count = [];
        foreach ($this->bucket as $product) {
            $tmp_type = get_class($product);
            if(!array_key_exists($tmp_type, $prod_count)){
                $prod_count[$tmp_type] = 0;
            }
            $prod_count[$tmp_type]++;
        }
        print_r($prod_count);
    }

    public function reportProductWeight() {
        $prod_weight = [];
        foreach ($this->bucket as $product) {
            $tmp_type = get_class($product);
            if(!array_key_exists($tmp_type, $prod_weight)){
                $prod_weight[$tmp_type] = 0;
            }
            $prod_weight[$tmp_type] += $product->getWeight();
        }
        print_r($prod_weight);
    }

    public function fillBucket($garden) {
        //
        foreach ($garden->getTrees() as $tree) {
            foreach ($tree->getProdicts() as $product) {
                $this->bucket[] = $product;
            }
        }
    }

    public function emptyBucket() {
        $ret = $this->bucket;
        $this->bucket = [];

        return $ret;
    }
}
?>