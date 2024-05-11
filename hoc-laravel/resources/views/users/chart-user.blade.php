<link rel="stylesheet" href="{{ asset('css/Analysis.css') }}">
<h1 class="titleThongKe" style="justify-self:center;">Thống Kê</h1>
<div>
    <label for="year">Chọn năm thống kê:</label>
    <br>
    <select name="year" id="year">
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
    </select>
</div>

<!-- /Chart -->
<div class="Chart">
    <div class="chartOne">
        <canvas id="Chart1"></canvas>
        <script>
            const xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

            new Chart("Chart1", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                        borderColor: "red",
                        fill: false,
                        label: 'View'
                    }, {
                        data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                        borderColor: "green",
                        fill: false,
                        label: 'Subcriber'
                    }]
                },
                options: {
                    legend: {
                        display: true
                    }
                }
            });
        </script>
    </div>
    <div class="chartTwo">
        <canvas id="Chart2"></canvas>

        <script>
            const aValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
            const yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

            new Chart("Chart2", {
                type: "line",
                data: {
                    labels: aValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 6,
                                max: 16
                            }
                        }],
                    }
                }
            });
        </script>
    </div>
</div>