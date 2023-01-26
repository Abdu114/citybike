# Intro
This repository is the solution of the pre-assignment for Solita Dev Academy Finland 2023.


The assignment is to create a web application with a backend service for displaying data from journeys made with city bikes in the Helsinki Capital area.

**Live demo**
>https://lasoco.fi/port/city-bike/

# Description of the project:
A fully responsive and a modern web application which fetches data from a database.

## Features implemented in to the web app. 

### Journey list view
##### Recommended
* Listing journeys that covered distance is more than ten metres and lasted more than ten seconds. 
* For each journey showed departure and return stations, covered distance in kilometers and duration in minutes

##### Additional
* Pagination
* Searching
* Filtering

### Station list
##### Recommended
* List all the station

##### Additional
* Pagination
* Searching
* Ordering per column

### Single station view
##### Recommended
* Station name
* Station address
* Total number of journeys starting from the station
* Total number of journeys ending at the station

##### Additional
* Station location on the map (Google Maps)
* The average distance of a journey starting from the station
* The average distance of a journey ending at the station
* Ability to filter all the calculations per month

### Extras
Created UI for adding bicycle stations with Google Maps.

# Prerequisites
The datasets were in CSV file format. I decided to move all the data into a database and ofcourse I can't move a 2.9 million journeys into the database manually. So I generated a file which fetches from the CSV files and inserted into the database.

For the database I used mySQL using phpMyAdmin software. To have this software you need to have a web server. I used XAMPP as a web server (localhost). Also Linux users can use install it.

### Database

Create a database called city_bike in your phpMyAdmin panel.

**SQL command for creating the database**

```
CREATE DATABASE city_bike
```
After you create it. You need two tables in it. One for the stations and the other for the journeys.

**SQL command for creating stations table.**

```
CREATE TABLE `stations` (
  `id` int(4) NOT NULL,
  `nimi` varchar(100) NOT NULL,
  `namn` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `osoite` varchar(100) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `kaupunki` varchar(50) NOT NULL,
  `stad` varchar(50) NOT NULL,
  `operaattor` varchar(50) NOT NULL,
  `kapasiteet` int(4) NOT NULL,
  `x` varchar(15) NOT NULL,
  `y` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
**It will look like this after creation.**

![image](https://user-images.githubusercontent.com/43959036/210271389-9523442b-7591-4149-afdb-eaef6e86968f.png)


**SQL command for creating journeys table.**

```
CREATE TABLE `journeys` (
  `id` int(11) NOT NULL,
  `departure_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `departure_station_id` int(4) NOT NULL,
  `departure_station_name` varchar(100) NOT NULL,
  `return_station_id` int(4) NOT NULL,
  `return_station_name` varchar(100) NOT NULL,
  `covered_distance` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
We will connect between the two tables using foreign key by station ID.

```
ALTER TABLE `journeys`
  ADD CONSTRAINT `journeys_ibfk_1` FOREIGN KEY (`departure_station_id`) REFERENCES `stations` (`id`),
  ADD CONSTRAINT `journeys_ibfk_2` FOREIGN KEY (`return_station_id`) REFERENCES `stations` (`id`);
COMMIT;
```
![image](https://user-images.githubusercontent.com/43959036/210271344-f32662b2-11bf-4b6d-866e-ef655f59dbae.png)

>If creating the tables by this way looks stressful you can import to the database the two sql files found in the Database_tables folder. 

## Configurations
Configure the code in the db.php file if needed.
```
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'city_bike');
```

## How to run the project?
1. Clone this repository after creating database and its tables. 
2. Move all files into the XAMPP/htdocs folder.  
3. After completing this steps you can open the downloaded folder with any code editor and just run it.


**Note** Fetching journey's data in the index page is limited to 30000. If you wish to try full fetching you need to increase your maximum allowed time to respond to the browser.

Here is how you can increase it.
>https://ssamsoftwares.com/increase-php-max-execution-time-xampp-local-server/

## Technology choices:
### Frontend
* HTML5
* Materialize CSS
* AJAX using Vanilla JS
* DataTables JS
* Google Maps API

### Backend
* PHP
* MySQL

## TODO
In the station list page the table headers will not be fully responsive when screen is resized to small. But refreshing the page will solve it. 
