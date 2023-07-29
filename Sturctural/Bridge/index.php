<?php
# interface
interface PaymentGateway{
    public function paymentProcess($amount);
}

class Bkash implements PaymentGateway{
    public function paymentProcess($amount): string
    {
        return "$amount Tk pay in Bkash";
    }
}

class Nagad implements PaymentGateway{
    public function paymentProcess($amount): string
    {
        return "$amount Tk pay in Nagad";
    }
}

abstract class Product{
    public $gateway;
    public $name;
    public $price;
    public function __construct(PaymentGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function pay(){
        return $this->gateway->paymentProcess($this->price);
    }
}

class Electornics extends Product{
    public $inch ;

    public function __construct(PaymentGateway $gateway,string $inch)
    {
        parent::__construct($gateway);
        $this->inch = $inch;
    }
}

$object = new Electornics((new Nagad()),"34'");
$object->name = "ASUS TV";
$object->price = 56454;
echo $object->pay();
