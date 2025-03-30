<?php
function collatz($n) {
    if ($n < 1) {
        echo "Please enter a positive integer.";
        return;
    }
    
    echo "Collatz sequence starting from $n: ";
    
    while ($n != 1) {
        echo $n . " ";
        if ($n % 2 == 0) {
            $n /= 2;
        } else {
            $n = 3 * $n + 1;
        }
    }
    echo "1\n";
}

// Example usage:
$number = 12; // You can change this value
collatz($number);
?>
