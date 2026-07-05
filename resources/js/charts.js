import Chart from 'chart.js/auto';

window.renderDashboardCharts = function (data) {

    createKategoriChart(data.kategori);

    createMonitoringChart(data.monitoring);

    createBulananChart(data.bulanan);

};

/*
|--------------------------------------------------------------------------
| Penggunaan Dana per Kategori
|--------------------------------------------------------------------------
*/

function createKategoriChart(kategori)
{
    const canvas = document.getElementById('kategoriChart');

    if (!canvas) return;

    new Chart(canvas, {

        type: 'bar',

        data: {

            labels: kategori.labels,

            datasets: [{

                label: 'Total Penggunaan',

                data: kategori.values,

                backgroundColor: '#4F46E5',

                borderRadius: 8

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                }

            },

            scales: {

                y: {

                    beginAtZero: true

                }

            }

        }

    });

}

/*
|--------------------------------------------------------------------------
| Status Monitoring
|--------------------------------------------------------------------------
*/

function createMonitoringChart(monitoring)
{
    const canvas = document.getElementById('monitoringChart');

    if (!canvas) return;

    new Chart(canvas, {

        type: 'pie',

        data: {

            labels: [

                'Sudah Monitoring',

                'Belum Monitoring'

            ],

            datasets: [{

                data: monitoring,

                backgroundColor: [

                    '#22C55E',

                    '#F59E0B'

                ]

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false

        }

    });

}

/*
|--------------------------------------------------------------------------
| Penggunaan Dana per Bulan
|--------------------------------------------------------------------------
*/

function createBulananChart(bulanan)
{
    const canvas = document.getElementById('bulananChart');

    if (!canvas) return;

    new Chart(canvas, {

        type: 'line',

        data: {

            labels: bulanan.labels,

            datasets: [{

                label: 'Dana Digunakan',

                data: bulanan.values,

                borderColor: '#2563EB',

                backgroundColor: '#2563EB',

                fill: false,

                tension: 0.4

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                }

            },

            scales: {

                y: {

                    beginAtZero: true

                }

            }

        }

    });

}