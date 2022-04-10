function getData(Datasets_Pie){
    let TotalSum = 0;
    let i = 0;
    
    for(i; i < Datasets_Pie.data.datasets[0].data.length; i++){
        if(Datasets_Pie.getDataVisibility(i) === true){
            TotalSum += Datasets_Pie.data.datasets[0].data[i];
        }
    }
    return TotalSum;
}

/*================================== Datasets BarChart================================== */

const datasets_parse = JSON.parse(datasets);

const each_datasets = datasets_parse.map(EachData => {
    return {
        label: EachData.label,
        data: EachData.data,
        borderColor: EachData.borderColor,
        backgroundColor: EachData.backgroundColor,
    }
});


const data_datasets = {
    labels: ['Datasets'],
    datasets: each_datasets,
};

const config_datasets = {
    type: 'bar',
    data: data_datasets,
    options: {
        plugins: {
            labels: false,
        },
        scales: {
            y: {
                suggestedMin: 0,
                suggestedMax: 100,
                ticks: {
                    precision: 0
                }
            }
        }
    }
};

const Bar_Chart_Datasets = new Chart(document.getElementById('Bar_Chart_Datasets'), config_datasets);

/*=============================== Datasets Pie ====================================== */

const data_pie_chart = {
    labels: [datasets_parse[0].label, datasets_parse[1].label],
    datasets: [{
        data: [amount_trainings, amount_testings],
        backgroundColor: [datasets_parse[0].backgroundColor, datasets_parse[1].backgroundColor],
        hoverOffset: 5
    }]
};

const config_pie_Datasets = {
    type: 'pie',
    data: data_pie_chart,
    options: {
        plugins: {
            labels: {
                render: (context) => {
                    const percentage = context.value / getData(Pie_Chart_Datasets) * 100;
                    return percentage.toFixed(1) + '%';
                },
                precision: 1,
                fontColor: 'black',
            }
        }
    }
};

const Pie_Chart_Datasets = new Chart(document.getElementById('Pie_Chart_Datasets'), config_pie_Datasets);


/*============================= Data Training Bar Chart ========================================== */


const data_training_parse = JSON.parse(structure_data_trainings);

const each_data_training = data_training_parse.map(EachData => {
    return {
        label: EachData.label,
        data: EachData.data,
        borderColor: EachData.borderColor,
        backgroundColor: EachData.backgroundColor,
    }
});


const data_trainings = {
    labels: ['Data Training'],
    datasets: each_data_training,
};

const config_data_training = {
    type: 'bar',
    data: data_trainings,
    options: {
        plugins: {
            labels: false,
        },
        scales: {
            y: {
                suggestedMin: 0,
                suggestedMax: 100,
                ticks: {
                    precision: 0
                }
            }
        }
    }
};

const Bar_Chart_Data_Trainings = new Chart(document.getElementById('Bar_Chart_Data_Trainings'), config_data_training);



/*=================================== Pie Chart Data Training ================================================ */
let temp = [];

for(let i=0; i < data_training_parse.length; i++){
     temp.push(data_training_parse[i].data[0]);
}

const data_trainings_label = data_training_parse.map(EachData => {
    return EachData.label;
});

const data_pie_data_training = {
    labels: data_trainings_label,
    datasets: [
        {
            data: temp,
            backgroundColor: [data_training_parse[0].backgroundColor, data_training_parse[1].backgroundColor],
            hoverOffset: 5
        }
    ]
};

const config_pie_data_training = {
    type: 'pie',
    data: data_pie_data_training,
    options: {
        plugins: {
            labels: {
                render: (context) => {
                    const percentage = context.value / getData(Pie_Chart_Data_Trainings) * 100;
                    return percentage.toFixed(1) + '%';
                },
                precision: 1,
                fontColor: 'black',
            }
        }
    }
};

const Pie_Chart_Data_Trainings = new Chart(document.getElementById('Pie_Chart_Data_Trainings'), config_pie_data_training);





/*================================================ Bar Chart Data Testing ==================================================== */

const data_testings_parse = JSON.parse(structure_data_testings);

const each_data_testing = data_testings_parse.map(EachData => {
    return {
        label: EachData.label,
        data: EachData.data,
        borderColor: EachData.borderColor,
        backgroundColor: EachData.backgroundColor,
    }
});


const data_testings = {
    labels: ['Data Testing'],
    datasets: each_data_testing,
};

const config_data_testings = {
    type: 'bar',
    data: data_testings,
    options: {
        plugins: {
            labels: false,
        },
        scales: {
            y: {
                suggestedMin: 0,
                suggestedMax: 100,
                ticks: {
                    precision: 0
                }
            }
        }
    }
};

const Bar_Chart_Data_Testings = new Chart(document.getElementById('Bar_Chart_Data_Testings'), config_data_testings);


/*============================================= Pie Chart Data Testings ======================================================= */

let temp_2 = [];

for(let i=0; i < data_testings_parse.length; i++){
     temp_2.push(data_testings_parse[i].data[0]);
}

const data_testings_label = data_testings_parse.map(EachData => {
    return EachData.label;
});

const data_pie_data_testing = {
    labels: data_testings_label,
    datasets: [
        {
            data: temp_2,
            backgroundColor: [data_testings_parse[0].backgroundColor, data_testings_parse[1].backgroundColor],
            hoverOffset: 5
        }
    ]
};

const config_pie_data_testings = {
    type: 'pie',
    data: data_pie_data_testing,
    options: {
        plugins: {
            labels: {
                render: (context) => {
                    const percentage = context.value / getData(Pie_Chart_Data_Testings) * 100;
                    return percentage.toFixed(1) + '%';
                },
                precision: 1,
                fontColor: 'black',
            }
        }
    }
};

const Pie_Chart_Data_Testings = new Chart(document.getElementById('Pie_Chart_Data_Testings'), config_pie_data_testings);