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
