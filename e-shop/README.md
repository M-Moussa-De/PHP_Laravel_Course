# E-Shop M&M

This is an e-shop for selling products.

## Features

- Signup and signin system
- Admin dashboard (CRUD)
- Rols and permission (User and admin)
- Cart
- Pagination system
- Change language
- Contact us
- Admin profile
- To Do List

## Main used technologies and tools

- HTML
- CSS
- JavaScript / JQuery
- PHP
- Database system (MySQL)

## How to set up and run the project

Go through the following steps respectively to run this project locally:

1- Clone or download the project on your machine (Note: )

1- On your CLI, PhpMyadmin or Workbench run the queries, which are in the `queries.sql` file respectively to have a full ready database. (You can modify the data itself if you wish)

2- Modify (in case you've updated the file from the 1<sup>st</sup> step) `db.php` to your new DB user account.

3- Modify the `ROOT_PATH` within the `config.php`.
Note: - I'm using a virtual host, in case you haven't set one, you can write the full/absolute path to the root of the project
and because of the CORS policy it should starts with the http protocol and not a local path like <s>`C:\\xampp\htdocs`</s>
and it should look like `http://localhost/e-shop`

4- Use the credentials on the `queries.db` to login as a user or an admin. In case you have updated these credentials, then use the new one.

5- Now, you are on the system and can use it according to you role :smiley:
