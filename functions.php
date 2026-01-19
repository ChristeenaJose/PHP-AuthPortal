<?php
declare(strict_types=1);

require 'mailer.php';

class dbConnection
{
    public mysqli $conn;
    public bool $debug = false;

    public function __construct()
    {
        $this->conn = $this->OpenCon();
    }

    public function OpenCon(): mysqli
    {
        $database = include('config.php');

        $dbhost = $database['host'];
        $dbuser = $database['user'];
        $dbpass = $database['pass'];
        $db     = $database['name'];

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

        if ($conn->connect_error) {
            die("DB connection failed");
        }

        return $conn;
    }

    public function CloseCon(mysqli $conn): void
    {
        $conn->close();
    }

    /* ================= LOGIN ================= */

    public function checkUserLogin(string $username, string $password): int|false
    {
        $stmt = $this->conn->prepare(
            "SELECT id, password FROM users WHERE username = ? AND active = 1 LIMIT 1"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return (int)$user['id'];
        }

        return false;
    }

    public function getUserInfoById(int $id): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM users WHERE id = ? AND active = 1"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $res = $stmt->get_result();
        return $res->fetch_assoc() ?: false;
    }

    public function chkUserExistByMail(string $email, bool $status = true): int|false
    {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($status) $sql .= " AND active = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $res = $stmt->get_result()->fetch_assoc();
        return $res ? (int)$res['id'] : false;
    }

    public function chkUserExistById(int $userId): bool
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        return (bool)$stmt->get_result()->fetch_assoc();
    }

    public function chkUserExistByUserNamePass(string $username, string $password): bool
    {
        return $this->checkUserLogin($username, $password) !== false;
    }

    public function chkUserExistForPasswordUpdate(int $userId, string $token): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id FROM users WHERE id = ? AND token = ?"
        );
        $stmt->bind_param("is", $userId, $token);
        $stmt->execute();

        return (bool)$stmt->get_result()->fetch_assoc();
    }

    public function chkUserExistForMagicLink(int $userId, string $token): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id FROM users WHERE id = ? AND magictoken = ?"
        );
        $stmt->bind_param("is", $userId, $token);
        $stmt->execute();

        return (bool)$stmt->get_result()->fetch_assoc();
    }

    public function activateUser(int $userId): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE users SET active = 1 WHERE id = ?"
        );
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    /* ================= PASSWORD ================= */

    public function resetPassword(array $arrUserReg): bool
    {
        $hash = password_hash($arrUserReg['password'], PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "UPDATE users SET password = ?, token = NULL WHERE id = ? AND token = ?"
        );
        $stmt->bind_param("sis", $hash, $arrUserReg['id'], $arrUserReg['token']);

        return $stmt->execute();
    }

    /* ================= REGISTRATION ================= */

    public function addUserReg(array $arrUserReg): bool
    {
        $hash = password_hash($arrUserReg['password'], PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, password, email, create_datetime)
             VALUES (?, ?, ?, NOW())"
        );

        $stmt->bind_param(
            "sss",
            $arrUserReg['username'],
            $hash,
            $arrUserReg['email']
        );

        if (!$stmt->execute()) {
            return false;
        }

        $regId = $this->conn->insert_id;
        return $this->sendConfirmationMail($regId, $arrUserReg);
    }

    /* ================= TOKENS ================= */

    public function generateForgotPasswordToken(array $arrUserReg, int $userId): bool
    {
        $token = $this->generateToken();

        $stmt = $this->conn->prepare(
            "UPDATE users SET token = ? WHERE id = ?"
        );
        $stmt->bind_param("si", $token, $userId);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->sendForgotPassMail($userId, $arrUserReg, $token);
    }

    public function generateMagicLinkToken(array $arrUserReg, int $userId): bool
    {
        $token = $this->generateToken();

        $stmt = $this->conn->prepare(
            "UPDATE users SET magictoken = ? WHERE id = ?"
        );
        $stmt->bind_param("si", $token, $userId);

        if (!$stmt->execute()) {
            return false;
        }

        return $this->sendMagicLinkMail($userId, $arrUserReg, $token);
    }

    public function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /* ================= MAIL ================= */

    public function sendConfirmationMail(int $regId, array $arrUserReg): bool
    {
        $template = file_get_contents("template/email_template.html");

        $base = str_replace('registration.php', 'activate.php', $_SERVER['HTTP_REFERER']);
        $link = $base . '?id=' . base64_encode((string)$regId);

        $message = str_replace(
            ['%%$USERNAME%%', '%%$CONFIRMATIONLINK%%', '%%$CONFIRMATIONLINK2%%'],
            [$arrUserReg['username'], $link, $link],
            $template
        );

        $mailer = new Mailer();
        return $mailer->sendMail($arrUserReg['email'], "Registration Confirmation", $message);
    }

    public function sendForgotPassMail(int $regId, array $arrUserReg, string $token): bool
    {
        $template = file_get_contents("template/email_resetpass_template.html");

        $base = str_replace('forgotpassword.php', 'resetpassword.php', $_SERVER['HTTP_REFERER']);
        $link = $base . '?id=' . base64_encode((string)$regId) . '&token=' . $token;

        $message = str_replace('%%$RESETPASSWORDLINK%%', $link, $template);

        $mailer = new Mailer();
        return $mailer->sendMail($arrUserReg['email'], "Password Reset Request", $message);
    }

    public function sendMagicLinkMail(int $regId, array $arrUserReg, string $token): bool
    {
        $template = file_get_contents("template/email_magiclink_template.html");

        $base = str_replace('magiclink.php', 'accesmagiclink.php', $_SERVER['HTTP_REFERER']);
        $link = $base . '?id=' . base64_encode((string)$regId) . '&token=' . $token;

        $message = str_replace('%%$MAGICLINK%%', $link, $template);

        $mailer = new Mailer();
        return $mailer->sendMail($arrUserReg['email'], "Magic Link Login", $message);
    }
}

$classVar = new dbConnection();
