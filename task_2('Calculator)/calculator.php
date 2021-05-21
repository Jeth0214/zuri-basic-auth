<?php
class Calculator
{
    public $operand1;
    public $operand2;

    public function __construct($operand1, $operand2)
    {

        $this->operand1 = $operand1;
        $this->operand2 = $operand2;
    }

    function addition()
    {

        echo $this->operand1 + $this->operand2;
        return $this->operand1 + $this->operand2;
    }

    function substraction()
    {
        echo $this->operand1 - $this->operand2;
        return $this->operand1 - $this->operand2;
    }

    function multiplication()
    {
        echo $this->operand1 * $this->operand2;
        return $this->operand1 * $this->operand2;
    }

    function division()
    {

        echo $this->operand1 / $this->operand2;
        return $this->operand1 / $this->operand2;
    }

    function modulus()
    {

        echo $this->operand1 % $this->operand2;
        return $this->operand1 %  $this->operand2;
    }
};

$result = new Calculator(10, 5);

$result->addition();
echo '<br />';
$result->substraction();
echo '<br />';
$result->multiplication();
echo '<br />';
$result->division();
echo '<br />';
$result->modulus();
