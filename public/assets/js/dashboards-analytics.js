/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, axisColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Grafik Pengeluaran Chart - Doughnut Chart
  // --------------------------------------------------------------------
  const doughnutChartEl = document.querySelector('#doughnutChart'),
    doughnutChartConfig = {
      series: [25, 25, 25, 12, 13],
      labels: ['Makanan', 'Minuman', 'Transportasi', 'Pakaian', 'Elektronik'],
      chart: {
        type: 'donut',
        height: 300
      },
      colors: ['#FF495F', '#9CFF2E', '#FDFF00', '#C7C7C7', '#6B6F7B'],
      stroke: {
        width: 0
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
            }
          }
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      states: {
        hover: {
          filter: { type: 'none' }
        },
        active: {
          filter: { type: 'none' }
        }
      }
    };
  if (typeof doughnutChartEl !== undefined && doughnutChartEl !== null) {
    const doughnutChart = new ApexCharts(doughnutChartEl, doughnutChartConfig);
    doughnutChart.render();
  }
})();
