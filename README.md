<?php
namespace App\Controllers;

use App\Models\User;
use PDO;

class AuthController {
    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function showSignupForm() {
        include __DIR__ . '/../Views/signup.php';
    }

    public function signup() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$email || empty($password)) {
            echo "Invalid input.";
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $user = new User($this->db);
        $result = $user->create($email, $passwordHash);

        if ($result) {
            echo "Signup successful!";
        } else {
            echo "Signup failed.";
        }
    }

    public function showLoginForm() {
        include __DIR__ . '/../Views/login.php';
    }

    public function login() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (!$email || empty($password)) {
            echo "Invalid input.";
            return;
        }

        $user = new User($this->db);
        $userData = $user->getByEmail($email);

        if ($userData && password_verify($password, $userData['password'])) {
            $_SESSION['user_id'] = $userData['id'];
            echo "Login successful!";
        } else {
            echo "Invalid credentials.";
        }
    }

    public function logout() {
        session_destroy();
        echo "Logged out.";
    }

    public function showForgotPasswordForm() {
        include __DIR__ . '/../Views/forgot_password.php';
    }

    public function forgotPassword() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if (!$email) {
            echo "Invalid email.";
            return;
        }

        $user = new User($this->db);
        $userData = $user->getByEmail($email);

        if (!$userData) {
            echo "No user found with that email.";
            return;
        }

        $resetToken = bin2hex(random_bytes(16));
        $user->setResetToken($email, $resetToken);

        echo "Reset password link sent!";
    }

    public function showResetPasswordForm() {
        include __DIR__ . '/../Views/reset_password.php';
    }

    public function resetPassword() {
        $token = $_GET['token'] ?? '';
        $newPassword = $_POST['password'] ?? '';

        if (!$token || empty($newPassword)) {
            echo "Invalid request.";
            return;
        }

        $user = new User($this->db);
        if ($user->resetPassword($token, password_hash($newPassword, PASSWORD_DEFAULT))) {
            echo "Password reset successfully.";
        } else {
            echo "Reset failed.";
        }
    }
}
