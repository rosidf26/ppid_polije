document.addEventListener("DOMContentLoaded", function () {
    const data = window.REKAP_DATA;

    if (!data) {
        console.error("Data rekap tidak ditemukan!");
        return;
    }

    // ====================
    // LINE CHART
    // ====================
    new Chart(document.getElementById("lineChart"), {
        type: "line",
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: "Rerata Waktu (hari)",
                    data: data.chart_rerata,
                    borderWidth: 3,
                    borderColor: "#4287f5",
                    tension: 0.3,
                    fill: false,
                },
            ],
        },
    });

    // ====================
    // BAR CHART
    // ====================
    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: "Diterima",
                    data: data.chart_diterima,
                    backgroundColor: "#28a745",
                },
                {
                    label: "Ditolak",
                    data: data.chart_ditolak,
                    backgroundColor: "#dc3545",
                },
            ],
        },
    });

    // ====================
    // DONUT CHART
    // ====================
    new Chart(document.getElementById("donutChart"), {
        type: "doughnut",
        data: {
            labels: data.labels,
            datasets: [
                {
                    data: data.chart_jumlah,
                    backgroundColor: [
                        "#007bff",
                        "#6610f2",
                        "#6f42c1",
                        "#e83e8c",
                        "#dc3545",
                        "#fd7e14",
                        "#ffc107",
                        "#28a745",
                        "#20c997",
                        "#17a2b8",
                        "#6c757d",
                        "#343a40",
                    ],
                },
            ],
        },
    });
});
