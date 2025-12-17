# Deployment Guide - Vercel

This guide will help you deploy the Attendance System to Vercel.

## Prerequisites
- GitHub account
- Vercel account (sign up at https://vercel.com)
- MySQL database (use PlanetScale free tier or another MySQL provider)

## Step 1: Set Up Database

1. **Create a MySQL database**:
   - Option A: Use [PlanetScale](https://planetscale.com) (free MySQL tier)
   - Option B: Use any MySQL hosting provider (e.g., Railway, Render, or Aiven)

2. **Import the database schema**:
   - Connect to your MySQL database
   - Import the `attendance_system.sql` file using MySQL client or phpMyAdmin

3. **Note down your database credentials**:
   - Host
   - Database name
   - Username
   - Password
   - Port (usually 3306)

## Step 2: Push to GitHub

1. Create a new repository on GitHub
2. Push your code to GitHub:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
   git push -u origin main
   ```

## Step 3: Deploy to Vercel

1. Go to https://vercel.com and sign in
2. Click "Add New..." → "Project"
3. Import your GitHub repository
4. Configure the project:
   - **Framework Preset**: Other
   - **Root Directory**: `php-login-register` (or leave empty if root)
   - **Build Command**: (leave empty)
   - **Output Directory**: (leave empty)

## Step 4: Set Environment Variables

In your Vercel project settings, go to "Environment Variables" and add:

- `DB_HOST`: Your database host (e.g., `aws.connect.psdb.cloud` for PlanetScale)
- `DB_NAME`: Your database name
- `DB_USER`: Your database username
- `DB_PASSWORD`: Your database password

**Note**: For PlanetScale, you may need to add `?ssl-mode=REQUIRED` to your connection string or configure SSL separately.

## Step 5: Deploy

1. Click "Deploy"
2. Wait for the deployment to complete
3. Your app will be available at: `https://your-project-name.vercel.app`

## Step 6: Configure File Uploads (Optional)

If you need file upload functionality (profile pictures), you may need to:
- Use Vercel Blob Storage or another cloud storage service
- Update the upload code to use cloud storage instead of local filesystem

## Troubleshooting

### Database Connection Issues
- Verify environment variables are set correctly in Vercel dashboard
- Check that your database host allows connections from Vercel's IP ranges
- For PlanetScale, ensure SSL is enabled
- Ensure database user has proper permissions

### PHP Version Issues
- Vercel uses PHP 8.2 by default
- If you encounter compatibility issues, check PHP version requirements

### Session Issues
- Vercel's serverless functions may have limitations with PHP sessions
- Consider using Vercel KV (Redis) for session storage if needed

## Security Notes

⚠️ **Important**: Before deploying to production:
1. Change default database passwords
2. Use strong passwords
3. HTTPS is automatically enabled on Vercel
4. Ensure environment variables are not exposed in client-side code
5. Sanitize all user inputs (already implemented with prepared statements)
