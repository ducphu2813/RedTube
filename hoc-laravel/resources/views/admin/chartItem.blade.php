<div class="chartModel">
    <canvas id="myChart" style="width:100%;max-width:100%; height: 404px;max-height: 100%;"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    var xValues1 = ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10",
        "Tháng 11","Tháng 12"];
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues1,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478,860, 1140],
                    borderColor: "red",
                    fill: false,
                    label: 'View' // Chú thích cho đường 1
                }, {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000, 1600, 1700],
                    borderColor: "green",
                    fill: false,
                    label: 'Subcriber' // Chú thích cho đường 2
                }, {
                    data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100,2000,2110],
                    borderColor: "blue",
                    fill: false,
                    label: 'Member' // Chú thích cho đường 3
                }]
            },
            options: {
                legend: { display: true }
            }
        });
</script>