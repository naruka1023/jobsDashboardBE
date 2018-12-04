# Jobs Dashboard Backend
  For the frontend, (and part 1) please refer to https://github.com/naruka1023/jobsDashboardFE <br><br> When I first conceived the idea for this project, I knew I wanted to create a REST API using the laravel framework. The problem is, I do not know where to get data from. I don't know what kind of data to procure either. After a brief search in the internet, I came across an API I'm happy with entitled https://jobs.github.com/positions.json (https://jobs.github.com/api) that returns a substantial amount of job postings. So I tried to design and develop an API that my app will use  around data collected from the https://jobs.github.com/positions.json API. First, I created a blank database using AWS-and with laravel's seeding functionality-I called the https://jobs.github.com/positions.json API and pulled as much job data the API is willing to offer, and I stored all of it in my database. So all the jobs data you see in this app are pulled from the REST API I created with data originated from the https://jobs.github.com/positions.json API. <br><br>
  But I'm not stopping there, I knew I wanted to interact with potential Job applicants in someway, and that feat requires that I create an applicants table that house all the fake and random job applicants. The Job applicants table has a many-to many relationship with the jobs table, So I design the database to be in Third Normal Form (3NF). I might be wrong, but it works nonetheless. There are other stuff I developed with this database and the REST API as well, but the lions share of functionalities is what I have mentioned prior. 
  <br><br>
  Database Diagram <br><br>
![alt text](https://github.com/naruka1023/jobsDashboardBE/blob/master/databaseJob.png)

<br><br>
App starts here: https://jobdashboardbe.herokuapp.com/

