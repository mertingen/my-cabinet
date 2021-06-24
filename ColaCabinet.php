<?php

require './Cabinet.php';

class ColaCabinet extends Cabinet
{
    public $shelves = [
        [], [], []
    ];

    private $isOpen = false;
    private $status = Cabinet::EMPTY;

    /**
     * @param int $shelf
     * @param int $drink
     * @return array
     * @throws Exception
     */
    public function add(int $shelf, int $drink): array
    {
        if (!isset($this->shelves[$shelf])){
            throw new Exception("The shelf is not found!");
        }

        if ($this->status === Cabinet::FULL) {
            throw new Exception("No vacancy in the cabinet!");
        }

        if ($this->isOpen === false) {
            $this->isOpen = true;
        }

        if (!$this->checkDrinkCount($drink)) {
            throw new Exception("It adds only 1 drink");
        }
        if (count($this->shelves[$shelf]) > 20) {
            throw new Exception("No vacancy in this shelf!");
        }
        $this->shelves[$shelf][] = $drink;

        if ($this->isOpen === true) {
            $this->isOpen = false;
        }

        $this->decideStatus($this->shelves);
        return $this->shelves;
    }

    /**
     * @param int $shelf
     * @param int $index
     * @return int
     * @throws Exception
     */
    public function extract(int $shelf, int $index): int
    {
        if (!isset($this->shelves[$shelf])){
            throw new Exception("The shelf is not found!");
        }

        if ($this->isOpen === false) {
            $this->isOpen = true;
        }

        $drink = $this->shelves[$shelf][$index];
        if (empty($drink)) {
            throw new Exception("Not found drink!");
        }
        if (!$this->checkDrinkCount($drink)) {
            throw new Exception("It gives only 1 drink");
        }

        unset($this->shelves[$shelf][$index]);

        if ($this->isOpen === true) {
            $this->isOpen = false;
        }

        $this->decideStatus($this->shelves);
        return $drink;
    }

    /**
     * @param int $drink
     * @return bool
     */
    public function checkDrinkCount(int $drink): bool
    {
        return $drink === 1;
    }

    /**
     * @param array $shelves
     */
    public function decideStatus(array $shelves): void
    {
        foreach ($this->shelves as $shelf) {
            if (count($shelf) == 0) {
                continue;
            }

            if (count($shelf) > 0 && count($shelf) < 20) {
                $this->status = Cabinet::PARTIAL;
                break;
            } else {
                $this->status = Cabinet::FULL;
            }
        }
    }
}