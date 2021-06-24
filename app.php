<?php

require './ColaCabinet.php';

function testCountForEachShelf($limit)
{
    $cabinet = new ColaCabinet();
    for ($i = 0; $i < $limit; $i++) {
        try {
            $cabinet->add(0, 1);
            echo 'DRINK IS ADDED.' . PHP_EOL;
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}

function testCountDrink($drink)
{
    $cabinet = new ColaCabinet();
    try {
        $cabinet->add(0, $drink);
        echo 'DRINK IS ADDED.' . PHP_EOL;
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}
//successful case
testCountForEachShelf(15);

//failed case
testCountForEachShelf(25);

//successful case
testCountDrink(1);


//failed case
testCountDrink(5);