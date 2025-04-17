# 🎯 PHP Projects Showcase

> A collection of PHP web applications built to demonstrate **real-world web development** concepts like **authentication**, **CRUD operations**, **AJAX**, **email handling**, and **database interaction**.

![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue?logo=php)  ![MySQL](https://img.shields.io/badge/MySQL-Relational%20DB-blue?logo=mysql)  ![AJAX](https://img.shields.io/badge/AJAX-Enabled-ff69b4?logo=ajax)  ![Bootstrap](https://img.shields.io/badge/Bootstrap-4-purple?logo=bootstrap)  ![License](https://img.shields.io/badge/License-MIT-lightgrey)

---

## 📁 Repository Overview

This folder contains **two PHP-based projects**:

- 🎵 A **Music Catalog System** inspired by SIAE for managing songs and albums
- 📦 A **Product Management App** with user registration and email-based activation

---

## 📂 Folder Structure
```bash
/PHProjects/
├── Siae/               # Project 1: SIAE-style music catalog system
├── gestProdotti_ajax/      # Project 2: Product management with login & email
└── README.md   
```
---

## 🎵 Project 1: Music Catalog Management System (SIAE-Inspired)

> 🎼 A dynamic web application that mimics a simplified **SIAE-style** archive, allowing users to browse and manage a music catalog of albums and songs.

### ✨ Key Features
- 📚 **Browse** a public catalog of albums and their authors
- 🎧 **View** song details and listen via embedded **YouTube** links
- 🔐 **Login** with a unique access code for authenticated operations
- 🛠️ **Admin Panel** to manage (add/edit/delete) albums and songs

### 🧰 Tech Stack
- 🐘 **PHP** for backend logic and session management
- 🗃️ **MySQL** for relational data storage
- 🎨 **Bootstrap 4**, HTML & CSS for responsive design
- 🔗 **YouTube** integration for audio previews

> 📖 For more details, see `Siae/README.md` or jump into `Siae/index.php`.

---

## 📦 Project 2: Product Management Web App

> 🛒 A user-focused PHP application for managing product catalogs and user accounts — including **email-based registration & activation**, **AJAX interactivity**, and secure sessions.

### ✨ Key Features
- ✉️ **User registration** with email confirmation
- 🔑 **Secure login/logout** with session handling
- 📬 **Email activation** via link using `PHPMailer`
- 🗃️ **Product catalog** with filtering and category sorting
- 🛠️ **Admin dashboard** for catalog CRUD (Create, Read, Update, Delete)
- 🛍️ **Purchase system** that decrements product quantity

### 🧰 Tech Stack
- 🐘 **PHP 8+**
- 🗃️ **MySQL** (products, users, transactions)
- 🎨 **HTML**, **CSS**, **JavaScript**, **jQuery**
- ⚡ **AJAX** for smoother UX and faster operations
- 📬 **PHPMailer** to send verification links

> 📖 For more details, explore `gestProdotti_ajax/README.md`.

---

## ⚙️ Shared Requirements

Make sure you have the following tools/services installed:

| 🛠️ Requirement       | ✅ Needed For                             |
|----------------------|-------------------------------------------|
| 🌐 Web Server         | All projects (Apache via XAMPP, MAMP, etc.) |
| 🐘 PHP 7.4+ / 8+      | Depending on the project                   |
| 🗃️ MySQL              | To manage relational data                 |
| 📧 SMTP Account       | 📦 Project 2 – for sending emails         |

---

## 🎯 Learning Objectives

These projects aim to teach and reinforce:

- 🧱 Designing and connecting **relational databases**
- 🔐 Implementing **authentication and session security**
- 💻 Building responsive and interactive frontends
- ⚙️ Handling full **CRUD operations**
- ⚡ Enhancing user experience with **AJAX** interactivity
- ✉️ Integrating **email flows** (account activation)

---

## 🚀 Future Improvements

Here’s what’s planned or recommended for future versions:

- 🔒 Use of **prepared statements** for secure SQL queries
- 🖼️ Add **image upload support** for both projects
- 🧾 Implement **purchase history** tracking for users
- 📊 Create **dashboard views** for admin/stats
- 🔍 Advanced **search**, filtering & **pagination**

---

## 👨‍💻 About the Author

> These applications were created for **educational and demonstration purposes only**.  
I welcome your feedback, contributions, or collaboration ideas!

💬 Feel free to reach out on [GitHub](https://github.com/andredisa) or by [email](mailto:andreadisanti22@gmail.com)!

---

### 🧑‍💻✨ Happy coding and enjoy exploring real-world PHP applications!
