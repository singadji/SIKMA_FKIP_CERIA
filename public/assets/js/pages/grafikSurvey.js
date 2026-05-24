document.addEventListener("DOMContentLoaded", function () {
    const data = window.kepuasanPerProdi || [];
    const categories = data.map((item) => item.nama_prodi);

    const values = data.map((item) => parseFloat(item.rata_rata).toFixed(2));
    const options = {
        series: [
            {
                name: "Rata-rata Kepuasan",
                data: values,
            },
        ],
        chart: {
            type: "bar",
            height: 450,
            toolbar: {
                show: false,
            },
        },

        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 0,
                distributed: true,
                barHeight: "65%",
            },
        },
        colors: [
            function ({ value }) {
                if (value >= 3.5) {
                    return "#1cc88a";
                }
                if (value >= 2.5) {
                    return "#f6c23e";
                }
                if (value >= 1.5) {
                    return "#fd7e14";
                }
                return "#e74a3b";
            },
        ],
        dataLabels: {
            enabled: true,
            textAnchor: "middle",
            style: {
                fontSize: "14px",
                colors: ["#ffffff"],
            },
            dropShadow: {
                enabled: true,
            },

            formatter: function (val) {
                let kategori = "Kurang";
                if (val >= 3.5) {
                    kategori = "Sangat Baik";
                } else if (val >= 2.5) {
                    kategori = "Baik";
                } else if (val >= 1.5) {
                    kategori = "Cukup";
                }

                return parseFloat(val).toFixed(2) + " • " + kategori;
            },
        },

        xaxis: {
            categories: categories.map(function (item) {
                return item.replace(/(.{25})/g, "$1\n");
            }),
            min: 0,
            max: 4,
            title: {
                text: "Indeks Kepuasan",
            },
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: "12px",
                },
            },
        },
        grid: {
            borderColor: "#f1f1f1",
            strokeDashArray: 4,
        },
        tooltip: {
            theme: "light",

            y: {
                formatter: function (val) {
                    return parseFloat(val).toFixed(2);
                },
            },
        },
        legend: {
            show: false,
        },
        noData: {
            text: "Belum ada data survey",
        },
    };
    const chart = new ApexCharts(
        document.querySelector("#chartKepuasanProdi"),

        options,
    );

    chart.render();
});

document.addEventListener("DOMContentLoaded", function () {
    const labels = window.pieLabels || [];
    const series = window.pieSeries || [];
    if (window.instrumenPieChart) {
        window.instrumenPieChart.destroy();
    }

    const chartElement = document.querySelector("#instrumenPie");
    if (!chartElement) {
        console.error("Element #instrumenPie tidak ditemukan");
        return;
    }

    const options = {
        series: series,
        labels: labels,
        chart: {
            type: "donut",
            height: 483,
            toolbar: {
                show: false,
            },
        },
        colors: ["#4e73df", "#1cc88a", "#f6c23e"],
        legend: {
            position: "bottom",
            fontSize: "14px",
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: "13px",
                fontWeight: "bold",
                colors: ["#ffffff"],
            },

            formatter: function (val) {
                return val.toFixed(1) + "%";
            },
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " Jawaban";
                },
            },
        },

        plotOptions: {
            pie: {
                donut: {
                    size: "68%",
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: "Total",

                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce(
                                    (a, b) => a + b,
                                    0,
                                );
                            },
                        },
                    },
                },
            },
        },
        responsive: [
            {
                breakpoint: 768,

                options: {
                    chart: {
                        height: 320,
                    },
                },
            },
        ],

        noData: {
            text: "Belum ada data survey",
        },
    };

    window.instrumenPieChart = new ApexCharts(chartElement, options);
    window.instrumenPieChart.render();
});
