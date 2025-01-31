<!-- Vendor JS Files -->
    <script src="chat_Assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="chat_Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="chat_Assets/vendor/chart.js/chart.umd.js"></script>
    <script src="chat_Assets/vendor/echarts/echarts.min.js"></script>
    <script src="chat_Assets/vendor/quill/quill.min.js"></script>
    <script src="chat_Assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="chat_Assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="chat_Assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <!-- DataTables Responsive extension -->
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

    <!-- DataTables Buttons extension -->
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>

    <!-- Template Main JS File -->
    <script src="chat_Assets/js/main.js"></script>

    <!-- Template chat user JS File -->
    <!-- <script src="/javascript/chatUsers.js"></script>
    <script src="/javascript/chatBox.js"></script> -->
        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#reportsChart"), {
                            series: [{
                            name: 'Sales',
                            data: [31, 40, 28, 51, 42, 82, 56],
                            }, {
                            name: 'Revenue',
                            data: [11, 32, 45, 32, 34, 52, 41]
                            }, {
                            name: 'Customers',
                            data: [15, 11, 32, 18, 9, 24, 11]
                            }],
                            chart: {
                            height: 350,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            },
                            markers: {
                            size: 4
                            },
                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                            fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                            }
                            },
                            dataLabels: {
                            enabled: false
                            },
                            stroke: {
                            curve: 'smooth',
                            width: 2
                            },
                            xaxis: {
                            type: 'datetime',
                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                            },
                            tooltip: {
                            x: {
                                format: 'dd/MM/yy HH:mm'
                            },
                            }
                        }).render();
                        });
                    </script>
                    <!-- End Line Chart -->
                        <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                        legend: {
                        data: ['Allocated Budget', 'Actual Spending']
                        },
                        radar: {
                        // shape: 'circle',
                        indicator: [{
                            name: 'Sales',
                            max: 6500
                            },
                            {
                            name: 'Administration',
                            max: 16000
                            },
                            {
                            name: 'Information Technology',
                            max: 30000
                            },
                            {
                            name: 'Customer Support',
                            max: 38000
                            },
                            {
                            name: 'Development',
                            max: 52000
                            },
                            {
                            name: 'Marketing',
                            max: 25000
                            }
                        ]
                        },
                        series: [{
                        name: 'Budget vs spending',
                        type: 'radar',
                        data: [{
                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                            name: 'Allocated Budget'
                            },
                            {
                            value: [5000, 14000, 28000, 26000, 42000, 21000],
                            name: 'Actual Spending'
                            }
                        ]
                        }]
                    });
                    });
                </script>

    <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                        trigger: 'item'
                        },
                        legend: {
                        top: '5%',
                        left: 'center'
                        },
                        series: [{
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        data: [{
                            value: 1048,
                            name: 'Search Engine'
                            },
                            {
                            value: 735,
                            name: 'Direct'
                            },
                            {
                            value: 580,
                            name: 'Email'
                            },
                            {
                            value: 484,
                            name: 'Union Ads'
                            },
                            {
                            value: 300,
                            name: 'Video Ads'
                            }
                        ]
                        }]
                    });
                    });
                </script>
