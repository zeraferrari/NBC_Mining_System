$(document).ready(function(){
    $('#DataTables').DataTable();
    $('#DataTables_2').DataTable();
});


const labels = Data_Rhesus;
const BgColorEachBar = [];

for(let i = 0; i < labels.length; i++) {
  if(labels[i] === 'A+'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'A-'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'B+'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'B-'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'O+'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'O-'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'AB+'){ BgColorEachBar.push('#6777ef') }
  if(labels[i] === 'O-'){ BgColorEachBar.push('#6777ef') }
}


const data = {
  labels: labels,
  datasets: [{
    label: 'Jumlah Data',
    backgroundColor: BgColorEachBar,
    borderColor: ['#FFFFFF'],
    data: Data_Each_Rhesus,
  }]
};

const config_bar = {
  type: 'bar',
  data: data,
  options: {
    plugins: {
      legend: {
        onClick: (evt, legendItem,legend) => {
          const indexOfRhesus = legend.chart.config._config.data.labels.indexOf(legendItem.text);
          legend.chart.toggleDataVisibility(indexOfRhesus);
          legend.chart.update();
        },
        labels: {
          generateLabels: (chart) => {
            let visibility = [];
            for(let i=0; i < chart.config._config.data.labels.length; i++){
              (chart.getDataVisibility(i) === true) ? visibility.push(false) : visibility.push(true);
            };
            return chart.config.data.labels.map(
                (label, index) => ({
                  text: label,
                  strokeStyle: chart.config._config.data.datasets[0].borderColor[index],
                  fillStyle: chart.config._config.data.datasets[0].backgroundColor[index],
                  hidden: visibility[index],
              })
            )
          },
          boxWidth: 20,
        }
      },
      labels: {
        render: 'value',
      },
      title: {
        display: false,
        text: 'Bar Chart Keseluruhan Rhesus'
      }
    },
    scales: {
        y: {
          ticks: {
            precision: 0,
          },
          suggestedMax: 20,
        }
    },
  }
};

const DashboardBar = new Chart(
  document.getElementById('DashboardBar'),
  config_bar
);

/* =========================================================================*/

const data_pie = {
  labels: Data_Rhesus,
  datasets: [{
    label: 'Jumlah Data',
    data: Data_Each_Rhesus,
    backgroundColor: [
      'rgba(255, 33, 33, 0.5)',
      'rgba(255, 204, 0, 0.5)',
      'rgba(40, 255, 0, 0.5)',
      'rgba(0, 255, 177, 0.5)',
      'rgba(0, 51, 255, 0.5)',
      'rgba(140, 0, 255, 0.5)',
      'rgba(255, 0, 157, 0.66)',
      'rgba(0, 78, 255, 0.76)',
    ],
  }],
};

const config_pie = {
  type: 'pie',
  data: data_pie,
  options: {
    plugins: {
      labels: {
        render: (context) => {
            const percentage = context.value / showData(this) * 100;
            return percentage.toFixed(1) + '%';
        },
        precision: 1,
        fontColor: 'black',
      },
      title: {
        display: false,
        text: 'Persentase Kategori Seluruh Kategori Rhesus'
      },
      legend: {
          labels: {
              boxWidth: 20,
          },
      }
    }
  }
  // plugins: [ChartDataLabels],
};

function showData(){
  let TotalSum = 0;
  let i = 0;
  for(i; i < DashboardPie.config.data.datasets[0].data.length; i++){
    if(DashboardPie.getDataVisibility(i) === true){
      TotalSum += DashboardPie.config.data.datasets[0].data[i];
    }
  }
  return TotalSum;
}

const DashboardPie = new Chart(document.getElementById('DashboardPie'), config_pie);


/*====================================================================================================*/

const labels_3 = ['January', 'February', 'Maret', 'April', 'Mei'];
const data_3 = {
  labels: labels_3,
  datasets: [
    {
        label: 'A+',
        data: [65, 59, 48, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1 
    },
    {
        label: 'B+',
        data: [100, 0, 3, 47, 56, 55, 40],
        fill: false,
        borderColor: 'pink',
        tension: 0.1 
    },
    {
        label: 'O+',
        data: [14, 300, 10, 72, 56, 55, 40],
        fill: false,
        borderColor: 'Blue',
        tension: 0.1 
    }
  ]
};

const config_line = {
  type: 'line',
  data: data_3,
  options:{
      plugins:{
          legend:{
              labels:{
                  boxWidth: 20
              },
          }
      },
  },
};


const LineTransaction = new Chart(document.getElementById('LineTransaction'), config_line);