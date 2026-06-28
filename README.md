# 🚀 IndustryX 2026

## Industry Readiness Competition Management System

IndustryX is a web-based Competition Management System developed using **PHP**, **MySQL**, **Bootstrap 5**, **HTML**, **CSS**, and **JavaScript**. The platform enables participants to register, join competitions, submit projects, and track results, while administrators can manage competitions, evaluate submissions, and monitor platform activity through a dedicated dashboard.

The project was built as a full-stack web application to demonstrate practical skills in backend development, database management, authentication, file handling, and dashboard analytics.

## ✨ Features

### 👤 User Features

* User Registration and Login
* Secure Password Authentication
* View Available Competitions
* Register for Competitions
* Submit Projects (PDF/PPT/PPTX/ZIP)
* View Submitted Projects
* Track Project Status
* View Leaderboard

### 👨‍💼 Admin Features

* Admin Login
* Create, Edit and Delete Competitions
* View Registered Participants
* Review Project Submissions
* Approve or Reject Projects
* Assign Scores and Remarks
* Dashboard Analytics
* Activity Logs
* Export Project Data to CSV

### 📊 Dashboard

* Total Users
* Total Competitions
* Total Participants
* Total Projects
* Pending / Approved / Rejected Statistics
* Interactive Charts using Chart.js

### 🔒 Security

* Password Hashing
* Session Management
* File Upload Validation
* File Size Restriction
* Login Authentication

### 📱 User Interface

* Responsive Bootstrap 5 Design
* Professional Dashboard
* Search and Filter Functionality
* Success and Error Alerts


## 🛠️ Technology Stack

| Category        | Technology                           |
| --------------- | ------------------------------------ |
| Frontend        | HTML5, CSS3, Bootstrap 5, JavaScript |
| Backend         | PHP 8                                |
| Database        | MySQL                                |
| Charts          | Chart.js                             |
| Server          | XAMPP (Apache)                       |
| Version Control | Git & GitHub                         |
| IDE             | Visual Studio Code                   |

## 📂 Project Modules

### 👤 User Module

* User Registration
* User Login
* Dashboard
* Competition Registration
* Project Submission
* My Competitions
* My Projects
* Leaderboard

### 👨‍💼 Admin Module

* Admin Login
* Dashboard
* Competition Management
* Participant Management
* Project Review
* Score & Remarks
* Activity Logs
* Analytics

### 🗄️ Database Module

* Users
* Admins
* Competitions
* Competition Registrations
* Projects
* Admin Logs

## ⚙️ Installation & Setup

### Prerequisites

* XAMPP (Apache + MySQL)
* PHP 8 or above
* MySQL
* Visual Studio Code (Recommended)
* Git (Optional)

### Installation Steps

1. Clone or download the repository.
2. Copy the project folder into the `htdocs` directory of XAMPP.
3. Start **Apache** and **MySQL** from the XAMPP Control Panel.
4. Open **phpMyAdmin**.
5. Create a new database named:

```text
industryx_db
```

6. Import the provided SQL file into the database.
7. Update the database connection if required in:

```text
includes/db.php
```

8. Open your browser and visit:

```text
http://localhost/IndustryX
```

9. Register a new participant account or log in using an existing account.

10. Log in as an administrator to manage competitions and review project submissions.

## 📁 Project Structure

```text
IndustryX/
│
├── admin/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── includes/
├── uploads/
├── index.php
├── login.php
├── register.php
├── dashboard.php
├── competitions.php
├── submit_project.php
├── leaderboard.php
├── logout.php
└── README.md
```

## 🗄️ Database Tables

The project uses the following tables:

* admins
* users
* competitions
* competition_registrations
* projects
* admin_logs
