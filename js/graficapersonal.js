var options = {
    series: [{
        data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100]
    }],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            horizontal: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
            'United States', 'China', 'Germany'
        ],
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
