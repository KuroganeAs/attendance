# Quick Start - Deploy to Render.com (Easiest Method)

## Step-by-Step Guide

### 1. Push Your Code to GitHub
```bash
# If you haven't already
git init
git add .
git commit -m "Ready for deployment"
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
```

### 2. Sign Up for Render
- Go to https://render.com
- Sign up with your GitHub account (easiest)

### 3. Create Database
1. In Render dashboard, click **"New +"** → **"PostgreSQL"**
   - **Note**: Render free tier has PostgreSQL. For MySQL, use PlanetScale (free) or see alternative options below
2. Name it: `attendance-db`
3. Copy the **Internal Database URL** (you'll need this)

### 4. Deploy Web Service
1. Click **"New +"** → **"Web Service"**
2. Connect your GitHub repository
3. Render will auto-detect the Dockerfile
4. Click **"Create Web Service"**

### 5. Configure Environment Variables
In your web service settings, go to **"Environment"** tab and add:

```
DB_HOST=your-database-host-from-render
DB_NAME=attendance_system
DB_USER=your-database-user
DB_PASSWORD=your-database-password
```

**To get these values:**
- Click on your database service in Render
- Look at the "Connections" section
- Extract host, database name, user, and password from the connection string

### 6. Import Database Schema
1. Get database connection details from Render
2. Use a database client (like DBeaver, MySQL Workbench, or command line)
3. Connect to your database
4. Import `attendance_system.sql`

**Quick MySQL import via command line:**
```bash
mysql -h YOUR_HOST -u YOUR_USER -p YOUR_DATABASE < attendance_system.sql
```

### 7. Access Your App
Your app will be live at: `https://your-app-name.onrender.com`

---

## Alternative: Use PlanetScale for MySQL (Free)

If you need MySQL specifically:

1. **Sign up** at https://planetscale.com (free tier available)
2. **Create database**: `attendance_system`
3. **Get connection string** from PlanetScale dashboard
4. **Update environment variables** in Render with PlanetScale credentials
5. **Import SQL** using PlanetScale's web console or CLI

---

## Alternative: Traditional PHP Hosting (No Docker)

If you prefer traditional hosting:

### 000webhost (Free)
1. Sign up: https://www.000webhost.com
2. Upload files from `php-login-register/` folder to `public_html/`
3. Create MySQL database in control panel
4. Update `config.php` and `Dashboard/dbconnection.php` with database credentials
5. Import `attendance_system.sql` via phpMyAdmin

### InfinityFree (Free)
1. Sign up: https://www.infinityfree.net
2. Upload files to `htdocs/`
3. Create MySQL database
4. Update config files
5. Import database

---

## Troubleshooting

**App shows "DB Connection failed"**
- Check environment variables are set correctly
- Verify database is running
- Check database host allows connections

**File uploads not working**
- Ensure `Dashboard/profilepics/` folder has write permissions
- Check PHP upload limits

**App is slow to load**
- Render free tier spins down after 15 min inactivity
- First request takes ~30 seconds to wake up
- Consider upgrading to paid tier for always-on

---

## Need Help?

Check the full deployment guide in `DEPLOYMENT.md` for detailed instructions.

