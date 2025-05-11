# 🌐 Admin Dashboard & Complaint Management System

Welcome to a powerful and modern **Admin Dashboard & Complaint Management System** built with **PHP**, **MySQL**, **Bootstrap 5**, and **Chart.js**. This system is designed for organizations to efficiently manage user complaints, monitor activity, and visualize reports with a clean and responsive UI.

---

## 📸 Dashboard Preview

![Dashboard Screenshot](screenshots/dashboard-preview.png)

---

## 🚀 Key Highlights

✨ **Intuitive Interface** – Modern, mobile-friendly design powered by Bootstrap 5.  
📈 **Data Visualizations** – Real-time stats with Chart.js & DataTables.  
🔒 **Secure** – Role-based access, CSRF protection, hashed passwords.  
🧩 **Modular Codebase** – Clean file structure for easy maintenance & extension.  


---

## ⚙️ Features Overview

### 🧑‍💼 User Access Control

* Secure Login & Logout
* Admin / Sub-admin / Regular User Roles
* Session-based Authentication

### 📝 Complaint Management

* Submit, Track, Update, and Resolve Complaints
* Filter by Category and Status (Pending, In-Process, Resolved)
* Staff Assignment & Tracking

### 📊 Interactive Dashboard

* Complaint statistics & activity feed
* Charts: Category breakdown, Monthly stats
* System health & uptime status

### 👥 User Management

* Create & Edit Profiles
* User Activity Logs
* Bulk Operations (Delete, Assign, etc.)

---

## 📁 Project Structure

```
complaint-management-system/
├── assets/               # CSS, JS, Images
├── database/             # SQL files
├── includes/             # PHP core (auth, config, functions)
├── screenshots/          # UI previews
├── dashboard.php         # Admin panel homepage
├── complaints.php        # Complaint tracking module
├── users.php             # Manage users
└── README.md             # This file
```

---

## 🛠️ Installation Guide

### 📋 Requirements

* PHP >= 7.4
* MySQL >= 5.7
* Apache or Nginx
* Composer (Optional but recommended)

### 🧰 Setup Steps

1. **Clone Repository**

```bash
git clone https://github.com/NaolMeseret/complaint-management-system.git
cd complaint-management-system
```

2. **Database Setup**

* Create MySQL database (e.g., `complaint_system`)
* Import: `database/schema.sql`

3. **Configure PHP**
   Edit `includes/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'complaint_management');
```

4. **Set Up Web Server**

* Point DocumentRoot to project root
* Enable mod\_rewrite (Apache)

5. **Login Credentials**

* Admin: `admin@example.com / admin123`
* User: `user@example.com / user123`

---

## 🧪 Tech Stack

| Layer    | Technology              |
| -------- | ----------------------- |
| Frontend | Bootstrap 5, Chart.js   |
| Backend  | PHP (OOP), MySQL        |
| Security | Sessions, CSRF, Hashing |
| Tools    | DataTables, PHPMailer   |

### 🔗 Composer Dependencies

```json
{
  "require": {
    "phpmailer/phpmailer": "^6.6"
  }
}
```

---


