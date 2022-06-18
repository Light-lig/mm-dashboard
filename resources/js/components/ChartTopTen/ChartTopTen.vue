<template>
  <div class="example shadow-sm bg-white">
    <apexcharts  type="bar" :options="chartOptions" :series="series"></apexcharts>
  </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'

export default {
  name: 'Chart',
  components: {
    apexcharts: VueApexCharts,
  },
  data: function() {
    return {
      chartOptions: {
        dataLabels: {
          enabled: false
        },

        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"]
        }
      },
      series: [
        {
          name: "Majestic",
          data: [31, 40, 28, 51, 42, 109, 100]
        },
        {
          name: "Prueba",
          data: [11, 32, 45, 32, 34, 52, 41]
        }
      ]
    };
  },
}
</script>