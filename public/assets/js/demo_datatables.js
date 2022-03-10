$(document).ready(function(){
    $('#DataTables').DataTable();
    $('#DataTables_2').DataTable();
});

const labels = [
  'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
];

const data = {
  labels: labels,
  datasets: [{
    label: 'My First dataset',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [ test , 10, 5, 2, 20, 30, 45],
  }]
};

const config = {
  type: 'line',
  data: data,
  options: {}
};

const myChart = new Chart(
  document.getElementById('myChart'),
  config
);
  