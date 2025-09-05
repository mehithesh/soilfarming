# 🌱 Soil Farming Agent

## 📌 Project Overview
Soil Farming Agent is a web application built using **PHP + MySQL** that helps users explore soil types, suitable crops, and distributors.  
Admins can manage soil and distributor records, while users can view and search details.

---

## ⚙️ Features
- **Authentication Module**
  - Register, Login, Role-based access (Admin/User)
- **Admin Module**
  - Manage Soil Details (CRUD)
  - Manage Distributor Details (CRUD)
  - View System Logs
- **User Module**
  - View Soil & Distributor details
  - Search & filter by soil type, crops, or location
- **Logging Module**
  - Logs all user/admin actions (login, CRUD, search)
- **Database**
  - MySQL tables: users, soil, distributors, logs

---

## 🗂 Project Structure

soil-farming-agent/
│── config/ # DB connection, logger
│── auth/ # Login, Register, Logout
│── dashboard/ # Admin + User Dashboards
│── database/ # SQL dump

---

## 🛠️ Technologies Used
- **Frontend**: HTML, CSS, JavaScript  
- **Backend**: PHP  
- **Database**: MySQL (phpMyAdmin)  
- **Server**: XAMPP (Apache + MySQL)  

---

## 🚀 Installation Guide
1. Install [XAMPP](https://www.apachefriends.org/index.html)  
2. Copy project folder to `htdocs/`  
3. Start **Apache** & **MySQL** in XAMPP  
4. Import `database/soil_farming.sql` into phpMyAdmin  
5. Visit `http://localhost/soil-farming-agent/auth/login.php`

---

## 👨‍💻 Default Admin Login
```bash
Email: admin@example.com
Password: admin123
