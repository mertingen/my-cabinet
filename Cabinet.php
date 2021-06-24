<?php


abstract class Cabinet
{
    const FULL = 'full';
    const PARTIAL = 'partial';
    const EMPTY = 'empty';

    abstract function add(int $shelf, int $drink): array;

    abstract function extract(int $shelf, int $index): int;

    abstract function checkDrinkCount(int $drink): bool;

    abstract function decideStatus(array $shelves): void;

}