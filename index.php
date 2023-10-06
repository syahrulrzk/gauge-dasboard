<?php
function percentageTo100($a, $b) {
    $result = round(($a / 100) * $b);
    return $result;
}

function percentageTo1350($a, $b) {
    $result = round(($a / 1350) * $b);
    return $result;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Gauge</title>
</head>
<body>
   <div class="container">
    <div class="row">
        <!-- Gauge Pertama -->
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <h6 class="mb-3">Oksigen</h6>
                    <canvas id="gauge1" class="img-fluid"></canvas>
                    <h5 id="nilai1">0</h5>
                    <p class="mt-n2 mb-0">
                        <sup>%</sup>
                    </p>
                </div>
            </div>
        </div>

        <!-- Gauge Kedua -->
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <h6 class="mb-3">S02</h6>
                    <canvas id="gauge2" class="img-fluid"></canvas>
                    <h5 id="nilai2">0</h5>
                    <p class="mt-n2 mb-0">
                        <sup>mg/nm3</sup>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
    <script>
        // Kode untuk gauge pertama
        var opts1 = {
            angle: 0,
            lineWidth: 0.25,
            radiusScale: 1,
            pointer: {
                length: 0.5,
                strokeWidth: 0.025,
                color: '#000'
            },
            limitMax: true,
            limitMin: true,
            generateGradient: true,
            highDpiSupport: true,
            staticZones: [
                {strokeStyle: '#0ac074', min: 0, max: 14},
                {strokeStyle: '#fcb92c', min: 14, max: 21},
                {strokeStyle: '#ff3d60', min: 21, max: 25}
            ],
            staticLabels: {
                font: '10px sans-serif',
                labels: [<?php echo percentageTo100(0, 21); ?>, <?php echo percentageTo100(20, 21); ?>, <?php echo percentageTo100(40, 21); ?>, <?php echo percentageTo100(60, 21); ?>, <?php echo percentageTo100(80, 21); ?>, <?php echo percentageTo100(100, 21); ?>, <?php echo percentageTo100(120, 21); ?>],
                color: '#000',
                fractionDigits: 0
            },
            renderTicks: {
                divisions: 10,
                divWidth: 1,
                divLength: 1,
                divColor: '#fff',
                subDivisions: 5,
                subLength: 0.5,
                subWidth: 0.5,
                subColor: '#f3f3f4'
            }
        };
        var target1 = document.getElementById('gauge1');
        var gauge1 = new Gauge(target1).setOptions(opts1);
        gauge1.maxValue = 25;
        gauge1.setMinValue(0);
        gauge1.animationSpeed = 32;
        gauge1.set(0);

        // Kode untuk gauge kedua
        var opts2 = {
            angle: 0,
            lineWidth: 0.25,
            radiusScale: 1,
            pointer: {
                length: 0.5,
                strokeWidth: 0.025,
                color: '#000'
            },
            limitMax: true,
            limitMin: true,
            generateGradient: true,
            highDpiSupport: true,
            staticZones: [
                    {strokeStyle: '#0ac074', min: 0, max: 800},
                    {strokeStyle: '#fcb92c', min: 800, max: 1200},
                    {strokeStyle: '#ff3d60', min: 1200, max: 1350}
                ],
                staticLabels: {
                    font: '10px sans-serif',
                    labels: [<?php echo percentageTo1350(0, 1350); ?>,
                            <?php echo percentageTo1350(350, 1350); ?>,
                            <?php echo percentageTo1350(600, 1350); ?>,
                            <?php echo percentageTo1350(800, 1350); ?>,
                            <?php echo percentageTo1350(1000, 1350); ?>,
                            <?php echo percentageTo1350(1200, 1350); ?>,
                            <?php echo percentageTo1350(1350, 1350); ?>],
                color: '#000',
                fractionDigits: 0
            },
            renderTicks: {
                divisions: 10,
                divWidth: 1,
                divLength: 1,
                divColor: '#fff',
                subDivisions: 5,
                subLength: 0.5,
                subWidth: 0.5,
                subColor: '#f3f3f4'
            }
        };
        var target2 = document.getElementById('gauge2');
        var gauge2 = new Gauge(target2).setOptions(opts2);
        gauge2.maxValue = 1350;
        gauge2.setMinValue(0);
        gauge2.animationSpeed = 32;
        gauge2.set(0);

        // Fungsi untuk memperbarui nilai gauge
        function updateGaugeValue(id, value) {
            if (id === 1) {
                $('#nilai1').html(value);
                gauge1.set(value);
            } else if (id === 2) {
                $('#nilai2').html(value);
                gauge2.set(value);
            }
        }

        // Memperbarui nilai gauge secara berkala
        setInterval(function() {
            $.getJSON('gauge.php?id=1', function(response) {
                updateGaugeValue(1, response.nilai);
            });
            $.getJSON('gauge.php?id=2', function(response) {
                updateGaugeValue(2, response.nilai);
            });
        }, 2000);
    </script>
</body>
</html>
