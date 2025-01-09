## About UzimaTek

This CMS is a web application developed by Laravel framework. It has the following Features:

- Dashboard - Viewing of a number of reports.
- Catalog - Country, Patient Category and Specialization.
- User Management - Users and Roles.
- Practitioners
- Patients
- Referrals (Referrals In and Referrals Out)
- Diagnoses
- Facilities

- More Modules Coming up. SMS Intergration, Email Communication.


## Requirements

- PHP version 8.1+
- PHP Mcrypt
- PHP Mysql
- Composer
- mbstring
- dom extention
- Scribe

## Installation Steps

- Clone the repository with **git clone -- file name**
- Copy **.env.example** file to **.env** and edit database credentials there
- Run **composer install**
- Run **php artisan key:generate**
- Run **php artisan migrate --seed**
- That's it - load the homepage, and log in with credentials **admin@admin.com / password.**

## License

This Application is developed and licensed under Kemkip