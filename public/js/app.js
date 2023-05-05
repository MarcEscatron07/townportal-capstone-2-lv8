/** APPLY CUSTOM JS CODE HERE */
const chartNetworksByMonth = document.getElementById('chartNetworksByMonth');
const chartNetworksByProvider = document.getElementById('chartNetworksByProvider');

const chartComputersByStatus = document.getElementById('chartComputersByStatus');
const chartComputersByMonth = document.getElementById('chartComputersByMonth');

const chartPeripheralsByMonth = document.getElementById('chartPeripheralsByMonth');
const chartPeripheralsByType = document.getElementById('chartPeripheralsByType');

const chartProductsByCategory = document.getElementById('chartProductsByCategory');
const chartProductsByMonth = document.getElementById('chartProductsByMonth');


new Chart(chartNetworksByMonth, {
    type: 'line',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'JANUARY',
            'FEBRUARY',
            'MARCH',
            'APRIL',
            'MAY',
            'JUNE',
            'JULY',
            'AUGUST',
            'SEPTEMBER',
            'OCTOBER',
            'NOVEMBER',
            'DECEMBER',
        ],
        datasets:[{
            label: '',
            data: [
                countNetworksJAN,
                countNetworksFEB,
                countNetworksMAR,
                countNetworksAPR,
                countNetworksMAY,
                countNetworksJUN,
                countNetworksJUL,
                countNetworksAUG,
                countNetworksSEP,
                countNetworksOCT,
                countNetworksNOV,
                countNetworksDEC,
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(81, 167, 79, 1)',
                'rgba(45, 47, 118, 1)',
                'rgba(13, 202, 240, 1)',
                'rgba(79, 167, 149, 1)',
                'rgba(250, 123, 1, 1)',
                'rgba(166, 143, 48, 1)',
                'rgba(166, 83, 48, 1)',
                'rgba(227, 65, 48, 1)',
                'rgba(111, 66, 193, 1)',
            ]
        }]
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 5,
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                },
                min:0,
                max:parseInt(maxCountNetworksMonth % 2 == 0 ? maxCountNetworksMonth+10 : maxCountNetworksMonth+11),
                stepSize: 1,
            },
        }
    }
});
new Chart(chartNetworksByProvider, {
    type: 'pie',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'PLDT','Globe','Converge','DITO','Starlink'
        ],
        datasets: [{
            label: 'Network Provider',
            data: [
                countNetworksPLDT,
                countNetworksGlobe,
                countNetworksConverge,
                countNetworksDITO,
                countNetworksStarlink,
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(81, 167, 79, 1)',
                'rgba(45, 47, 118, 1)',
            ],
            hoverOffset: 4
        }],
        datalabels: {
            anchor: 'end'
        }
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 6,
                formatter: function(value, context) {
                    if(sumNetworksProvider != 0){
                        value = Math.round((value / sumNetworksProvider) * 100) ;
                    }

                    return context.active
                        ? context.dataset.label + '\n' + value + '%'
                        : Math.round(value);
                },
            }
        },
    }
});

new Chart(chartComputersByStatus, {
    type: 'doughnut',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'Available','In Use','Under Maintenance'
        ],
        datasets: [{
            label: 'Gender',
            data: [
                countComputersAvailable,
                countComputersInUse,
                countComputersUnderMaintenance,
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
            ],
            hoverOffset: 4
        }],
        datalabels: {
            anchor: 'end'
        }
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 5,
                formatter: function(value, context) {
                    if(sumComputersStatus != 0){
                        value = Math.round((value / sumComputersStatus) * 100) ;
                    }

                    return context.active
                        ? context.dataset.label + '\n' + value + '%'
                        : Math.round(value);
                },
            }
        },
    }
});
new Chart(chartComputersByMonth, {
    type: 'line',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'JANUARY',
            'FEBRUARY',
            'MARCH',
            'APRIL',
            'MAY',
            'JUNE',
            'JULY',
            'AUGUST',
            'SEPTEMBER',
            'OCTOBER',
            'NOVEMBER',
            'DECEMBER',
        ],
        datasets:[{
            label: '',
            data: [
                countComputersJAN,
                countComputersFEB,
                countComputersMAR,
                countComputersAPR,
                countComputersMAY,
                countComputersJUN,
                countComputersJUL,
                countComputersAUG,
                countComputersSEP,
                countComputersOCT,
                countComputersNOV,
                countComputersDEC,
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(81, 167, 79, 1)',
                'rgba(45, 47, 118, 1)',
                'rgba(13, 202, 240, 1)',
                'rgba(79, 167, 149, 1)',
                'rgba(250, 123, 1, 1)',
                'rgba(166, 143, 48, 1)',
                'rgba(166, 83, 48, 1)',
                'rgba(227, 65, 48, 1)',
                'rgba(111, 66, 193, 1)',
            ]
        }]
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 5,
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                },
                min:0,
                max:parseInt(maxCountComputersMonth % 2 == 0 ? maxCountComputersMonth+10 : maxCountComputersMonth+11),
                stepSize: 1,
            },
        }
    }
});

new Chart(chartPeripheralsByMonth, {
    type: 'line',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'JANUARY',
            'FEBRUARY',
            'MARCH',
            'APRIL',
            'MAY',
            'JUNE',
            'JULY',
            'AUGUST',
            'SEPTEMBER',
            'OCTOBER',
            'NOVEMBER',
            'DECEMBER',
        ],
        datasets:[{
            label: '',
            data: [
                countPeripheralsJAN,
                countPeripheralsFEB,
                countPeripheralsMAR,
                countPeripheralsAPR,
                countPeripheralsMAY,
                countPeripheralsJUN,
                countPeripheralsJUL,
                countPeripheralsAUG,
                countPeripheralsSEP,
                countPeripheralsOCT,
                countPeripheralsNOV,
                countPeripheralsDEC,
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(81, 167, 79, 1)',
                'rgba(45, 47, 118, 1)',
                'rgba(13, 202, 240, 1)',
                'rgba(79, 167, 149, 1)',
                'rgba(250, 123, 1, 1)',
                'rgba(166, 143, 48, 1)',
                'rgba(166, 83, 48, 1)',
                'rgba(227, 65, 48, 1)',
                'rgba(111, 66, 193, 1)',
            ]
        }]
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 5,
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                },
                min:0,
                max:parseInt(maxCountPeripheralsMonth % 2 == 0 ? maxCountPeripheralsMonth+10 : maxCountPeripheralsMonth+11),
                stepSize: 1,
            },
        }
    }
});
new Chart(chartPeripheralsByType, {
    type: 'pie',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'Headphone','Keyboard','Monitor','Mouse','Webcam'
        ],
        datasets: [{
            label: 'Peripheral Type',
            data: [
                countPeripheralsHeadphone,
                countPeripheralsKeyboard,
                countPeripheralsMonitor,
                countPeripheralsMouse,
                countPeripheralsWebcam,
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(81, 167, 79, 1)',
                'rgba(45, 47, 118, 1)',
            ],
            hoverOffset: 4
        }],
        datalabels: {
            anchor: 'end'
        }
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 6,
                formatter: function(value, context) {
                    if(sumPeripheralsType != 0){
                        value = Math.round((value / sumPeripheralsType) * 100) ;
                    }

                    return context.active
                        ? context.dataset.label + '\n' + value + '%'
                        : Math.round(value);
                },
            }
        },
    }
});

new Chart(chartProductsByCategory, {
    type: 'doughnut',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'Food','Drinks'
        ],
        datasets: [{
            label: 'Categories',
            data: [
                countProductsFood,
                countProductsDrinks,
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            hoverOffset: 4
        }],
        datalabels: {
            anchor: 'end'
        }
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 5,
                formatter: function(value, context) {
                    if(sumProductsCategory != 0){
                        value = Math.round((value / sumProductsCategory) * 100) ;
                    }

                    return context.active
                        ? context.dataset.label + '\n' + value + '%'
                        : Math.round(value);
                },
            }
        },
    }
});
new Chart(chartProductsByMonth, {
    type: 'line',
    responsive:true,
    plugins: [ChartDataLabels],
    data: {
        labels: [
            'JANUARY',
            'FEBRUARY',
            'MARCH',
            'APRIL',
            'MAY',
            'JUNE',
            'JULY',
            'AUGUST',
            'SEPTEMBER',
            'OCTOBER',
            'NOVEMBER',
            'DECEMBER',
        ],
        datasets:[{
            label: '',
            data: [
                countProductsJAN,
                countProductsFEB,
                countProductsMAR,
                countProductsAPR,
                countProductsMAY,
                countProductsJUN,
                countProductsJUL,
                countProductsAUG,
                countProductsSEP,
                countProductsOCT,
                countProductsNOV,
                countProductsDEC,
            ],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1,
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(81, 167, 79, 1)',
                'rgba(45, 47, 118, 1)',
                'rgba(13, 202, 240, 1)',
                'rgba(79, 167, 149, 1)',
                'rgba(250, 123, 1, 1)',
                'rgba(166, 143, 48, 1)',
                'rgba(166, 83, 48, 1)',
                'rgba(227, 65, 48, 1)',
                'rgba(111, 66, 193, 1)',
            ]
        }]
    },
    options: {
        plugins: {
            datalabels: {
                backgroundColor: function(context) {
                    return context.dataset.backgroundColor;
                },
                borderColor: 'white',
                borderRadius: 25,
                borderWidth: 2,
                color: 'white',
                font: {
                    weight:'bold'
                },
                padding: 5,
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {if (value % 1 === 0) {return value;}}
                },
                min:0,
                max:parseInt(maxCountProductsMonth % 2 == 0 ? maxCountProductsMonth+10 : maxCountProductsMonth+11),
                stepSize: 1,
            },
        }
    }
});
