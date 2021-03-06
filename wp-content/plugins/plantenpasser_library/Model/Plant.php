<?php
class Plant {
    private $product_id;
    private $name;
    private $price;
    private $length;
    private $width;
    private $img_url;
    private $description;

    public function __construct($product_id, $name, $price, $length, $width, $img_url, $description) {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->price = $price;
        $this->length = $length;
        $this->width = $width;
        $this->img_url = $img_url;
        $this->description = $description;
    }

    public function get_object() {
        $data = array(
            'product_id' => $this->product_id,    
            'name' => $this->name,    
            'price' => $this->price,    
            'length' => $this->length,    
            'width' => $this->width,    
            'img_url' => $this->img_url,    
            'description' => $this->description,    
        );

        return $data;
    }
}