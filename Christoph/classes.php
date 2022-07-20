<?php

class Vehicles {
    public $name;
    public $model;
    public $makeYear;
    public $color;
    public $fuelType;
    function __construct($name,$model,$year,$color,$fuel) {
        $this->name = $name;
        $this->model = $model;
        $this->makeYear = $year;
        $this->color = $color;
        $this->fuelType = $fuel;
    }
    function printVehicle() {
        
        return $this->name . " " . $this->model . "<br>";
    }
}

class Ships extends Vehicles {
    public $capacity;
    public $purpose;

    function __construct($name,$model,$year,$color,$fuel,$capacity,$purpose) {
        parent::__construct($name,$model,$year,$year,$fuel);
        $this->capacity = $capacity;
        $this->purpose = $purpose;
    }

    function printShip() {
        return "This ship is carrying " . $this->purpose . " and has a capacity of " . $this->capacity . "<br>";
    }
}

$var = new Vehicles('Ford', 'Focus', 2004, 'blue', 'diesel');
echo $var->printVehicle();
$var2 = new Vehicles('Toyota', 'Carina', 1992, 'red', 'gasoline');
$var3 = new Vehicles('Opel', 'Astra', 2009, 'grey', 'diesel');
echo $var2->printVehicle();
echo $var3->printVehicle();
$var4 = new Ships('','',2005,'black','gasoline',2000,'passengers');
$var5 = new Ships('','',1990,'grey','gasoline','10000 containers','cargo');
$var6 = new Ships('','',2000,'white','gasoline',10,'passengers');
echo $var4->printShip();
echo $var5->printShip();
echo $var6->printShip();