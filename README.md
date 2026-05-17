# Elysian - Wedding & Event Planning Dashboard

Elysian is a comprehensive, full-stack event management platform designed to streamline the chaotic process of planning weddings and large events. Built with elegance and usability in mind, it provides planners with the ultimate toolkit to manage guests, coordinate vendors, and keep track of budgets within a seamless, premium dashboard.

## 🚀 Key Features

*   **Guest Management:** Effortlessly organize your guest list, track RSVPs in real-time, and manage +1s to ensure everyone is accommodated flawlessly.
*   **Budget Tracking:** Keep your finances in check with comprehensive budget tools. Know exactly where every dollar is going without relying on messy spreadsheets.
*   **Vendor Coordination:** Discover, filter, and coordinate with top-tier local vendors including photographers, luxury venues, florists, and gourmet caterers.
*   **Secure Authentication:** Robust user registration and login system with strict password policies (checking against known data breaches) and secure session management.
*   **Premium UI/UX:** A bespoke, glassmorphism-inspired interface featuring dynamic animations, an editorial split-screen layout, and a highly engaging landing page.

## 🛠️ Technology Stack

*   **Backend:** Laravel 12 (PHP)
*   **Database:** SQLite (Standard SQL Eloquent ORM)
*   **Frontend:** HTML5, Blade Templating, Vanilla CSS (No heavy UI frameworks)
*   **Design Elements:** Custom CSS variables, Glassmorphism, Google Fonts (`Outfit` & `Playfair Display`), thin-line SVGs.

## ⚙️ How to Run Locally

1. **Clone the repository** (if you haven't already).
2. **Install PHP Dependencies:**
   ```bash
   composer install
   ```
3. **Set up your environment file:**
   Duplicate `.env.example` to `.env` and ensure your database connection is set to SQLite:
   ```env
   DB_CONNECTION=sqlite
   ```
4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```
5. **Run Database Migrations & Seeders:**
   This will construct the database tables and populate the Vendor directory with dummy data.
   ```bash
   php artisan migrate:fresh --seed --seeder=VendorSeeder
   ```
6. **Start the Development Server:**
   ```bash
   php artisan serve
   ```
7. **Visit the App:**
   Open your browser and navigate to `http://127.0.0.1:8000`.

## 👨‍💻 Developer

Developed and designed by **Nabajyoti Kalita**.

## 👥 Collaborators

*   **Juhi-Th**
*   **Rohit Kumar** (@RohitKumar798)

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
