-- Lucas Hospital Website Database
-- Import this in phpMyAdmin before hosting/running the project.
-- Database name used by your project may be hospital_db. Change if your inc/config.php uses another name.

CREATE DATABASE IF NOT EXISTS `hospital_db`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `hospital_db`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- USERS: Admin, Doctor, Patient accounts
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(255) NOT NULL,
    `username` VARCHAR(100) DEFAULT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('Admin','Doctor','Patient','Nurse') NOT NULL DEFAULT 'Patient',
    `phone` VARCHAR(50) DEFAULT NULL,
    `gender` VARCHAR(20) DEFAULT NULL,
    `dob` DATE DEFAULT NULL,
    `profile_image` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_email` (`email`),
    KEY `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PATIENT PROFILE TABLE
CREATE TABLE IF NOT EXISTS `patients` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(255) NOT NULL,
    `username` VARCHAR(100) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `gender` VARCHAR(20) DEFAULT NULL,
    `dob` DATE DEFAULT NULL,
    `role` VARCHAR(50) DEFAULT 'Patient',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_patient_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- APPOINTMENTS
CREATE TABLE IF NOT EXISTS `appointments` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `doctor_id` INT UNSIGNED DEFAULT NULL,
    `fullname` VARCHAR(255) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `doctor_name` VARCHAR(255) DEFAULT NULL,
    `department` VARCHAR(255) DEFAULT NULL,
    `appointment_date` DATE DEFAULT NULL,
    `appointment_time` TIME DEFAULT NULL,
    `status` ENUM('Pending','Approved','Rejected','Cancelled') NOT NULL DEFAULT 'Pending',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_appointments_user` (`user_id`),
    KEY `idx_appointments_doctor` (`doctor_id`),
    KEY `idx_appointments_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- NOTIFICATIONS
CREATE TABLE IF NOT EXISTS `notifications` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `title` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `type` VARCHAR(100) DEFAULT NULL,
    `status` ENUM('Unread','Read') NOT NULL DEFAULT 'Unread',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_notifications_user` (`user_id`),
    KEY `idx_notifications_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- EMERGENCY REQUESTS
CREATE TABLE IF NOT EXISTS `emergency_requests` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `fullname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `emergency` TEXT NOT NULL,
    `emergency_type` VARCHAR(255) DEFAULT 'Emergency',
    `message` TEXT DEFAULT NULL,
    `status` ENUM('Pending','Dispatched','Resolved','Cancelled') NOT NULL DEFAULT 'Pending',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_emergency_status` (`status`),
    KEY `idx_emergency_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- CONTACT MESSAGES
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `subject` VARCHAR(255) DEFAULT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- MEDICAL RECORDS
CREATE TABLE IF NOT EXISTS `medical_records` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `patient_name` VARCHAR(255) NOT NULL,
    `patient_email` VARCHAR(255) DEFAULT NULL,
    `doctor_name` VARCHAR(255) DEFAULT NULL,
    `doctor_email` VARCHAR(255) DEFAULT NULL,
    `diagnosis` TEXT DEFAULT NULL,
    `treatment` TEXT DEFAULT NULL,
    `doctor_notes` TEXT DEFAULT NULL,
    `record_date` DATE DEFAULT NULL,
    `visit_date` DATE DEFAULT NULL,
    `status` VARCHAR(100) NOT NULL DEFAULT 'Active',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_records_patient_email` (`patient_email`),
    KEY `idx_records_doctor_email` (`doctor_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PRESCRIPTIONS
CREATE TABLE IF NOT EXISTS `prescriptions` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `patient_name` VARCHAR(255) NOT NULL,
    `patient_email` VARCHAR(255) DEFAULT NULL,
    `doctor_name` VARCHAR(255) DEFAULT NULL,
    `doctor_email` VARCHAR(255) DEFAULT NULL,
    `medication` TEXT DEFAULT NULL,
    `dosage` TEXT DEFAULT NULL,
    `instructions` TEXT DEFAULT NULL,
    `prescription_date` DATE DEFAULT NULL,
    `status` VARCHAR(100) NOT NULL DEFAULT 'Active',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_prescriptions_patient_email` (`patient_email`),
    KEY `idx_prescriptions_doctor_email` (`doctor_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PASSWORD RESET OTP CODES
CREATE TABLE IF NOT EXISTS `password_resets` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `code` VARCHAR(10) NOT NULL,
    `expires_at` DATETIME NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_password_resets_email` (`email`),
    KEY `idx_password_resets_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- DOCTOR SCHEDULES
CREATE TABLE IF NOT EXISTS `doctor_schedules` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `doctor_id` INT UNSIGNED NOT NULL,
    `available_date` DATE NOT NULL,
    `start_time` TIME NOT NULL,
    `end_time` TIME NOT NULL,
    `status` VARCHAR(100) NOT NULL DEFAULT 'Available',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_schedule_doctor` (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional old admins table, only needed if any old file still uses it.
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_admin_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create a default admin account manually after import.
-- Generate password hash with PHP:
-- echo password_hash('your-password', PASSWORD_DEFAULT);
-- Then run:
-- INSERT INTO users (fullname, username, email, password, role)
-- VALUES ('System Admin', 'admin', 'admin@example.com', 'PASTE_HASH_HERE', 'Admin');

