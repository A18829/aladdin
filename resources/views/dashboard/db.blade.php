@extends('master')

@section('title')
Dashboard
@endsection

@section('content')
    <div class="row">  
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Nhà hàng</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                      <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Trạng thái hoạt động</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="multipleBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Ruijie</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                     <canvas
                        id="doughnutChart"
                        style="width: 50%; height: 50%"
                      ></canvas>
                    </div>
                </div>
            </div>
        </div>     
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Camera</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                      <canvas id="matcamChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Đầu ghi</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                      <canvas id="daucamChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Đường truyền internet: {{ $duongtruyen->total_mang }}</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas
                            id="mang">    
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Nhà thầu điện nhẹ</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas
                            id="thau">    
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">% Nhà hàng theo thương hiệu</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas
                            id="pieChart" style="width: 50%; height: 50%">    
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
         
    </div>

    
    <script src="{{ asset('gd1/assets/js/plugin/chart.js/chart.min.js') }}"></script>
    
    <script>
        var 
            barChart = document.getElementById("barChart").getContext("2d"),
            matcam = document.getElementById("barChart").getContext("2d"),
            daucam = document.getElementById("barChart").getContext("2d"),
            thau = document.getElementById("barChart").getContext("2d"),
            doughnutChart = document
              .getElementById("doughnutChart")
              .getContext("2d"),
            multipleBarChart = document
                .getElementById("multipleBarChart")
                .getContext("2d"),
            pieChart = document.getElementById("pieChart").getContext("2d");
      

      // Chuyển đổi giá trị vung và số lượng thành mảng để sử dụng trong biểu đồ
        var labels = [];
        var data = [];
        var stt11 =[];
        var stt00 =[];
        var stt22 =[];
        var ruijie = [];
        var daucam = [];
        var matcam = [];
        var rj = [];
        var drj = [];
        

        @foreach($data as $item)
            labels.push("{{ $item->vung }}");
            data.push({{ $item->count }});
            stt11.push({{ $item->stt1 }});
            stt00.push({{ $item->stt0 }});
            stt22.push({{ $item->stt2 }});
            ruijie.push({{ $item->ruijie }});
            daucam.push({{ $item->daucam }});
            matcam.push({{ $item->matcam }});
        @endforeach

       

        var myBarChart = new Chart(barChart, {
            type: "bar",
            data: {
                labels: labels, // Sử dụng mảng labels đã tạo
                datasets: [
                    {
                        label:[ " Tổng số nhà hàng: {{ $tong->total_nhahang }}", " Nhà hàng theo thương hiệu"],
                        backgroundColor: "rgb(23, 125, 255)",
                        borderColor: "rgb(23, 125, 255)",
                        data: data, // Sử dụng mảng data đã tạo
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });

        var nthau = [];
        var dthau = [];
        @foreach($nhathau as $nhathaus)
            nthau.push("{{ $nhathaus->nhathau }}");
            dthau.push({{ $nhathaus->count }});
        @endforeach

        var mynhathau = new Chart(document.getElementById('thau').getContext('2d'), {
            type: "bar",
            data: {
                labels: nthau, // Sử dụng mảng labels đã tạo
                datasets: [
                    {
                        label: "Nhà thầu thi công điện nhẹ",
                        backgroundColor: "rgb(0, 128, 0)", // Màu xanh lá đậm
                        borderColor: "rgb(0, 128, 0)", // Màu xanh lá đậm
                        data: dthau, // Sử dụng mảng data đã tạo
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });

        var nmang = [];
        var dmang = [];
        var mau = ["#f3545d", "#1d7af3"];

        @foreach($nhamang as $nhamangs)
            nmang.push("{{ $nhamangs->nhamang }}");
            dmang.push({{ $nhamangs->count }});
        @endforeach

        var mynhamang = new Chart(document.getElementById('mang').getContext('2d'), {
            type: "bar",
            data: {
                datasets: [
                    {   
                        label: "VIETTEL ",
                        backgroundColor: mau[0], // Màu cho VIETTEL
                        data: [dmang[0]], // Dữ liệu cho VIETTEL
                    },
                    {
                        label: "VNPT",
                        backgroundColor: mau[1], // Màu cho VNPT
                        data: [dmang[1]], // Dữ liệu cho VNPT
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });

        var myMatcamChart = new Chart(matcamChart, {
            type: "bar",
            data: {
                labels: labels,  // Mảng nhãn cho matcam
                datasets: [
                    {
                        label:  [" Tổng số camera: {{ $tong->total_matcam }}", " Số lượng camera theo thương hiệu" ],
                        backgroundColor: "rgb(255, 165, 0)", // Màu cam
                        borderColor: "rgb(255, 165, 0)", // Màu cam
                        data: matcam, // Dữ liệu cho matcam
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });
        var myDaucamChart = new Chart(daucamChart, {
            type: "bar",
            data: {
                labels: labels, // Mảng nhãn cho matcam
                datasets: [
                    {
                        label:  [ " Tổng số đầu ghi: {{ $tong->total_daucam }}", " Số lượng đầu ghi theo thương hiệu",],
                        backgroundColor: "#f3545d", // Màu sắc khác để phân biệt
                        borderColor: "rgb(255, 99, 132)",
                        data: daucam, // Dữ liệu cho matcam
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });

       
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [
                    {
                        data: data,
                        backgroundColor: data.map(() => getRandomColor()), // Tạo mảng màu ngẫu nhiên
                        borderWidth: 0,
                    },
                ],
                labels: labels,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                pieceLabel: {
                    render: "percentage",
                    fontColor: "white",
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });



        @foreach($rj as $rjs)
            rj.push("{{ $rjs->ruijie }}");
            drj.push({{ $rjs->count }});
        @endforeach

        var myDoughnutChart = new Chart(doughnutChart, {
                                    type: "doughnut",
                                    data: {
                                      datasets: [
                                        {
                                          data: drj,
                                          backgroundColor: [ "#fdaf4b", "#1d7af3"],
                                        },
                                      ],

                                      labels: ["Nhà hàng không", "Nhà hàng có"],
                                    },
                                    options: {
                                      responsive: true,
                                      maintainAspectRatio: false,
                                      legend: {
                                        position: "bottom",
                                      },
                                      layout: {
                                        padding: {
                                          left: 20,
                                          right: 20,
                                          top: 20,
                                          bottom: 20,
                                        },
                                      },
                                    },
                                  });

        var myMultipleBarChart = new Chart(multipleBarChart, {
                                        type: "bar",
                                        data: {
                                          labels: labels,
                                          datasets: [
                                            {
                                              label: "Đang hoạt động",
                                              backgroundColor: "#59d05d",
                                              borderColor: "#59d05d",
                                              data: stt11,
                                            },
                                            {
                                              label: "Sắp hoạt động",
                                              backgroundColor: "#fdaf4b",
                                              borderColor: "#fdaf4b",
                                              data: stt22,
                                            },
                                            {
                                              label: "Chưa hoạt động",
                                              backgroundColor: "#f3545d",
                                              borderColor: "#f3545d",
                                              data: stt00,
                                            },
                                            
                                          ],
                                        },
                                        options: {
                                          responsive: true,
                                          maintainAspectRatio: false,
                                          legend: {
                                            position: "bottom",
                                          },
                                          title: {
                                            display: true,
                                            text: " Tổng số nhà hàng: {{ $tong->total_nhahang }} | Hoạt động: {{ $data->sum('stt1') }} | Sắp hoạt động: {{ $data->sum('stt2') }} | Chưa hoạt động: {{ $data->sum('stt0') }}",
                                          },
                                          tooltips: {
                                            mode: "index",
                                            intersect: false,
                                          },
                                          responsive: true,
                                          scales: {
                                            xAxes: [
                                              {
                                                stacked: true,
                                              },
                                            ],
                                            yAxes: [
                                              {
                                                stacked: true,
                                              },
                                            ],
                                          },
                                        },
                                      });


     
    </script>
@endsection