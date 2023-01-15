# citybike
This is a pre-assignment for a company.

**Here is a live demo**
>https://lasoco.fi/port/city-bike/

Stations database structure (using phpMyAdmin)
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
