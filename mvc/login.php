<?php

session_start();

if (isset($_SESSION['username'], $_SESSION['jabatan'])) {
    header('Location: /Laprak_7/mvc/index.php');
    exit;
}

require_once __DIR__ . '/koneksiMVC.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $mysqli->prepare(
        'SELECT username, password_hash, jabatan
         FROM pengguna
         WHERE username = ?'
    );

    $stmt->bind_param('s', $username);
    $stmt->execute();

    $hasil = $stmt->get_result();
    $pengguna = $hasil->fetch_assoc();

    $passwordInput = hash('sha256', $password);

    if (
        $pengguna &&
        hash_equals($pengguna['password_hash'], $passwordInput)
    ) {
        session_regenerate_id(true);

        $_SESSION['username'] = $pengguna['username'];
        $_SESSION['jabatan'] = $pengguna['jabatan'];

        header('Location: /Laprak_7/mvc/index.php');
        exit;
    }

    $error = 'Username atau password salah.';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Program Kerja</title>
</head>
<body>

<h1>Login Sistem Program Kerja</h1>

<?php if ($error !== ''): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST" action="">
    <p>
        <label>Username</label><br>
        <input type="text" name="username" required>
    </p>

    <p>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </p>

    <button type="submit">Login</button>
</form>

</body>
</html>