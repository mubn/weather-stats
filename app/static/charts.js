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
  for (i = 0; i <= charts.length; i++) {
    let ctx = document.getElementById(charts[i]).getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: data[i],
        datasets: [{
          label: charts[i],
          data: data[i],
          backgroundColor: 'rgba(255, 155, 64, 0.1)',
          borderColor: 'rgba(255, 155, 64, 1)',
          borderWidth: 1
        }]
      },
      options: {}
    });
  }
}
