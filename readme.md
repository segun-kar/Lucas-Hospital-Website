# Lucas Hospital Management System

A modern Hospital Management System developed using PHP, MySQL, HTML, CSS, JavaScript, Tailwind CSS, and Font Awesome.

The system helps hospitals manage patients, doctors, appointments, prescriptions, medical records, notifications, and emergency requests efficiently.

---

# Features

## Patient Features
- Patient Registration & Login
- Book Appointments
- View Medical Records
- View Prescriptions
- Notifications System
- Profile Management
- Emergency Requests
- Forgot Password System
- Responsive Dashboard

## Doctor Features
- Doctor Login
- Manage Appointments
- Approve/Reject Appointments
- Create Prescriptions
- Add Medical Records
- Manage Schedule
- View Notifications
- Search & Filter Patients
- Responsive Dashboard

## Admin Features
- Manage Patients
- Manage Doctors
- Manage Appointments
- Manage Prescriptions
- Manage Medical Records
- View Messages
- Emergency Monitoring
- Notifications System
- Dashboard Analytics
- Profile Management

---

# Technologies Used

- PHP
- MySQL
- HTML5
- Tailwind CSS
- JavaScript
- Font Awesome
- Chart.js
- XAMPP

---

# Project Structure

```bash
Lucas-hospital-website/
│
├── assets/
├── uploads/
│   └── profile/
├── inc/
│   ├── config.php
│   ├── header.php
│   └── notify-admin.php
│
├── index.php
├── login.php
├── register.php
├── settings.php
├── appointments.php
├── notifications.php
│
├── patient-dashboard.php
├── doctor-dashboard.php
├── admin-dashboard.php
│
├── doctor-prescriptions.php
├── doctor-medical-records.php
├── doctor-schedule.php
│
├── admin-users.php
├── admin-appointments.php
├── admin-prescriptions.php
├── admin-medical-records.php
│
└── README.md
```

---

# Installation Guide

## Step 1
Install:
- XAMPP

---

## Step 2
Move project folder to:

```bash
C:\xampp\htdocs\
```

---

## Step 3
Start:
- Apache
- MySQL

from XAMPP Control Panel.

---

## Step 4
Open phpMyAdmin:

```bash
http://localhost/phpmyadmin
```

---

## Step 5
Create database:

```bash
lucas_hospital
```

---

## Step 6
Import SQL database file.

---

## Step 7
Update database connection inside:

```bash
inc/config.php
```

Example:

```php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "lucas_hospital"
);
```

---

## Step 8
Run project:

```bash
http://localhost/Lucas-hospital-website
```

---

# Default Roles

- Admin
- Doctor
- Patient

---

# Main Modules

## Authentication
- Login
- Register
- Forgot Password
- Logout

## Appointment Management
- Book Appointment
- Approve/Reject Appointment
- Appointment Notifications

## Notification System
- Real-time Notification Counter
- Read/Unread Notifications
- Admin Notifications

## Medical Records
- Add Records
- View Records

## Prescription System
- Add Prescription
- View Prescription

## Emergency System
- Emergency Request Submission
- Emergency Monitoring

---

# Responsive Design

The system is mobile-friendly and optimized for:
- Desktop
- Tablet
- Mobile Devices

---

# UI Design

The project uses a modern healthcare-inspired UI with:
- Dark Mode Layout
- Glassmorphism Cards
- Cyan & Teal Medical Theme
- SVG Icons
- Interactive Dashboards

---

# Future Improvements

- Email Notifications
- Live Chat
- Video Consultation
- AI Medical Assistant
- Payment Gateway
- Ambulance Tracking

---

# Screenshots

## Home Page
- Modern hospital landing page
- Hero section
- Services section
- Doctors section
- Testimonials
- Emergency CTA

## Dashboards
- Patient Dashboard
- Doctor Dashboard
- Admin Dashboard

## Appointment System
- Appointment booking
- Approval system
- Appointment tracking

## Notification System
- Real-time notification badges
- Read/Unread notifications

---

# Database Tables

Main tables used in the system:

```sql
users
appointments
prescriptions
medical_records
notifications
doctor_schedules
contact_messages
emergency_requests
```

---

# Security Features

- Session Authentication
- Role-Based Access Control
- SQL Injection Protection
- Protected Dashboards
- Secure Password Handling

---

# Notification Workflow

## Patient Notifications
Patients receive notifications when:
- Appointment is approved
- Appointment is rejected
- Prescription is added
- Medical record is updated

## Doctor Notifications
Doctors receive notifications when:
- New appointment is booked
- Schedule is updated

## Admin Notifications
Admins receive notifications for:
- New registrations
- New appointments
- Emergency requests
- New prescriptions
- Medical records
- Contact messages

---

# Dashboard Analytics

The admin dashboard includes:
- Total Patients
- Total Doctors
- Total Appointments
- Total Records
- Total Prescriptions
- Total Messages

Charts are powered using:

```text
Chart.js
```

---

# Mobile Responsiveness

The project supports:
- Responsive navigation
- Mobile dashboard layout
- Responsive tables
- Adaptive cards
- Flexible grid system

---

# UI Components

## Components Used
- Sidebar Navigation
- Statistic Cards
- Notification Badges
- Data Tables
- Profile Cards
- Charts
- Glassmorphism Panels

---

# Challenges Faced During Development

- Dashboard role management
- Notification system implementation
- Appointment filtering
- Responsive design optimization
- Dark mode compatibility
- Profile image management

---

# Learning Outcomes

This project helped improve understanding of:
- PHP Backend Development
- MySQL Database Design
- Authentication Systems
- CRUD Operations
- Dashboard Design
- Responsive Web Design
- Notification Systems
- Session Management

---

# Conclusion

The Lucas Hospital Management System is a complete healthcare management solution designed to simplify hospital operations through modern web technologies.

The project demonstrates practical implementation of:
- Full-stack web development
- Database integration
- Authentication systems
- Administrative management
- Responsive healthcare UI design

This project is suitable for:
- Academic submission
- Portfolio projects
- PHP/MySQL learning
- Hospital management demonstrations

---

# Author Information

## Developer Details

Name: Abolade Jerry Segun

Role:
- Full Stack Developer
- Computer Science Student
- Software Engineering Enthusiast
- Cybersecurity Enthusiast

---

# Acknowledgements

Special thanks to:
- PHP Documentation
- MySQL Documentation
- Tailwind CSS
- Font Awesome
- Chart.js
- XAMPP

for providing tools and resources used during development.

---

# Recommended System Requirements

## Minimum Requirements

- Windows 10/11
- XAMPP
- PHP 8+
- MySQL 5+
- Modern Web Browser
- 4GB RAM

---

# Browser Support

Supported browsers:
- Google Chrome
- Microsoft Edge
- Mozilla Firefox
- Opera

---

# Known Issues

- Email reset password may require SMTP setup
- Some dashboards may require additional mobile optimization
- Notification refresh is manual (page reload)

---

# Future Scope

Future versions may include:
- Online Payment Integration
- AI Appointment Assistant
- SMS Notifications
- Telemedicine Support
- Live Chat System
- Medical Report PDF Export
- Doctor Availability Tracking
- Multi-Hospital Support

---

# API & Integrations (Future)

Potential integrations:
- Paystack
- Flutterwave
- Twilio SMS
- Google Maps API
- Email SMTP Services

---

# Setup Troubleshooting

## Database Connection Error

If you see:

```text
Unknown database
```

Make sure:
- MySQL is running
- Database name is correct
- SQL file has been imported

---

## Image Upload Issues

Make sure:
- `uploads/profile/` exists
- Folder permissions allow uploads
- Image path is saved correctly in database

---

## XAMPP Apache Error

If Apache fails to start:
- Change Apache port
- Stop conflicting applications
- Run XAMPP as Administrator

---

# Project Status

Current Status:

```text
Completed & Functional
```

Modules Completed:
- Authentication
- Appointment System
- Notification System
- Prescription System
- Medical Records
- Emergency Requests
- Responsive UI
- Dashboard Analytics

---

# Contact

For educational or collaboration purposes:

Email:
```text
segunjayrich@gmail.com
```

GitHub:
```text
@segunjayrich
```

---

# Final Note

This project was developed as an educational hospital management platform to demonstrate practical software engineering concepts using PHP and MySQL.

The system combines:
- Modern UI/UX
- Backend Logic
- Database Management
- Authentication
- Dashboard Analytics
- Real-world Hospital Features

Thank you for viewing the project.

---