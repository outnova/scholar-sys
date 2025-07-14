const recordsChart = document.getElementById('recordsChart').getContext('2d');

let chart;

function fetchChartData(range = 'daily') {
    fetch(`/home/records-data?range=${range}`)
        .then(response => response.json())
        .then(data => {
            if (chart) {
                chart.data.labels = data.labels;
                chart.data.datasets[0].data = data.data;
                chart.update();
            } else {
                chart = new Chart(recordsChart, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Constancias',
                            data: data.data,
                            fill: true,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1000,
                            easing: 'easeOutQuart'
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 5
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });
}

document.addEventListener("DOMContentLoaded", () => {
    fetchChartData(); // carga inicial

    document.getElementById('rangeSelector').addEventListener('change', function () {
        fetchChartData(this.value);
    });
});

const recordsByTypeChart = document.getElementById('recordsByTypeChart').getContext('2d');

fetch('/home/records-by-type')
    .then(res => res.json())
    .then(data => {
        const labels = data.map(item => item.label);
        const counts = data.map(item => item.count);

        const backgroundColors = [
            '#4e73df', '#1cc88a', '#36b9cc',
            '#f6c23e', '#e74a3b', '#858796',
            '#20c9a6', '#fd7e14', '#6f42c1'
        ];

        new Chart(recordsByTypeChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad',
                    data: counts,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
