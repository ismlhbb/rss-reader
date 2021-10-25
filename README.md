<h1 align="center">RSS Reader Application</h1>

### Spesification Program
- Built using `PHP` and `MySQL` database
- Using RSS Feed from [vice.com](https://www.vice.com/id/rss?locale=id_id) news portal
- Displays a list of all articles:
  - Title,
  - Published Date,
  - Action to view article details
- Displays Article Details:
  - URL,
  - Title,
  - Published Time,
  - Full Content

### How to run on Local Machine? (Example using XAMPP)
- Use XAMPP tools and activate `Apache` and `MySQL` modules
- Move the `rssreader` folder into the `xampp/htdocs` folder
- Open `PHPMyAdmin` to create a new database and import `rssreader.sql` contained in the database folder
- After a successful import, open the `db.php` file, then set `dbname` according to the database name created
- Set the `action.php` file and change the name of `rssreader` according to the name of the database created
- Run the `index.php` file in the browser by visiting [localhost/rssreader](https://localhost/rssreader)
- Note: make sure the internet connection is active

### Technology used
- PHP-OOP,
- PDO-MySQL,
- Ajax,
- Datatable,
- SweetAlert 2,
- Bootstrap 4,
- Font Awesome.

---
