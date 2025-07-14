<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Electricity Charge Calculator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Electricity Charge Calculator</h3>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="form-group">
                    <label>Voltage (V)</label>
                    <input type="number" step="any" class="form-control" name="voltage" required>
                </div>
                <div class="form-group">
                    <label>Current (A)</label>
                    <input type="number" step="any" class="form-control" name="current" required>
                </div>
                <div class="form-group">
                    <label>Current Rate (sen/kWh)</label>
                    <input type="number" step="any" class="form-control" name="rate" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Calculate</button>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $voltage = $_POST['voltage'];
        $current = $_POST['current'];
        $rateSen = $_POST['rate'];

        $powerWh = $voltage * $current;
        $powerKw = $powerWh / 1000;
        $rateRM = $rateSen / 100;

        echo "<div class='card mt-4 shadow-sm'>";
        echo "<div class='card-body'>";
        echo "<h5><strong>Power:</strong> " . number_format($powerKw, 5) . " kW</h5>";
        echo "<h5><strong>Rate:</strong> RM " . number_format($rateRM, 3) . " per kWh</h5>";
        echo "</div></div>";

        echo "<div class='card mt-3 shadow-sm'>";
        echo "<div class='card-body'>";
        echo "<h5 class='mb-3'><strong>Detailed Energy Consumption (1 - 24 Hours)</strong></h5>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead class='thead-dark'><tr><th>#</th><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr></thead><tbody>";

        for ($i = 1; $i <= 24; $i++) {
            $energy = $powerKw * $i;
            $cost = $energy * $rateRM;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$i</td>";
            echo "<td>" . number_format($energy, 5) . "</td>";
            echo "<td>RM " . number_format($cost, 2) . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table></div></div></div>";
    }
    ?>
</div>

</body>
</html>
