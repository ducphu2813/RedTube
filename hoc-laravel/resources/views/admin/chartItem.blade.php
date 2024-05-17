<div class="chartModel">
    Chọn năm thống kê: <select name="year" id="year">
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
        <option value="2024">2024</option>
    </select>
    <canvas id="myChart" style="width:100%;max-width:100%; height: 404px;max-height: 100%;"></canvas>

    <div class="analysis-info">
        Tổng số lượt đăng ký mới trong năm <label class="year_label"></label>: <label id="total_follow"></label>
        <br>
        Tổng số tiền thu được từ các gói Premium trong năm <label class="year_label"></label>: <label id="total_money"></label>
    </div>

    <script>

        var xValues1 = ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10", "Tháng 11","Tháng 12"];
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: xValues1,
                datasets: [{
                    data: [],
                    borderColor: "red",
                    fill: false,
                    label: 'Lượt user mới tham gia' // Chú thích cho đường 1
                }, {
                    data: [],
                    borderColor: "green",
                    fill: false,
                    label: 'Tiền từ các gói Premium' // Chú thích cho đường 2
                }]
            },
            options: {
                legend: { display: true }
            }
        });
    </script>


    <script>
        $('#year').change(function() {
            var year = $(this).val();

            $.ajax({
                url: '{{ route('admin.analysis') }}',
                type: 'POST',
                data: {
                    year: year,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);

                    //lấy dữ liệu từ response
                    var userCount = response.data.newUser;
                    var totalUser = response.data.newUser.totalRegistrations;
                    var money = response.data.revenue;
                    var totalMoney = response.data.revenue.totalRevenue;

                    //load data cho đường Lượt user mới tham gia
                    myChart.data.datasets[0].data = Object.values(userCount.monthlyRegistrations);
                    myChart.data.datasets[1].data = Object.values(money.monthlyRevenue);


                    myChart.update();
                    $('.year_label').text(year);
                    $('#total_follow').text(totalUser);
                    $('#total_money').text(totalMoney);

                },
                error: function(data) {
                    console.log(data);
                }
            })
        });
    </script>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


