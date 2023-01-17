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
        //
        foreach ($prod_count as $prod_name => $count) {
            $tmp_name = strtolower(str_replace("Model","", $prod_name));
            print("count of ${tmp_name} is ${count}\n");
        }
        print("\n");
        return $prod_count;
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
        // 
        foreach ($prod_weight as $prod_name => $count) {
            $tmp_name = strtolower(str_replace("Model","", $prod_name));
            print("weight of ${tmp_name} is ${count}g\n");
        }
        print("\n");
        return $prod_weight;
    }

    public function fillBucket($garden) {
        //
        foreach ($garden->getTrees() as $tree) {
            foreach ($tree->getProducts() as $product) {
                $this->bucket[] = $product;
            }
        }
    }

    public function getBucket() {
        return $this->bucket;
    }

    public function emptyBucket() {
        $ret = $this->bucket;
        $this->bucket = [];

        return $ret;
    }
}
?>