let weatherCharts = [];

function pad(number) {
  if (number < 10) {
    return '0' + number;
  }
  return number;
}

Date.prototype.toISOString = function () {
  return this.getUTCFullYear() +
    '-' + pad(this.getUTCMonth() + 1) +
    '-' + pad(this.getUTCDate()) +
    ' ' + pad(this.getUTCHours()) +
    ':' + pad(this.getUTCMinutes()) +
    ':' + pad(this.getUTCSeconds());
};

function buildCharts(url, charts, fromDate, toDate) {
  fetch(url + '?sensorid=1&fromDate=' + fromDate + '&toDate=' + toDate)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (weatherCharts.length > 0) {
        updateCharts(data);
      } else {
        drawCharts(data, charts);
      }
      insertLatestValues(data, charts);
    });
}

function insertLatestValues(data, charts) {
  let temperature = document.getElementById('temperature_current');
  let pressure = document.getElementById('pressure_current');
  let humidity = document.getElementById('humidity_current')
  temperature.textContent = data[1][data[1].length - 1] + ' °C';
  temperature.style.color = charts[0][1];
  pressure.textContent = data[2][data[2].length - 1] + ' hPa';
  pressure.style.color = charts[1][1];
  humidity.textContent =  data[3][data[3].length - 1] + ' %';
  humidity.style.color = charts[2][1];
}

function updateCharts(data) {
  for (i = weatherCharts.length - 1; i >= 0; i--) {
      weatherCharts[i].data.labels = data[0];
      weatherCharts[i].data.datasets[0].data = data[i + 1];
      weatherCharts[i].update();
  }
}

function drawCharts(data, charts) {
  weatherCharts = [];
  for (i = 0; i < charts.length; i++) {
    let ctx = document.getElementById(charts[i][0]).getContext('2d');
    weatherCharts.push(new Chart(ctx, {
      type: 'line',
      data: {
        labels: data[0],
        datasets: [{
          label: charts[i][0],
          data: data[i + 1],
          backgroundColor: false,
          borderColor: charts[i][1],
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
        scaleShowLabels : false,
        legend: {
          display: false
        },
        elements: {
          point: {
            radius: 1,
            hoverRadius: 4
          }
        },
        scales: {
          xAxes: [{
              ticks: {
                  display: false
              },
              gridLines: {
                display:false
              }
          }]
      }
      }
    }));
  }
}

function pageInit() {
  const now = new Date();
  const last30Days = new Date(new Date().setDate(new Date().getDate() - 30));
  const last7Days = new Date(new Date().setDate(new Date().getDate() - 7));
  const last1Day = new Date(new Date().setDate(new Date().getDate() - 1));
  const structure = [['temperature', 'red'], ['pressure', 'blue'], ['humidity', 'green']];

  buildCharts('/data.php', structure, last1Day.toISOString(), now.toISOString());

  document.getElementById('day').onclick = function() {
    buildCharts('/data.php', structure, last1Day.toISOString(), now.toISOString());
  }
  document.getElementById('month').onclick = function() {
    buildCharts('/data.php', structure, last7Days.toISOString(), now.toISOString());
  }
  document.getElementById('year').onclick = function() {
    buildCharts('/data.php', structure, last30Days.toISOString(), now.toISOString());
  }
}

window.onload = function () {
  this.pageInit();
}
