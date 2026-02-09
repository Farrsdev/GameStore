<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<title>User Dashboard | Farr'sStore</title>

<style>
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #0a0a0f, #0f1629);
    color: #f8fafc;
    margin: 0;
}

/* Navbar */
.navbar {
    background: #121826;
    padding: 18px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #222938;
}

.logo {
    font-size: 22px;
    font-weight: 800;
    background: linear-gradient(90deg,#60a5fa,#2563eb);
    -webkit-background-clip: text;
    color: transparent;
}

.logout-btn {
    background: #ef4444;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}

/* Content */
.container {
    padding: 40px;
}

.card {
    background: #121826;
    padding: 30px;
    border-radius: 14px;
    border: 1px solid #222938;
    margin-bottom: 25px;
}

h2 {
    margin-bottom: 10px;
}
</style>

</head>

<body>

<div class="navbar">
    <div class="logo">Farr'sStore</div>

```
<form method="POST" action="/logout">
    @csrf
    <button class="logout-btn">Logout</button>
</form>
```

</div>

<div class="container">

```
<div class="card">
    <h2>Halo, {{ Auth::user()->name }} 👋</h2>
    <p>Selamat datang di dashboard user.</p>
</div>

<div class="card">
    <h3>📦 Game Library</h3>
    <p>Daftar game yang sudah kamu beli akan muncul di sini.</p>
</div>

<div class="card">
    <h3>🧾 Riwayat Transaksi</h3>
    <p>Lihat histori pembelian kamu.</p>
</div>
```

</div>

</body>
</html>
