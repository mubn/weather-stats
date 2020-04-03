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
  fetch(url + '?fromDate=' + fromDate + '&toDate=' + toDate)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      drawCharts(data, charts);
    });
}

function drawCharts(data, charts) {
  for (i = 0; i < charts.length; i++) {
    let ctx = document.getElementById(charts[i][0]).getContext('2d');
    new Chart(ctx, {
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
        legend: {
          display: false
        },
      }
    });
  }
}

function page() {
  var now = new Date();
  var last365Days = new Date(new Date().setDate(new Date().getDate() - 365));
  var last30Days = new Date(new Date().setDate(new Date().getDate() - 30));
  var last1Day = new Date(new Date().setDate(new Date().getDate() - 1));
  var structure = [['temperature', 'red'], ['pressure', 'blue'], ['humidity', 'green']];

  buildCharts('/data.php', structure, last30Days.toISOString(), now.toISOString());

  document.getElementById('day').onclick = function() {
    buildCharts('/data.php', structure, last1Day.toISOString(), now.toISOString());
  }
  document.getElementById('month').onclick = function() {
    buildCharts('/data.php', structure, last30Days.toISOString(), now.toISOString());
  }
  document.getElementById('year').onclick = function() {
    buildCharts('/data.php', structure, last365Days.toISOString(), now.toISOString());
  }
}
