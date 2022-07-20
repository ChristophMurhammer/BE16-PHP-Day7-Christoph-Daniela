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

$var = new Vehicles('Ford', 'Focus', 2004, 'blue', 'diesel');
echo $var->printVehicle();
$var2 = new Vehicles('Toyota', 'Carina', 1992, 'red', 'gasoline');
$var3 = new Vehicles('Opel', 'Astra', 2009, 'grey', 'diesel');
echo $var2->printVehicle();
echo $var3->printVehicle();