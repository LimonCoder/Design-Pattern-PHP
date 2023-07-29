<?php

# interface
interface PaymentGateway
{
    public function paymentProcess($amount);
}

class Bkash implements PaymentGateway
{
    public function paymentProcess($amount): string
    {
        //TODO:: internal processing system
        return "$amount Tk pay in Bkash";
    }
}

class Nagad implements PaymentGateway
{
    public function paymentProcess($amount): string
    {
        //TODO:: internal processing system
        return "$amount Tk pay in Nagad";
    }
}

abstract class Product
{
    public $gateway;
    public $name;
    public $price;

    public function __construct(PaymentGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function pay()
    {
        return $this->gateway->paymentProcess($this->price);
    }
}

class Electornics extends Product
{
    public $inch;

    public function __construct(PaymentGateway $gateway, string $inch)
    {
        parent::__construct($gateway);
        $this->inch = $inch;
    }
}

class Toy extends Product{

}

# Example 1 :
$object = new Electornics((new Nagad()), "34'"); # 'Nagad' payment gateway in loosely coupled in Electornics Class
$object->name = "ASUS TV";
$object->price = 56454;
echo $object->pay();

# Example 2 :
$object = new Toy((new Bkash())); # 'Bkash' payment gateway in loosely coupled in Toy Class
$object->name = "Car";
$object->price = 120;
echo $object->pay();
