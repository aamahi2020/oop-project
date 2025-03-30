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


//html form
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Collatz Conjecture</title>
</head>
<body>
<h2>Collatz Conjecture (3x + 1)</h2>
<form method="post">
<label for="start">Enter Start Number:</label>
<input type="number" name="start" required>
<br><br>      
<label for="end">Enter End Number:</label>
<input type="number" name="end" required>
<br><br>     
<button type="submit">Calculate</button>
</form>
<?php if (isset($error)): ?>
<p style="color: red;"><b><?php echo $error; ?></b></p>
<?php endif; ?>
<?php if (isset($collatzData)): ?>
<h3>Results for numbers from <?php echo $start; ?> to <?php echo $end; ?>:</h3>
<ul>
<li><b>highest stop time no:</b> <?php echo $collatzData['maxIterations']['number']; ?> (<?php echo $collatzData['maxIterations']['steps']; ?> steps)</li>
<li><b>lowest stop time no:</b> <?php echo $collatzData['minIterations']['number']; ?> (<?php echo $collatzData['minIterations']['steps']; ?> steps)</li>
<li><b>highest value number:</b> <?php echo $collatzData['highestValue']['number']; ?> (Max value: <?php echo $collatzData['highestValue']['value']; ?>)</li>
</ul>
<h3>Full Data:</h3>
<table border="1">
<tr>
<th>Number</th>
<th>Max Value</th>
<th>Iterations</th>
</tr>
<?php foreach ($collatzData['results'] as $data): ?>
<tr>
<td><?php echo $data['number']; ?></td>
<td><?php echo $data['maxValue']; ?></td>
<td><?php echo $data['iterations']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</body>
</html>
