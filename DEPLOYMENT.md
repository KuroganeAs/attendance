# Deployment Guide - Attendance System

This guide will help you deploy the Attendance System to free hosting providers.

## Table of Contents
1. [Render.com (Recommended - Docker-based)](#rendercom-recommended)
2. [000webhost / InfinityFree (Traditional PHP Hosting)](#traditional-php-hosting)
3. [Railway.app (Alternative Docker Option)](#railwayapp)

---

## Render.com (Recommended)

Render.com offers free hosting for Docker containers and databases.

### Prerequisites
- GitHub account
- Render.com account (sign up at https://render.com)

### Step 1: Push to GitHub
1. Create a new repository on GitHub
2. Push your code to GitHub:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
   git push -u origin main
   ```

### Step 2: Create MySQL Database on Render
1. Go to https://dashboard.render.com
2. Click "New +" → "PostgreSQL" (or MySQL if available)
3. **Note**: Render's free tier offers PostgreSQL. If you need MySQL, consider:
   - Using PlanetScale (free MySQL tier)
   - Or use Render's PostgreSQL and update the SQL schema
4. Copy the connection details (host, database name, user, password, port)

### Step 3: Deploy Web Service
1. In Render dashboard, click "New +" → "Web Service"
2. Connect your GitHub repository
3. Configure:
   - **Name**: attendance-system (or your choice)
   - **Environment**: Docker
   - **Region**: Choose closest to you
   - **Branch**: main (or your default branch)
   - **Root Directory**: (leave empty)
   - **Dockerfile Path**: Dockerfile
   - **Docker Context**: (leave empty)

### Step 4: Set Environment Variables
In your Web Service settings, add these environment variables:
- `DB_HOST`: Your database host (from Step 2)
- `DB_NAME`: Your database name
- `DB_USER`: Your database user
- `DB_PASSWORD`: Your database password

### Step 5: Import Database
1. Get your database connection string from Render
2. Use a MySQL client (like MySQL Workbench, phpMyAdmin, or command line) to connect
3. Import the `attendance_system.sql` file

### Step 6: Access Your App
Your app will be available at: `https://your-app-name.onrender.com`

**Note**: Free tier services on Render spin down after 15 minutes of inactivity and take ~30 seconds to wake up.

---

## Traditional PHP Hosting (000webhost / InfinityFree)

These providers offer free PHP hosting with MySQL databases.

### Option A: 000webhost

1. **Sign up** at https://www.000webhost.com
2. **Create a website** and get your hosting details
3. **Upload files**:
   - Use FileZilla or their File Manager
   - Upload all files from `php-login-register/` folder to `public_html/`
4. **Create MySQL Database**:
   - Go to "Databases" in your control panel
   - Create a new MySQL database
   - Note down: host, database name, username, password
5. **Update Configuration**:
   - Edit `config.php` and `Dashboard/dbconnection.php` with your database credentials
6. **Import Database**:
   - Use phpMyAdmin (usually available in control panel)
   - Import `attendance_system.sql`
7. **Set Permissions**:
   - Make sure `Dashboard/profilepics/` folder has write permissions (chmod 755)

### Option B: InfinityFree

1. **Sign up** at https://www.infinityfree.net
2. **Create account** and add a new website
3. **Upload files** via FTP or File Manager:
   - Upload `php-login-register/` contents to `htdocs/`
4. **Create MySQL Database**:
   - Go to "MySQL Databases" in control panel
   - Create database and user
   - Note credentials
5. **Update Configuration**:
   - Edit `config.php` and `Dashboard/dbconnection.php`
6. **Import Database**:
   - Use phpMyAdmin to import `attendance_system.sql`

**Important**: Update these files with your database credentials:
- `php-login-register/config.php`
- `php-login-register/Dashboard/dbconnection.php`

---

## Railway.app

Railway offers free tier with $5 credit monthly.

### Step 1: Install Railway CLI
```bash
npm i -g @railway/cli
```

### Step 2: Login
```bash
railway login
```

### Step 3: Initialize Project
```bash
railway init
```

### Step 4: Add MySQL Service
1. Go to https://railway.app
2. Create new project
3. Add MySQL service
4. Copy connection details

### Step 5: Deploy
```bash
railway up
```

### Step 6: Set Environment Variables
In Railway dashboard, add:
- `DB_HOST`
- `DB_NAME`
- `DB_USER`
- `DB_PASSWORD`

### Step 7: Import Database
Use Railway's MySQL connection to import `attendance_system.sql`

---

## Alternative: PlanetScale + Vercel/Render

For a modern approach:
1. **Database**: Use PlanetScale (free MySQL tier)
2. **Hosting**: Deploy PHP app to Render or Vercel (if they support PHP)

---

## Troubleshooting

### Database Connection Issues
- Verify environment variables are set correctly
- Check database host allows connections from your hosting provider
- Ensure database user has proper permissions

### File Upload Issues
- Make sure `Dashboard/profilepics/` folder has write permissions (755 or 777)
- Check PHP upload limits in php.ini

### Session Issues
- Ensure `session_start()` is called before any output
- Check if your hosting provider supports sessions

---

## Security Notes

⚠️ **Important**: Before deploying to production:
1. Change default database passwords
2. Use strong passwords
3. Enable HTTPS if possible
4. Consider adding CSRF protection
5. Sanitize all user inputs
6. Use prepared statements (already implemented)

---

## Quick Start Commands

### Local Development
```bash
docker-compose up -d
```
Access at: http://localhost:8085

### Check Logs
```bash
docker-compose logs -f
```

### Stop Services
```bash
docker-compose down
```

