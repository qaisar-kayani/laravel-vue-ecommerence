<template>
  <div class="card " style=" width:100%; weight:100% display: flex;flex-direction:column;">
    <vue3-chart-js
        :id="doughnutChart.id"
        ref="chartRef"
        :type="doughnutChart.type"
        :data="doughnutChart.data"
    ></vue3-chart-js>
  </div>
</template>

<script>
import { ref } from 'vue'
import Vue3ChartJs from '@j-t-mcc/vue3-chartjs'

export default {
  name: 'App',
  components: {
    Vue3ChartJs,
  },
  setup () {
    const chartRef = ref(null)
    const doughnutChart = {
      id: 'bar',
      type: 'bar',
      data: {
       labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'Order statistics',
          
          backgroundColor: '#ffc107',
          data: [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 11]
        }
      ],
      }
    }

    const exportChart = () => {
      let a = document.createElement('a')
      a.href = chartRef.value.chartJSState.chart.toBase64Image()
      a.download = 'image-export.png'
      a.click()
      a = null
    }

    return {
      chartRef,
      doughnutChart,
      exportChart
    }
  },
}
</script>