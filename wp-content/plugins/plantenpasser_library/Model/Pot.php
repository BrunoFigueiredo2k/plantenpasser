<?php
class Pot
{
    private $product_id;
    private $name;
    private $price;
    private $length;
    private $width;
    private $color;
    private $img_url;
    private $weight;
    private $description;

    public function __construct($product_id, $name, $price, $length, $width, $color, $img_url, $weight, $description)
    {
        $this->product_id = $product_id;
        $this->name = $name;
        $this->price = $price;
        $this->length = $length;
        $this->width = $width;
        $this->color = $color;
        $this->img_url = $img_url;
        $this->weight = $weight;
        $this->description = $description;
    }

    public function get_object() {
        $data = array(
            'product_id' => $this->product_id,  
            'name' => $this->name,    
            'price' => $this->price,    
            'length' => $this->length,    
            'width' => $this->width,    
            'color' => $this->color,    
            'img_url' => $this->img_url,    
            'weight' => $this->weight,   
            'description' => $this->description 
        );

        return $data;
    }
}