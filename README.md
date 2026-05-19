# Login System with User Management

A complete PHP-based authentication system with user registration, login, and user management features using MySQL and Tailwind CSS.

## Features

- **User Registration** - Create a new account with validation
- **User Login** - Secure login with password hashing
- **Dashboard** - Welcome page with header and footer
- **User Management** - View all registered users in a modal
- **Edit Users** - Modify username and email
- **Delete Users** - Remove users with confirmation dialog
- **Session Management** - Secure session handling
- **Responsive Design** - Built with Tailwind CSS

## Project Structure

```
LoginSystem/
├── index.php              # Entry point (redirects to login/home)
├── config.php             # Database configuration and connection
├── register.php           # User registration page
├── login.php              # User login page
├── home.php               # Dashboard (after login)
├── logout.php             # Logout handler
├── api/
│   ├── get_users.php      # API to fetch all users
│   ├── edit_user.php      # API to update user details
│   └── delete_user.php    # API to delete a user
└── README.md              # This file
```

## Requirements

- **PHP** 7.4 or higher
- **MySQL** or MariaDB
- **XAMPP** or similar local server (optional but recommended)
- Web Browser

## Installation & Setup

### 1. Place Files in Web Directory

Make sure all files are in your web root directory. For XAMPP, this is typically:
```
C:\xampp\htdocs\LoginSystem  (Windows)
/opt/lampp/htdocs/LoginSystem (Linux)
```

### 2. Configure Database Connection

Open `config.php` and update the database credentials if needed:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login_system');
```

### 3. Create the Database and Table Manually

This project no longer creates the database or table automatically. Run the following SQL in your MySQL shell or PHPMyAdmin:

```sql
CREATE DATABASE IF NOT EXISTS login_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE login_system;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Start Your Server

**Using XAMPP:**
- Start the Apache and MySQL services
- Open your browser and go to: `http://localhost/LoginSystem`

**Using Built-in PHP Server:**
```bash
php -S localhost:8000
```
Then navigate to: `http://localhost:8000`

### 4. Access the Application

The application will automatically redirect you to the login page. 

- **Register First** - Click "Sign up here" to create a new account
- **Login** - Use your credentials to log in
- **View Dashboard** - You'll see the welcome page with header and footer
- **Manage Users** - Click the "Users" button to view and manage registered users

## Usage

### Register a New Account
1. Go to the sign-up page
2. Enter username, email, and password
3. Confirm your password
4. Click "Sign Up"

### Login
1. Enter your email and password
2. Click "Login"
3. You'll be redirected to the dashboard

### Manage Users
1. Click the "Users" button in the header
2. A modal will display all registered users
3. For each user, you can:
   - **Edit** - Modify username and email
   - **Delete** - Remove the user (confirmation required)

### Logout
1. Click the "Logout" button in the header
2. Your session will be destroyed and you'll be redirected to login

## Security Features

- **Password Hashing** - Uses PHP's `password_hash()` with bcrypt
- **SQL Injection Prevention** - Uses prepared statements
- **Session Protection** - User must be logged in to access protected pages
- **Email Validation** - Validates email format on registration
- **Username Uniqueness** - Prevents duplicate usernames
- **Confirmation Dialogs** - Requires user confirmation before deletion

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Tailwind CSS

This project uses Tailwind CSS via CDN for styling. All classes follow Tailwind's utility-first approach.

## Troubleshooting

### Database Connection Error
- Make sure MySQL is running
- Check database credentials in `config.php`
- Ensure the `login_system` database exists

### Users Not Loading
- Check browser console for errors (F12)
- Verify session is active
- Make sure you're logged in

### Edit/Delete Not Working
- Check that JavaScript is enabled
- Verify the user_id parameter is being sent correctly
- Check browser network tab for failed requests

## Future Enhancements

- Password reset functionality
- Email verification
- User profile page
- Role-based access control
- Search and filter users
- Pagination for users list
- Activity logging
- Two-factor authentication

## Support

For issues or questions, ensure:
1. All database credentials are correct
2. PHP version is 7.4 or higher
3. MySQL is running
4. File permissions are set correctly
5. JavaScript is enabled in browser
