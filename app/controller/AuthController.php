<?php

class AuthController extends Controller
{
    public function loginForm(): void
    {
        // Kalau sudah login, langsung arahkan ke dashboard role-nya
        if (isset($_SESSION['user'])) {
            $role = $_SESSION['user']['role'];
            if ($role === 'admin') {
                header('Location: ' . BASE_URL . '/?r=admin/dashboard');
            } elseif ($role === 'mahasiswa') {
                header('Location: ' . BASE_URL . '/?r=mahasiswa/dashboard');
            } elseif ($role === 'dosen') {
                header('Location: ' . BASE_URL . '/?r=dosen/dashboard');
            }
            exit;
        }

        $title = 'Login - SIPKS';
        $error = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_error']);

        $this->view('auth/login', compact('title', 'error'));
    }

    public function login(): void
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $_SESSION['flash_error'] = 'Username dan password wajib diisi.';
            header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            exit;
        }

        $conn = db();

        $stmt = $conn->prepare('SELECT id, username, password, nama, role, status FROM users WHERE username = ? LIMIT 1');
        if (!$stmt) {
            $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (db).';
            header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            exit;
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            $_SESSION['flash_error'] = 'Username atau password salah.';
            header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            exit;
        }

        if ($user['status'] !== 'aktif') {
            $_SESSION['flash_error'] = 'Akun Anda tidak aktif. Silakan hubungi admin.';
            header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            $_SESSION['flash_error'] = 'Username atau password salah.';
            header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            exit;
        }

        // Sukses login
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'nama'     => $user['nama'],
            'role'     => $user['role'],
        ];

        if ($user['role'] === 'admin') {
            header('Location: ' . BASE_URL . '/?r=admin/dashboard');
        } elseif ($user['role'] === 'mahasiswa') {
            header('Location: ' . BASE_URL . '/?r=mahasiswa/dashboard');
        } elseif ($user['role'] === 'dosen') {
            header('Location: ' . BASE_URL . '/?r=dosen/dashboard');
        } else {
            header('Location: ' . BASE_URL . '/');
        }
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        header('Location: ' . BASE_URL . '/?r=auth/loginForm');
        exit;
    }
}
