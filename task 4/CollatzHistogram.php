<?php

class Collatz {
    private int $startNumber;

    public function __construct(int $startNumber) {
        $this->startNumber = $startNumber;
    }

    // Method to calculate steps for a single number
    public function calculate(int $number): int {
        $steps = 0;
        while ($number != 1) {
            $number = ($number % 2 === 0) ? $number / 2 : 3 * $number + 1;
            $steps++;
        }
        return $steps;
    }

    public function calculateRange(int $start, int $end): array {
        $results = [];
        for ($i = $start; $i <= $end; $i++) {
            $results[$i] = $this->calculate($i);
        }
        return $results;
    }

    // Method to get statistics from the given range
    public function statistics(int $start, int $end): array {
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
                $currentValue = ($currentValue % 2 === 0) ? $currentValue / 2 : 3 * $currentValue + 1;
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

// Child class that extends Collatz
class CollatzHistogram extends Collatz {
    // Constants
    private const DEFAULT_RANGE_START = 1;
    private const DEFAULT_RANGE_END = 100;
    private const BIN_WIDTH = 10;

    // Method to generate a histogram of iteration counts
    public function generateHistogram(int $start = self::DEFAULT_RANGE_START, int $end = self::DEFAULT_RANGE_END): array {
        $results = $this->calculateRange($start, $end);
        $histogram = [];

        foreach ($results as $value => $steps) {
            $bin = intval($steps / self::BIN_WIDTH) * self::BIN_WIDTH;
            $label = $bin . '-' . ($bin + self::BIN_WIDTH - 1);

            if (!isset($histogram[$label])) {
                $histogram[$label] = 0;
            }

            $histogram[$label]++;
        }

        ksort($histogram);
        return $histogram;
    }
}

?>
