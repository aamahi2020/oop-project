<?php
function collatzRange($start, $end) {
$results = [];
$maxIterations = 0;
$minIterations = PHP_INT_MAX;
$highestValue = 0;
$maxIterationNumber = $minIterationNumber = $highestValueNumber = $start;

for ($i = $start; $i <= $end; $i++) {
$x = $i;
$steps = 0;
$maxValue = $x;

 while ($x != 1) {
 $x = ($x % 2 == 0) ? $x / 2 : 3 * $x + 1;
 $maxValue = max($maxValue, $x);
 $steps++;
 }

$results[] = ['number' => $i, 'maxValue' => $maxValue, 'iterations' => $steps];

if ($steps > $maxIterations) [$maxIterations, $maxIterationNumber] = [$steps, $i];
if ($steps < $minIterations) [$minIterations, $minIterationNumber] = [$steps, $i];
if ($maxValue > $highestValue) [$highestValue, $highestValueNumber] = [$maxValue, $i];
}
return [
 'results' => $results,
 'maxIterations' => ['number' => $maxIterationNumber, 'steps' => $maxIterations],
 'minIterations' => ['number' => $minIterationNumber, 'steps' => $minIterations],
 'highestValue' => ['number' => $highestValueNumber, 'value' => $highestValue]
 ];
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$start = intval($_POST['start']);
$end = intval($_POST['end']);

 if ($start > 0 && $end > 0 && $start < $end) {
 $collatzData = collatzRange($start, $end);
 } else {
 $error = "Please enter valid numbers (start must be smaller than end).";
 }
}
?>