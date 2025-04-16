# 🎵 Music Catalog Management System (SIAE-Inspired)

> This project is a web-based application for managing a music catalog that simulates the functionality of a **SIAE** `(Italian Authors and Publishers Association)` database. It allows users to view **albums** and **songs**, and gives authorized users access to tools for **managing albums** and **tracks** via a secure login.

---

## 🚀 Features

### 👤 Public Features
- Browse a list of albums and their authors.
- View album details and a list of songs.
- Access direct links to listen to songs on YouTube.

### 🔐 Authenticated Features
- Login via access code.
- Add new albums (with title, author, and cover).
- Remove albums by ID.
- Edit album titles.
- Add, remove, and rename songs linked to albums.

## 🗂️ File Structure

```bash
/
├── index.php                   # Homepage - shows albums and access to login
├── pagine/
│   ├── album.php               # Displays songs of a selected album
│   ├── login.php               # Login page using access code
│   └── autenticazione.php      # Admin dashboard for managing albums and songs
├── gestione/
│   ├── _cred.php               # Database credentials
│   ├── GestioneAlbum.php       # Album management logic and forms
│   └── gestioneCanzone.php     # Song management logic
├── imgs/                       # Folder containing album cover images
```

---

## 🧠 Technologies Used
- **PHP** for backend and session handling

- **MySQL** for the relational database

- **Bootstrap 4** for responsive UI

- **HTML/CSS** for structure and styling

- **YouTube** for song links

---

## 🛡️ Authentication
> Access to album/song management requires an access code that matches a value stored in the Autore table (Codice field). Upon login, session variables are used to track authentication.

---

## 💽 Database Schema Overview
**Autore**: `Author info, including ID_Autore, NomeArte, Codice`

**Album**: `Linked to Autore, contains Titolo, Copertina, ID_Autore`

**Canzone**: `Linked to Album, contains Titolo, Durata, Link`

---

## 📸 Screenshots
**Public Album Catalog:**

`Shows a card layout of albums with cover, author, and link to songs.`

**Album View:**

`Lists songs with title, duration, and YouTube button.`

**Admin Panel:**

`Forms for adding, removing, and editing albums and songs.`

---

## 🔧 Setup Instructions
1. **Clone** or **download** the project files.

2. Set up your **MySQL database** with the required tables and test data.

3. Fill out your **database credentials** in `gestione/_cred.php`:

```php
$host = "localhost";
$db_username = "your_username";
$db_password = "your_password";
$db = "your_database";
```

> Ensure imgs/ contains appropriate album cover images.

> Run the project on a local server (e.g., XAMPP or MAMP) or deploy on a live server.

## 🔐 Admin Access Example
To access the admin panel:

```yaml
Go to /pagine/login.php

Enter a valid Codice from the Autore table.

Upon success, you’ll be redirected to /pagine/autenticazione.php.
```

---

## 📦 Future Improvements
- Add **user registration** and role-based **permissions**

- Use prepared statements for all SQL queries (some are currently vulnerable)

- Add **image upload** support for album covers

- Improve song **metadata** (duration, genre, etc.)

- Add **search** and **filtering** to album and song lists

---

## 📄 License
> This project is for educational and demonstration purposes only. Not intended for production use.

---

### 👨‍💻 Happy coding and have fun exploring APIs with Python!
