function buildCharts(url, charts) {
  fetch(url)
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
      }
    });
  }
}
