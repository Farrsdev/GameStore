<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard | Farr'sStore</title>

<style>
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg,#0a0a0f,#0f1629);
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
    background: linear-gradient(90deg,#facc15,#f59e0b);
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

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
    gap: 20px;
}

.card {
    background: #121826;
    padding: 25px;
    border-radius: 14px;
    border: 1px solid #222938;
}

.card h3 {
    margin-bottom: 10px;
}
</style>

</head>

<body>

<div class="navbar">
    <div class="logo">Admin Panel</div>

```
<form method="POST" action="/logout">
    @csrf
    <button class="logout-btn">Logout</button>
</form>
```

</div>

<div class="container">

```
<h2>Halo Admin, {{ Auth::user()->name }} 👑</h2>
<p>Kelola seluruh sistem Farr'sStore dari sini.</p>

<br>

<div class="grid">

    <div class="card">
        <h3>👥 Total Users</h3>
        <p>Kelola data pengguna.</p>
    </div>

    <div class="card">
        <h3>🎮 Total Games</h3>
        <p>Tambah & edit game.</p>
    </div>

    <div class="card">
        <h3>🧾 Transaksi</h3>
        <p>Lihat semua pembelian.</p>
    </div>

    <div class="card">
        <h3>⚙️ Settings</h3>
        <p>Pengaturan platform.</p>
    </div>

</div>
```

</div>

</body>
</html>
