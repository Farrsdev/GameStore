<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart | Farr'sStore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f;
            background:
                radial-gradient(ellipse at bottom, #0f1629 0%, #0a0a0f 50%),
                url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23121826" fill-opacity="0.7"%3E%3Cpath d="M12 0L0 12L12 24L24 12L12 0Z M36 0L24 12L36 24L48 12L36 0Z M12 36L0 48L12 60L24 48L12 36Z M36 36L24 48L36 60L48 48L36 36Z" fill-rule="evenodd"/%3E%3C/g%3E%3C/svg%3E');
            background-attachment: fixed;
            color: #f8fafc;
            margin: 0;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: #1a202c;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #2d3748;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(90deg, #60a5fa, #2563eb);
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: 1.2px;
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.4);
        }

        .nav-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-link {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: #2d3748;
            color: #60a5fa;
        }

        .nav-link.active {
            background: #2d3748;
            color: #60a5fa;
        }

        .logout-btn {
            background: #ef4444;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .logout-btn:hover {
            background: #dc2626;
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        /* Container */
        .container {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 32px;
            color: #cbd5e1;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h1 i {
            color: #3b82f6;
        }

        .cart-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 30px;
        }

        .cart-items {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .cart-item {
            display: flex;
            gap: 20px;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #2d3748;
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .item-cover {
            width: 100px;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            background: #2d3748;
        }

        .item-placeholder {
            width: 100px;
            height: 130px;
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 24px;
        }

        .item-info {
            flex: 1;
        }

        .item-title {
            font-size: 18px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 6px;
        }

        .item-developer {
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .item-price {
            font-size: 16px;
            font-weight: 600;
            color: #60a5fa;
            margin-bottom: 12px;
        }

        .item-qty {
            font-size: 13px;
            color: #cbd5e1;
            background: #2d3748;
            padding: 4px 12px;
            border-radius: 6px;
            display: inline-block;
        }

        .item-total {
            text-align: right;
        }

        .item-total-price {
            font-size: 20px;
            font-weight: 700;
            color: #22c55e;
            margin-bottom: 12px;
        }

        .btn-remove {
            background: #ef4444;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 13px;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .btn-remove:hover {
            background: #dc2626;
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
            transform: translateY(-2px);
        }

        .summary {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 30px;
            height: fit-content;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 20px;
        }

        .summary h2 {
            font-size: 22px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            font-size: 14px;
            color: #94a3b8;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid #2d3748;
            margin-top: 16px;
            font-size: 18px;
            font-weight: 700;
            color: #f8fafc;
        }

        .summary-total .price {
            color: #22c55e;
        }

        .btn-checkout {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-continue {
            width: 100%;
            padding: 12px;
            background: #374151;
            color: #f8fafc;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-continue:hover {
            background: #4b5563;
        }

        .empty-cart {
            background: #1a202c;
            border-radius: 12px;
            border: 1px solid #2d3748;
            padding: 60px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .empty-cart i {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 20px;
            display: block;
        }

        .empty-cart h2 {
            font-size: 24px;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 10px;
        }

        .empty-cart p {
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .btn-browse {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-browse:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        @media (max-width: 768px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
            }

            .navbar {
                padding: 18px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .nav-right {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .container {
                padding: 20px;
            }

            .cart-item {
                flex-wrap: wrap;
            }

            .item-total {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">Farr'sStore</div>

        <div class="nav-right">
            <a href="{{ route('user.dashboard') }}" class="nav-link">
                <i class="fas fa-store"></i> Browse
            </a>
            <a href="{{ route('user.library') }}" class="nav-link">
                <i class="fas fa-library"></i> My Library
            </a>
            <a href="{{ route('cart.view') }}" class="nav-link active">
                <i class="fas fa-shopping-cart"></i> Cart
            </a>
            <form method="POST" action="/logout" style="display: inline;">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h1>
            <i class="fas fa-shopping-cart"></i> Shopping Cart
        </h1>

        @if ($cartItems && count($cartItems) > 0)
            <div class="cart-grid">
                <!-- Cart Items -->
                <div class="cart-items">
                    @foreach ($cartItems as $item)
                        <div class="cart-item">
                            @if ($item['game']->cover)
                                <img src="{{ asset('covers/' . $item['game']->cover) }}"
                                    alt="{{ $item['game']->title }}" class="item-cover">
                            @else
                                <div class="item-placeholder">
                                    <i class="fas fa-gamepad"></i>
                                </div>
                            @endif

                            <div class="item-info">
                                <h3 class="item-title">{{ $item['game']->title }}</h3>
                                <p class="item-developer">{{ $item['game']->developer }}</p>
                                <p class="item-price">Rp {{ number_format($item['game']->price, 0, ',', '.') }}</p>
                                <span class="item-qty">Qty: {{ $item['quantity'] }}</span>
                            </div>

                            <div class="item-total">
                                <div class="item-total-price">Rp {{ number_format($item['itemTotal'], 0, ',', '.') }}
                                </div>
                                <form action="{{ route('cart.remove', $item['game']->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-remove">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="summary">
                    <h2>Order Summary</h2>

                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span>Free</span>
                    </div>

                    <div class="summary-row">
                        <span>Tax:</span>
                        <span>Free</span>
                    </div>

                    <div class="summary-total">
                        <span>Total:</span>
                        <span class="price">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.show') }}" class="btn-checkout">
                        <i class="fas fa-credit-card"></i> Proceed to Checkout
                    </a>

                    <a href="{{ route('user.dashboard') }}" class="btn-continue">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-inbox"></i>
                <h2>Your cart is empty</h2>
                <p>Add some games to get started!</p>
                <a href="{{ route('user.dashboard') }}" class="btn-browse">
                    <i class="fas fa-store"></i> Browse Games
                </a>
            </div>
        @endif
    </div>

</body>

</html>
