# Job Portal Website

A **Job Portal web application** built with **Laravel 12**, **Inertia.js v2**, and **Vue 3**.  
The system includes **three user roles**:  
- **Admin** – manages users, job posts, categories, and settings.  
- **Company** – can create and manage job posts.  
- **Jobseeker** – can browse jobs, apply, and manage their profile.  

---

## ✨ Features
- Authentication with email verification (emails pushed to **queue**).  
- Role-based access: **Admin, Company, Jobseeker**.  
- Job posting and application system.  
- Seeders for:
  - Admin account  
  - Job Types  
  - Governorates  
  - Job Categories  
- Frontend built with **Vue 3 + Inertia.js**.  
- Backend powered by **Laravel 12**.  

---

## 🛠️ Installation & Setup

Follow these steps to run the project locally.

### 1. Clone the Repository
```bash
git clone https://github.com/Elraih/jobs-websit.git
cd job-portal
```

### 2. Backend Setup (Laravel 12)
```bash
    composer install
    cp .env   
    php artisan key:generate
```

### 3. Database Setup
    - Configure your `.env` file with DB credentials, and mail.
    - Then run:
```bash
php artisan migrate 
```

### 4. DB seed
```bash
php arisan db-seed
```

### 5. Frontend Setup (Vue 3 + Inertia)
```bash

npm install
npm run dev
```


### 5. Queue Setup (for sending emails)
```bash
php artisan queue:work

```











