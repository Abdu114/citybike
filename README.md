# Citybike
This is a pre-assignment for a company.

The assignment is to create a web application with backend service for displaying data from journeys made with city bikes in the Helsinki Capital area.

**Live demo**
>https://lasoco.fi/port/city-bike/

# Prerequisites
The datasets were in CSV file format. I decided to move all the data into a database and ofcourse I can't move a 2.9 million journeys into the database manually. So I generated a file which fetches from the CSV files and inserted into the database.

For the database I used mySQL using phpMyAdmin software. To have this software you need to have a web server. I used XAMPP as a web server (localhost). Also Linux users can use install it.

### Database

Create a database called city_bike in your phpMyAdmin panel.

SQL command for creating the database
```
CREATE DATABASE city_bike
```
After you create it. You need two tables in it. One for the stations and the other for the journeys.

** SQL command for reating stations table.**

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

Journey database structure
![image](https://user-images.githubusercontent.com/43959036/210271344-f32662b2-11bf-4b6d-866e-ef655f59dbae.png)

* Import data from the CSV files to a database or in-memory storage (done)
* Validate data before importing (done)
* Don't import journeys that lasted for less than ten seconds (done)
* Don't import journeys that covered distances shorter than 10 meters (done)

Journey list view
Recommended
* List journeys
  * If you don't implement pagination, use some hard-coded limit for the list length because showing several million rows would make any browser choke (done)
* For each journey show departure and return stations, covered distance in kilometers and duration in minutes (done)

Additional
* Pagination (done)
* Ordering per column
* Searching (done)
* Filtering
