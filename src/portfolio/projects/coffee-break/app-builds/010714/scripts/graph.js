        $(window).ready(function(){
                       
                window.options = {
                    chart: {
                            renderTo: 'graph-container',
                            type: 'line'
                        },
                        title: {
                            text: 'Work & Break Trend For Past Week'
                        },
                        xAxis: {
                            //categories: ['Monday','Tuesday','Wednesday','Thursday','Friday', 'Saturday', 'Sunday']
                            categories: ['Seven Days Ago','Six Days Ago','Five Days Ago','Four Days Ago','Three Days Ago', 'Two Days Ago', 'One Day Ago']
                        },
                        yAxis: {
                            title: {
                                text: 'Number of Hours'
                            }
                        },
                        colors: ['#0d233a', '#D59260'
                        ],
                        series: [{
                            name: 'Work',
                            data: []
                        }, {
                            name: 'Break',
                            data: []
                        }]
                };

                window.chart = new Highcharts.Chart(window.options);
                
        });