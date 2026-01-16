# Taskflow: Enterprise Task Management 🚀

[![PHP Quality Check](https://github.com/WAGHMARETANNU/taskflow/actions/workflows/php-ci.yml/badge.svg)](https://github.com/WAGHMARETANNU/taskflow/actions/workflows/php-ci.yml)

A robust task management system engineered with the Laravel framework, focusing on secure data handling, architectural integrity, and role-based access control (RBAC).

## 🛠️ Technical Stack
- [cite_start]**Framework:** PHP Laravel (MVC Architecture) [cite: 76]
- [cite_start]**Database:** MySQL [cite: 71, 91]
- [cite_start]**Frontend:** Blade Templating, Bootstrap [cite: 100]
- **CI/CD:** GitHub Actions (Automated Syntax & Quality Checks)

## 🚀 Core Features
- [cite_start]**Role-Based Access Control (RBAC):** Implemented granular permissions to ensure users only access authorized tasks and data[cite: 77].
- [cite_start]**Secure Authentication:** Built robust user login and registration systems using Laravel's native security features[cite: 77].
- [cite_start]**CRUD Life-cycle:** Full management of tasks and categories with structured backend logic[cite: 77].
- [cite_start]**Responsive Interface:** Optimized UI with mobile-friendly layouts for seamless navigation[cite: 14].

## ⚙️ Engineering Standards
- [cite_start]**MVC Architecture:** Separation of concerns between logic (Controllers), data (Models), and presentation (Views) for high maintainability[cite: 76, 77].
- **Database Migrations:** Version-controlled schema to ensure consistency across development environments.
- **Automated Testing:** Integrated GitHub Actions to perform PHP syntax checks (linting) on every push to maintain code health.

## 📦 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/WAGHMARETANNU/taskflow.git](https://github.com/WAGHMARETANNU/taskflow.git)
   cd taskflow

```

2. **Install dependencies:**
```bash
composer install

```

3. **Configure Environment:**
* Copy `.env.example` to `.env`
* Run `php artisan key:generate`

4. **Run Migrations:**
```bash
php artisan migrate



