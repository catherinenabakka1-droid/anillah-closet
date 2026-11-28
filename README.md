# ANILLAH CLOSET

### Online Fashion Shopping Website

**Course:** BIT 2103 – Internet Technologies and Advanced Web Development

**Live Website:** https://anillahcloset.noscamcoin.org/

## 1. Project Overview

ANILLAH CLOSET is a PHP and MySQL-based fashion shopping website developed to give the business an online presence and make it easier for customers to explore clothing products.

The website focuses on dresses, skirts and other fashion items. Customers can browse the product catalogue, add items to a shopping cart, submit order requests and contact the business for assistance.

## 2. Main Website Features

- **Home Page:** Introduces the business and showcases featured fashion products.
- **Shop Page:** Displays available clothing products for customers to explore.
- **Shopping Cart:** Allows customers to add products, update quantities and remove items.
- **Order Page:** Allows customers to submit product and personal details as an order request.
- **About Us:** Provides information about ANILLAH CLOSET.
- **Style Journal:** Shares fashion inspiration and practical wardrobe advice.
- **Contact Page:** Allows visitors to send enquiries.
- **Admin Area:** Provides an interface for managing products and reviewing customer order requests.

## 3. Technologies Used

- **PHP:** Handles server-side operations and website functionality.
- **MySQL:** Stores product information, customer orders, enquiries and administrator accounts.
- **HTML:** Structures the website pages.
- **CSS:** Controls the website appearance, layout and responsiveness.
- **WAMP Server:** Provides the local development and testing environment.
- **Visual Studio Code:** Used to write and edit project code.
- **GitHub:** Used for source-code hosting and version control.

## 4. Database Structure

The project uses a MySQL database with the following main tables:

- `products` – Stores product names, categories, prices and image paths.
- `orders` – Stores customer order requests and product details.
- `enquiries` – Stores messages submitted through the contact form.
- `admins` – Stores administrator account information.

Database operations use PHP Data Objects (PDO) for communication with MySQL.

## 5. Project Structure

The repository is organised into the following main folders and files:

- `admin/` – Administrator dashboard, product management and order management.
- `assets/` – Website images and design resources.
- `database/` – Database structure and SQL files.
- `includes/` – Shared website components such as headers and footers.
- `index.php` – Homepage.
- `shop.php` – Product catalogue.
- `cart.php` – Shopping cart.
- `orders.php` – Order-request page.
- `about.php` – About Us page.
- `blog.php` – Style Journal.
- `contact.php` – Contact page.

## 6. Running the Project Locally

To run the website using WAMP Server:

1. Install and start WAMP Server.
2. Place the project folder inside the WAMP `www` directory.
3. Create a MySQL database named `anillah_closet`.
4. Import the SQL file from `database/schema.sql` using phpMyAdmin.
5. Configure the database connection details in `config.php`.
6. Open the project in a browser using `http://localhost/your-project-folder/`.

The database connection requires PHP with the PDO MySQL extension enabled.

## 7. Shopping and Order Process

Customers can browse products, select items and submit order requests through the website.

The business reviews the submitted requests and contacts customers to confirm product availability, final pricing, payment and delivery arrangements.

The current project uses an order-request process; it does not include an integrated online payment gateway.

## 8. Version Control

GitHub is used to maintain the project's development history and manage code changes.

The repository includes project files, development commits and a feature branch merged through a pull request.

## 9. Project Purpose

The project demonstrates the development of a dynamic fashion shopping website using PHP and MySQL, together with website design, database management, customer interaction, version control and deployment.
