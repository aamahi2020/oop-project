<?php
require_once 'collatz_histogram.php';
require_once 'collatz.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Histogram</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Collatz Histogram</h1>
    <form method="GET">
        <label for="start">Start:</label>
        <input type="number" name="start" id="start" value="1" required>
        <label for="end">End:</label>
        <input type="number" name="end" id="end" value="50" required>
        <button type="submit">Generate</button>
    </form>
    
    <?php
    if (isset($_GET['start']) && isset($_GET['end'])) {
        $start = (int)$_GET['start'];
        $end = (int)$_GET['end'];
        
        $collatz = new CollatzHistogram(1);
        $histogram = $collatz->generateHistogram($start, $end);
        
        echo "<h2>Histogram Results</h2>";
        echo "<table>
                <tr>
                    <th>Iteration Range</th>
                    <th>Count</th>
                </tr>";
        
        foreach ($histogram as $range => $count) {
            echo "<tr>
                    <td>$range - " . ($range + 4) . "</td>
                    <td>$count</td>
                  </tr>";
        }
        
        echo "</table>";
    }
    ?>
</body>
</html>
