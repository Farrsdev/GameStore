#!/bin/bash

cd D:\Koding\laravel\GameStore

echo "Running migrations..."
php artisan migrate:fresh --seed

echo ""
echo "Checking database..."
php artisan tinker << 'EOF'
echo "Users: " . User::count() . "\n";
echo "Games: " . Game::count() . "\n";
echo "Orders: " . Order::count() . "\n";
echo "OrderItems: " . OrderItem::count() . "\n";
echo "UserGames: " . DB::table('user_games')->count() . "\n";
EOF

echo ""
echo "✅ Migrations complete!"
