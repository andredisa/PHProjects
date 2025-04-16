# Product Management Web App

This project is a simple web application developed in PHP, HTML, JavaScript, and MySQL, with AJAX support and email sending capabilities. It allows users to register, activate their account via email, log in, and interact with a list of products (add, edit, delete, and purchase).

## 🔧 Main Features

### 👤 User Management
- **Registration**: the user enters an email and password. They receive an activation link via email.
- **Activation**: the link (`activate.php`) enables the account.
- **Login**: access to the product section.
- **Logout**: session removal.

### 📦 Product Management
- **View**: product list available to all authenticated users.
- **Filter**: products can be filtered by category/type.
- **Add / Edit / Delete**: only the administrator can manage the catalog.
- **Purchase**: users can purchase a product, decreasing its quantity.

---

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript, jQuery
- **Backend**: PHP 8+
- **Database**: MySQL
- **Email**: PHPMailer for sending activation links
- **AJAX**: asynchronous request handling (login, product filtering, CRUD operations)

---

## ⚙️ Requirements

- Web server with PHP support (e.g., XAMPP, MAMP)
- MySQL Server
- Access to an SMTP service for sending emails

---

## 🧪 Project Setup

1. Clone the project or extract the ZIP archive.
2. Import the `preverifica` database (likely found in the `/db` folder or to be created manually).
3. Configure database connection parameters in `GestioneUtenti.php`, `GestioneProdotti.php`, etc.
4. Start your local server (e.g., Apache).
5. Access the app via `http://localhost/index.html`.

---

## 📬 Email Configuration

Make sure you have:
- An SMTP account (Gmail, Outlook, etc.)
- Configure `EmailMaster.php` with:
  ```php
  $mail->isSMTP();
  $mail->Host = 'smtp.yourserver.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'your@email.com';
  $mail->Password = 'yourpassword';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

---

## 🔐 Authentication & Security
- Access to features is protected using `session_start()` and `idUser` checks.
- Sensitive data (e.g., passwords) should be hashed before being saved (to be implemented).

---

## 📌 Additional Notes
- Queries are handled via classes in the `/classes` folder.
- AJAX logic improves the user experience by making the site more responsive.
- The code can be extended to manage multiple roles, order history, dashboards, and more.

---

## ✅ FUTURE TODOs
- Improve server-side validation
- Add pagination or advanced search
- Product image uploads
- Purchase history per user

---

### 👨‍💻 Happy coding and have fun exploring APIs with Python!