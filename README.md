# ClientConnect-CRM

ClientConnect CRM is a web application designed to help businesses manage their customer relationships effectively. The application allows users to store and manage customer information, track interactions, streamline communication, provide a helpdesk ticketing system for managing customer issues, and generate reports for customers and tickets. This project will provide a solid foundation for understanding Laravel's capabilities while creating a functional CRM system.

## Features

- User authentication (registration and login)
- Dashboard for viewing and tracking customer interactions
- Customer records management 
- Ticket management system for handling customer inquiries
- Report generation for tracking performance metrics

## Installation

To set up the ClientConnect CRM on your local machine, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/hffzaaa/ClientConnect-CRM.git
   cd ClientConnect-CRM
2. **Install dependencies (if not installed yet)**:
    ```bash
   composer install
3. **Set up environment**:
    ```bash
   cp .env.example .env
4. **Generate application key**:
    ```bash
   php artisan key:generate
5. **Set up database**:
    ```bash
   php artisan migrate
6. **Run application**:
    ```bash
   php artisan serve

## Usage

Access the application at http://localhost:8000 and register yourself. After registring or logging in, users can access the following functionalities:
- Dashboard: View customer interactions and overall statistics
- Customer Management: CRUD customer records
- Interaction Tracking: CRUD interactions with customers
- Helpdesk Ticketing: CRUD and track tickets/issues
- Report Generation: Generate reports for customers and tickets in CSV and PDF formats

## Libraries

This project utilizes the following libraries:
- Laravel: PHP framework
- Laravel Excel: Handling Excel imports and exports
- Dompdf: Generate PDF reports

## Assignment Requirements
I am pleased to state that I have completed all the requirements for this project, except for the "User Roles and Permissions" functionality due to an unresolved error. I will continue to work on this feature and update the code to ensure it runs smoothly.

Hafizatul A'fifah
