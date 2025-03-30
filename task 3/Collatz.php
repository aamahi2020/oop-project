<?php

class Collatz {
    private $startNumber;

    public function __construct($startNumber) {
        $this->startNumber = $startNumber;
    }

    // Method to calculate steps for a single number
    public function calculate($number) {
        $steps = 0;
        while ($number != 1) {
            if ($number % 2 == 0) {
                $number = $number / 2; 
            } else {
                $number = 3 * $number + 1; 
            }
            $steps++;
        }
        return $steps;
    }

    public function calculateRange($start, $end) {
        $results = [];
        for ($i = $start; $i <= $end; $i++) {
            $results[$i] = $this->calculate($i);
        }
        return $results;
    }

    // Method to get statistics from the given range
    public function statistics($start, $end) {
        $results = $this->calculateRange($start, $end);

        $maxIterations = max($results); 
        $minIterations = min($results);
        $maxIterationsNumber = array_search($maxIterations, $results);
        $minIterationsNumber = array_search($minIterations, $results);

        $maxReachedValue = 0;
        foreach ($results as $num => $steps) {
            $currentValue = $num;
            while ($currentValue != 1) {
                if ($currentValue > $maxReachedValue) {
                    $maxReachedValue = $currentValue;
                }
                if ($currentValue % 2 == 0) {
                    $currentValue = $currentValue / 2;
                } else {
                    $currentValue = 3 * $currentValue + 1;
                }
            }
        }

        return [
            'max_iterations_number' => $maxIterationsNumber,
            'max_iterations' => $maxIterations,
            'min_iterations_number' => $minIterationsNumber,
            'min_iterations' => $minIterations,
            'max_reached_value' => $maxReachedValue
        ];
    }
}

?>
