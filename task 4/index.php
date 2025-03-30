<?php

require_once 'CollatzHistogram.php'; // include the file with both classes

// Create an instance of the child class
$collatz = new CollatzHistogram(1); // startNumber isn't heavily used but required by constructor

// Define range
$start = 1;
$end = 100;

// Get statistics
$stats = $collatz->statistics($start, $end);
$histogram = $collatz->generateHistogram($start, $end);

// Display statistics
echo "<h2>Collatz Statistics (from $start to $end)</h2>";
echo "<ul>";
echo "<li>Number with max iterations: {$stats['max_iterations_number']} ({$stats['max_iterations']} steps)</li>";
echo "<li>Number with min iterations: {$stats['min_iterations_number']} ({$stats['min_iterations']} steps)</li>";
echo "<li>Max value reached during any sequence: {$stats['max_reached_value']}</li>";
echo "</ul>";

// Display histogram
echo "<h2>Histogram of Iteration Counts</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Iteration Range</th><th>Count</th></tr>";
foreach ($histogram as $range => $count) {
    echo "<tr><td>{$range}</td><td>{$count}</td></tr>";
}
echo "</table>";

?>
