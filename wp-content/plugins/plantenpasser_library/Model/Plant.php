<?php
class Plant
{
    private $name;
    private $price;
    private $length;
    private $width;
    private $img_url;

    public function __construct($name, $price, $length, $width, $img_url)
    {
        $this->name = $name;
        $this->price = $price;
        $this->length = $length;
        $this->width = $width;
        $this->img_url = $img_url;
    }

    public function print_object() {
        $data = array(
            'name' => $this->name,    
            'price' => $this->price,    
            'length' => $this->length,    
            'width' => $this->width,    
            'img_url' => $this->img_url,    
        );

        return json_encode($data, JSON_PRETTY_PRINT);
    }
}