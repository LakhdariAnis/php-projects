# Ma Clinique — Medical Appointment Booking

Web app for a medical clinic. Patients book an appointment online, get a ticket number, and track or cancel it. Doctors log in to a dashboard to approve, cancel and follow their appointments, and chat with patients.

Built in 2025 as a two-person freelance project for a client.

## Features

- **Booking**: pick a specialization, a doctor and a free time slot (slots load with AJAX).
- **Ticket + tracking**: each booking gets a number; patients check status or cancel with it.
- **Doctor dashboard**: today / tomorrow / all appointments, approve or cancel, date-range reports, search, profile, change password.
- **Patient–doctor chat**: real-time chat through a Node.js Socket.IO server, with a PHP fallback API.
- **AI assistant**: chat widget that answers clinic questions with a local LLM (Ollama, `api/local-ai.php`).
- **JSON REST API** (`api/`): book, cancel, list doctors, specializations, slots, appointments. See `chat docs.txt`.
- **Languages**: English, French and Arabic (with right-to-left layout).
- **Contact form**: sends email through PHPMailer + Gmail SMTP.

## Stack

PHP 8 (PDO, prepared statements), MySQL / MariaDB, JavaScript + jQuery + Bootstrap, Node.js + Socket.IO, PHPMailer, Ollama.

The doctor panel was started from the open-source "Doctor Appointment Management System" (DAMS) starter and then extended. The public site, booking flow, API, chat, AI widget and translations were added on top.

## Run with Docker

From the repository root: `docker compose up -d --build`, then open http://localhost:8080/clinic-booking/.

## Run locally (XAMPP)

1. Copy the folder to `htdocs/`.
2. In phpMyAdmin, create the database `damsmsdb` and import `damsmsdb.sql` (and `demo-data.sql` for sample appointments).(and `demo-data.sql` for sample appointments).
3. Copy `includes/mail-config.example.php` to `includes/mail-config.php` and fill in a Gmail App Password (only needed for the contact form).
4. Open `http://localhost/clinic-booking/`.
5. Doctor login: `doctor/login.php`. Demo doctors use the password `1234` (for example `mohamed@example.com`).
6. Optional real-time chat: `npm install && npm start`.
7. Optional AI widget: run Ollama on `localhost:11434`.

## Security notes

- Passwords are hashed with `password_hash()` / `password_verify()`.
- All SQL uses PDO prepared statements.
- Endpoints that return patient data require a doctor session.
- Known limit: "forgot password" resets with email + phone number only. A production version needs an emailed reset link.
