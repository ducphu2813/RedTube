<link rel="stylesheet" href="{{ asset('css/analysis.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        Tổng số lượt đăng ký trong năm <label class="year_label"></label>: <label id="total_follow"></label>
    </div>
    <div class="chartTwo">
        <canvas id="Chart2"></canvas>

        Tổng số lượt đăng ký thành viên trong năm <label class="year_label"></label>: <label id="total_membership"></label><br>
        Tổng số tiền thu được từ các gói membership trong năm <label class="year_label"></label>: <label id="total_money"></label>
    </div>

    <script>

        var aValues = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

        {{-- phần script render chart đăng ký --}}
        var ctx = document.getElementById('Chart1').getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: aValues,
                datasets: [{
                    data: [], // Khởi tạo dữ liệu rỗng
                    borderColor: "green",
                    fill: false,
                    label: 'Lượt đăng ký',
                    yAxisID: 'sub',
                }]
            },
            options: {
                legend: {
                    display: true
                },
                scales: {
                    sub: {
                        min: 0,
                        z: 0,
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                        }
                    },
                }
            }
        });

        {{-- phần script render chart thành viên --}}
        var ctx2 = document.getElementById('Chart2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: "bar",
            data: {
                labels: aValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(255, 255, 255, 0)",
                    data: [], // Khởi tạo dữ liệu rỗng
                    label: 'Số thành viên đăng ký',
                    yAxisID: 'member',
                },
                    {
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,255,0,1.0)",
                        borderColor: "rgba(255, 255, 255, 0)",
                        data: [], // Khởi tạo dữ liệu rỗng
                        label: 'Tiền thu được',
                        yAxisID: 'money',
                    }
                ]
            },
            options: {
                scales: {
                    member: {
                        min: 0,
                        z: 0,
                        position: 'left',
                        display: true,
                        fontColor: "rgba(255, 255, 255, 0)",
                        borderColor: "rgba(255, 255, 255, 0)",
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                        }
                    },
                    money: {
                        position: 'right',
                        display: true,
                        fontColor: "rgba(255, 255, 255, 0)",
                        borderColor: "rgba(255, 255, 255, 0)",
                    }
                },
                legend: {
                    display: false
                },
            }
        });

    </script>

    <script>
        $('#year').change(function() {
            var year = $(this).val();

            $.ajax({
                url: '{{ route('studio.getAnalysisByYear') }}',
                type: 'POST',
                data: {
                    year: year,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    // Lấy dữ liệu từ response
                    var followStats = response.data.followStats;
                    var membershipStats = response.data.membershipStats;

                    // Cập nhật dữ liệu cho biểu đồ follow
                    chart.data.datasets[0].data = Object.values(followStats.monthlyFollows);

                    // Cập nhật biểu đồ follow
                    chart.update();

                    // Cập nhật biểu đồ membership
                    chart2.data.datasets[0].data = Object.values(membershipStats.monthlySubscriptions);
                    chart2.data.datasets[1].data = Object.values(membershipStats.monthlyRevenue);

                    // Cập nhật biểu đồ membership
                    chart2.update();

                    //cập nhật cho text
                    $('.year_label').text(year);
                    $('#total_follow').text(followStats.totalFollows);
                    $('#total_membership').text(membershipStats.totalSubscriptions);
                    $('#total_money').text(membershipStats.totalRevenue);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
</div>
