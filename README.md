# **PHP-AuthPortal**

A simple PHP application that enables user registration and login with enhanced security features like double opt-in email signups, magic links, and password reset.

## **Features**

- **Login / Signup**
- **Logout**
- **Double opt-in Email signups**: Users must verify their email address before completing registration.
- **Forgot Password**: Allows users to reset their password.
- **Reset Password**: Allows users to update their password after verification.
- **Magic Link Login**: Login using a magic link sent via email.
- **JavaScript Form Validation**: Ensures all forms are validated on the client side.
- **Server-side Validation**: Additional validation on the server to enhance security.
- **Email Validation**: Both JavaScript and server-side validation to ensure a valid email address.
- **Responsive Design**: Optimized for all devices.

## **Table of Contents**
1. [Status](#status)
2. [Technologies](#technologies)
3. [Setup](#setup)
4. [Contributing](#-contributing)
5. [License](#license)

## **Status**

This is a fully functional user registration and login system built with PHP, MySQL, and front-end technologies. It supports:
- Double opt-in email verification.
- Forgot password and reset password functionality.
- Magic link for logging in.
- Server-side and client-side form validation.

## **Technologies**
- **PHP**
- **MySQL**
- **HTML**
- **CSS**
- **JavaScript**

## **Setup**

### **1️⃣ Create the Database and Tables**
   Run the following SQL commands to create the necessary database:
   ```sql
   CREATE DATABASE 'LoginSystem';
   USE 'LoginSystem';
   ```
Then, use the database.sql file to set up the required tables.
### **2️⃣ Configure the Database**
Update the database credentials in the config.php file to connect the application to your database.

### **3️⃣ Session Management**
Session management for logged-in users is handled in the following files:
- **module/auth_session.php**
- **login.php**
- **active.php**

### **4️⃣ Create Registration and Login Forms**
- **login.php: The login form page.**
- **registration.php: The registration form page.**

### **5️⃣ Double Opt-In Email Verification**
When a user registers, they will receive a double opt-in email to confirm their email address. This process requires them to click a verification link.

The email is sent using the PHP mail() function.
### **6️⃣ Dashboard Page**
The dashboard.php page is where logged-in users can view their profile information.

### **7️⃣ Logout Functionality**
The logout.php file allows users to log out by destroying their session.

### **8️⃣ Forgot Password**
The system provides a "forgot password" feature where users can request a password reset.

### **9️⃣ Magic Link for Login**
Users can log in using a magic link sent to their email. This eliminates the need for a traditional password.

### **🔟 CSS Styles**
The application's styles are contained in the styles.css file.

## 🤲 Contributing
Feel free to fork this repository and improve it. Contributions are always welcome! 🎉

## License
This project is licensed under the MIT License - see the LICENSE file for details.
