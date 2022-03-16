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

const config = {
  type: 'bar',
  data: data,
  options: {
    plugins: {
      legend: {
        onClick: (evt, legendItem,legend) => {
          const indexOfRhesus = legend.chart.config._config.data.labels.indexOf(legendItem.text);
          legend.chart.toggleDataVisibility(indexOfRhesus);
          console.log(legend.chart);
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
          }
        }
      }
    }
  }
};

const myChart = new Chart(
  document.getElementById('myChart'),
  config
);
  