import {errorAlert} from "../helper/exceptions.js";

document.addEventListener("DOMContentLoaded", function () {
    getTotalRegistrations();
    getFavoritePrograms();
    getMostPrograms();
});

function getTotalRegistrations() {
    axios.get('api/v1/public/registrations/per-year')
        .then(response => {
            let data = response.data.data;
            let labels = [];
            let dataPoints = [];
            data.forEach(element => {
                labels.push(element.year);
                dataPoints.push(element.total);
            })

            const chartBar = document.getElementById('ChartBar');
            new Chart(chartBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Pendaftar ',
                        data: dataPoints,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total Pendaftar 5 Tahun Terakhir '
                        }
                    }
                }
            });
        })
        .catch(error => {
            errorAlert(error.response.data.message);
        });
}

function getFavoritePrograms(){
    axios.get('api/v1/public/programs/favorite')
        .then(response => {
            let data = response.data.data;
            let labels = [];
            let dataPoints = [];
            data.forEach(program => {
                labels.push(program.program_name);
                dataPoints.push(program.total_registrations);
            })

            const chartPolar = document.getElementById('ChartPolar');
            const currentYear = new Date().getFullYear();
            const dataChartPolar = {
                labels: labels,
                datasets: [{
                    label: 'Total Pendaftar ',
                    data: dataPoints,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)',
                        'rgb(54, 162, 235)'
                    ]
                }]
            }

            const configChartPolar = {
                type: 'polarArea',
                data: dataChartPolar,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: '5 Program Favorit Tahun ' + currentYear
                        }
                    }
                }
            };

            new Chart(chartPolar, configChartPolar);
        })
        .catch(error => {
            errorAlert(error.response.data.message);
        })
}

function getMostPrograms(){
    axios.get('api/v1/public/departments/most-programs')
        .then(response => {
            let data = response.data.data;
            let labels = [];
            let dataPoints = [];
            data.forEach(department => {
                labels.push(department.department_name);
                dataPoints.push(department.total_programs);
            })
            const chartPie = document.getElementById('ChartPie');
            const dataChartPie = {
                labels: labels,
                datasets: [{
                    label: 'Total ',
                    data: dataPoints,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
                    ],
                    hoverOffset: 4
                }]
            };

            const configChartPie = {
                type: 'pie',
                data: dataChartPie,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: '5 Kejuruan dengan Program Terbanyak '
                        }
                    }
                }
            };

            new Chart(chartPie, configChartPie);
        })
        .catch(error => {
            errorAlert(error.response.data.message);
        })
}