<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = BASE_PATH . '/app/view/' . $view . '.php';

        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            http_response_code(500);
            echo "View tidak ditemukan: " . htmlspecialchars($viewFile);
        }
    }

    protected function requireRole(array $roles): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            exit;
        }

        if (!in_array($_SESSION['user']['role'], $roles, true)) {
            // Kalau role tidak sesuai, lempar ke dashboard sesuai role
            $role = $_SESSION['user']['role'];
            if ($role === 'admin') {
                header('Location: ' . BASE_URL . '/?r=admin/dashboard');
            } elseif ($role === 'mahasiswa') {
                header('Location: ' . BASE_URL . '/?r=mahasiswa/dashboard');
            } elseif ($role === 'dosen') {
                header('Location: ' . BASE_URL . '/?r=dosen/dashboard');
            } else {
                header('Location: ' . BASE_URL . '/?r=auth/loginForm');
            }
            exit;
        }
    }
}
