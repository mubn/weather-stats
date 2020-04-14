# Weather Stats

With "Weather Stats" atmospheric temperature-, humidity- and pressure data can be long-term saved and displayed. The data can be collected for example with the [BME280](https://www.bosch-sensortec.com/products/environmental-sensors/humidity-sensors-bme280/). Boards with this sensor can be purchased in various online shops and operated with a Raspberry Pi for example. 

This application is an easy and efficient way to collect and display collected weather data. It is not necessary to connect to a database server or to install a new one. Also it is not necessary to use Grafana to show the collected data. The entire application consists of a few PHP files and a few lines of JavaScript code. Charts are drawn with the use of the JavaScript library [Chart.js](https://www.chartjs.org). The data is persisted in a SQLite database, which is natively supported by PHP (no installation required). This application runs in a single Docker comtainer and uses a official PHP Docker image.

The application is basic-auth-secured. Set your credentials in the [login.php](./app/login.php). This authentication method is only secure with activated transport encryption!

![Weather stats](./WeatherStats.png)

## Run

### Run as single Docker container

Run the last image version:

```
docker run -p 80:80 -it --rm --name weather-stats inettech/weather-stats
```

Run the latest image version and mount the database directory on the host file system:

```
docker run -v `pwd`/db:/db -p 80:80 -it --rm --name weather-stats inettech/weather-stats
```

### Run in a Kubernetes cluster

Overwrite the chart settings with your own values.yaml and install the helm chart:

```
helm upgrade --install --values myvalues.yaml weather ./chart/
```

### Run locally for development

Run and mount the web directory:

```
docker run -v `pwd`/app:/var/www/html/ -p 80:80 -it --rm --name weather-stats weather-stats
```

## Init

```
curl http://weather_user:weather_pass@localhost/init.php
```

### Send some dummy data

```
curl http://weather_user:weather_pass@localhost/save.php --data "sensorid=1&temperature=22&pressure=1008&humidity=60"
```

## Backup data

Simply copy the database file `weather.db` to location of your choice. With Docker:

```
docker cp weather-stats:/db/weather.db /path/to/backups/weather.db
```

Kubernetes:

```
kubectl cp weather-chart-f768856f-wlqt4:/db/weather.db /path/to/backups/weather.db
```

## Send data

Simply send the POST parameters "sensorid", "temperature", "pressure" and "humidity" to "/save.php". For example with curl:

```
curl https://weather_user:weather_pass@weather_server/save.php --data "sensorid=1&temperature=22&pressure=1008&humidity=60"
```

or with "Python-Requests":

```
#!/usr/bin/python
import requests
requests.post("http://weather_user:weather_pass@localhost/save.php", data={'sensorid':'1','temperature':'22','pressure':'1008','humidity':'60'})
```

## ToDo's

Show data from multiple sensors.
