<template>
  <div>
    <div class="card">
        <div class="card-header">
          <div>
            <h2 class="fw-bolder mb-0">{{ value}} </h2>
            <p class="card-text">{{label}} <span class="text-dark"></span></p>
          </div>
          <div :class="'avatar bg-light-'+color+ ' p-50 m-0'">
            <div class="avatar-content">
              <i :class="icon +' font-medium-5'" ></i>
            </div>
          </div>
        </div>
      </div>
        <!-- <div class="card">
        <div class="card-header align-items-start pb-0">
          <div>
            <h2 class="fw-bolder">{{this.value}}</h2>
            <p class="card-text">{{label}}</p>
          </div>
          <div class="avatar bg-light-primary p-50">
            <div class="avatar-content">
              <i  :class="'font-medium-5 '+icon"></i>
            </div>
          </div>
        </div>
        <div id="line-area-chart-5"></div>
      </div> -->
  </div>
</template>

<script>
export default {
props:['label','total','color','value','icon'],
methods: {
    getvalues(){
        return (this.value/this.total)*100;
    }
},
mounted(){
 var lineAreaChart5 = document.querySelector('#line-area-chart-5');
 var $barColor = '#f3f3f3';
  var $trackBgColor = '#EBEBEB';
  var $primary_light = '#A9A2F6';
  var $success_light = '#55DD92';
  var $warning_light = '#ffc085';


  let trafficChartOptions = {
    chart: {
      height: 100,
      type: 'line',
      dropShadow: {
        enabled: true,
        top: 5,
        left: 0,
        blur: 4,
        opacity: 0.1
      },
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      }
    },
    colors: [window.colors.solid.primary],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 1,
        gradientToColors: [$primary_light],
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100, 100, 100]
      }
    },
    series: [
      {
        name: this.label,
        data: [150, 200, 125, 225, 200, 250]
      }
    ],
    xaxis: {
      labels: {
        show: false
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: [
      {
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: { left: 0, right: 0 }
      }
    ],
    tooltip: {
      x: { show: false }
    }
  };

  let trafficChart = new ApexCharts(lineAreaChart5, trafficChartOptions);
  trafficChart.render();
}
}
</script>

<style>

</style>
