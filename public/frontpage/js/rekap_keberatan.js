const { labels, chart_rerata, persentase_keberatan } = window.REKAP_DATA;
const alasanCtx = document.getElementById("alasanChart");

new Chart(document.getElementById("lineChart"), {
    type: "line",
    data: {
        labels,
        datasets: [
            {
                label: "Rerata Waktu Menjawab (Hari)",
                data: chart_rerata,
                tension: 0.3,
            },
        ],
    },
});

new Chart(document.getElementById("donutChart"), {
    type: "doughnut",
    data: {
        labels: ["Keberatan", "Tidak Keberatan"],
        datasets: [
            {
                data: [persentase_keberatan, 100 - persentase_keberatan],
            },
        ],
    },
});
