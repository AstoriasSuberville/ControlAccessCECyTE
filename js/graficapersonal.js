var options = {
    series: [44, 55],
    chart: {
        width: 380,
        type: 'pie',
        toolbar: {
            show: true,
            offsetX: 0,
            offsetY: 0,
            tools: {
                download: true,
                selection: true,
                zoom: true,
                zoomin: true,
                zoomout: true,
                pan: true,
                reset: true | '<img src="/static/icons/reset.png" width="20">',
                customIcons: []
            },
            export: {
                csv: {
                    filename: undefined,
                    columnDelimiter: ',',
                    headerCategory: 'category',
                    headerValue: 'value',
                    dateFormatter(timestamp) {
                        return new Date(timestamp).toDateString()
                    }
                },
                svg: {
                    filename: undefined,
                },
                png: {
                    filename: undefined,
                }
            },
            autoSelected: 'zoom'
        },
    },
    //colors: ['#1CD6CE', '#D61C4E'],
    labels: ['Inasistencias', 'Asistencias'],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();