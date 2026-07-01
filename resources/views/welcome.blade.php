<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GadgetVerse</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-color: #0A192F;
            --card-bg: #1A263D;
            --primary: #00D8FF;
            --text-main: #FFFFFF;
            --text-muted: #8892B0;
            --star-color: #FFD700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: #000;
            display: flex;
            justify-content: center;
        }

        .app-container {
            width: 100%;
            max-width: 400px;
            background-color: var(--bg-color);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            padding-bottom: 90px;
            box-shadow: 0 0 30px rgba(0,0,0,0.8);
        }

        /* Header */
        header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px 20px 15px;
            position: relative;
        }

        .logo {
            color: var(--text-main);
            font-size: 18px;
            font-weight: 700;
        }

        .cart-icon {
            position: absolute;
            right: 20px;
            color: var(--primary);
            font-size: 18px;
            background: none;
            border: none;
            cursor: pointer;
        }

        /* Search Bar */
        .search-container {
            padding: 0 20px;
            margin-bottom: 25px;
        }

        .search-bar {
            background-color: var(--text-main);
            border-radius: 30px;
            display: flex;
            align-items: center;
            padding: 12px 18px;
        }

        .search-bar i {
            color: #666;
            margin-right: 10px;
            font-size: 14px;
        }

        .search-bar input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 13px;
            color: #333;
            font-weight: 500;
        }
        
        .search-bar input::placeholder {
            color: #999;
            font-weight: 400;
        }

        /* Banner */
        .banner-container {
            padding: 0 20px;
            margin-bottom: 25px;
        }

        .banner {
            background: linear-gradient(135deg, #112240 0%, #0a1128 100%);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            height: 140px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .banner-content {
            z-index: 2;
            width: 60%;
        }

        .new-arrival {
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .banner-title {
            color: var(--text-main);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .shop-now-btn {
            background-color: var(--primary);
            color: #000;
            border: none;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .shop-now-btn:active {
            transform: scale(0.95);
        }

        .banner-image {
            width: 55%;
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        .banner-image img {
            width: 100%;
            object-fit: contain;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.6));
        }

        .pagination-dots {
            display: flex;
            justify-content: center;
            margin-top: 12px;
            gap: 6px;
        }

        .dot {
            width: 18px;
            height: 2px;
            background-color: rgba(255,255,255,0.3);
            border-radius: 2px;
        }

        .dot.active {
            background-color: var(--text-main);
        }

        /* Categories */
        .categories {
            display: flex;
            justify-content: space-between;
            padding: 0 25px;
            margin-bottom: 30px;
        }

        .category-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .category-item:hover {
            color: var(--text-main);
        }

        .category-icon {
            width: 52px;
            height: 52px;
            border: 1.5px solid rgba(255,255,255,0.15);
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            color: var(--primary);
            transition: all 0.3s;
        }

        .category-item:hover .category-icon {
            background-color: rgba(0, 216, 255, 0.05);
            border-color: var(--primary);
        }

        .category-text {
            font-size: 11px;
            font-weight: 500;
        }

        /* Product Grid */
        .product-grid {
            display: flex;
            gap: 15px;
            padding: 0 20px;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 20px;
        }
        
        .product-grid::-webkit-scrollbar {
            display: none;
        }

        .product-card {
            background-color: var(--card-bg);
            border-radius: 16px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            min-width: 155px;
            flex: 0 0 auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-image {
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 12px;
            position: relative;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.4));
        }

        .product-title {
            color: var(--text-main);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-rating {
            color: var(--star-color);
            font-size: 10px;
            margin-bottom: 6px;
            display: flex;
            gap: 2px;
        }

        .product-rating i.gray {
            color: rgba(255,255,255,0.2);
        }

        .product-price {
            color: var(--text-main);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .add-to-cart {
            background-color: var(--primary);
            color: #000;
            border: none;
            padding: 9px 0;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: auto;
        }

        .add-to-cart:active {
            transform: scale(0.96);
        }

        /* FAB */
        .fab {
            position: fixed;
            bottom: 95px;
            right: 50%;
            transform: translateX(170px); /* Position it near right edge of 400px container */
            background-color: var(--primary);
            color: #000;
            padding: 12px 18px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(0, 216, 255, 0.4);
            cursor: pointer;
            z-index: 10;
            transition: transform 0.2s;
        }
        
        .fab:hover {
            transform: translateX(170px) scale(1.05);
        }
        
        @media (max-width: 400px) {
            .fab {
                right: 20px;
                transform: none;
            }
            .fab:hover {
                transform: scale(1.05);
            }
        }

        .fab i {
            font-size: 16px;
        }

        /* Bottom Nav */
        .bottom-nav {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: var(--bg-color);
            border-top: 1px solid rgba(255,255,255,0.05);
            display: flex;
            justify-content: space-around;
            padding: 12px 0 20px;
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 10px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-item.active {
            color: var(--primary);
        }

        .nav-item:hover:not(.active) {
            color: rgba(255,255,255,0.8);
        }

        .nav-item i {
            font-size: 20px;
        }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Header -->
        <header>
            <div class="logo">GadgetVerse</div>
            <button class="cart-icon"><i class="fa-solid fa-cart-shopping"></i></button>
        </header>

        <!-- Search -->
        <div class="search-container">
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search laptops, smartphones, accessories...">
            </div>
        </div>

        <!-- Banner -->
        <div class="banner-container">
            <div class="banner">
                <div class="banner-content">
                    <div class="new-arrival">NEW ARRIVALS:</div>
                    <div class="banner-title">Latest High-<br>Performance<br>Laptops</div>
                    <button class="shop-now-btn">SHOP NOW</button>
                </div>
                <div class="banner-image">
                    <img src="{{ asset('assets/images/banner_laptop.png') }}" alt="Laptop">
                </div>
            </div>
            <div class="pagination-dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>

        <!-- Categories -->
        <div class="categories">
            <div class="category-item">
                <div class="category-icon">
                    <!-- Custom SVG for a slim phone to match the image precisely -->
                    <svg width="20" height="30" viewBox="0 0 24 36" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="32" rx="3" ry="3"></rect><line x1="12" y1="28" x2="12.01" y2="28"></line></svg>
                </div>
                <div class="category-text">Smartphones</div>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <svg width="26" height="20" viewBox="0 0 32 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="24" height="14" rx="1" ry="1"></rect><path d="M2 20h28"></path></svg>
                </div>
                <div class="category-text">Laptops</div>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline><path d="M12 15v.01"></path></svg>
                </div>
                <div class="category-text">Smart Home</div>
            </div>
            <div class="category-item">
                <div class="category-icon">
                    <!-- Watch icon -->
                    <svg width="22" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="6" width="12" height="12" rx="2" ry="2"></rect><path d="M9 6V2h6v4"></path><path d="M9 18v4h6v-4"></path><polyline points="12 9 12 12 14 14"></polyline></svg>
                </div>
                <div class="category-text">Wearables</div>
            </div>
        </div>

        <!-- Products -->
        <div class="product-grid">
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('assets/images/product_laptop.png') }}" alt="Quantum Pro">
                </div>
                <div class="product-title">Quantum Pro Laptop</div>
                <div class="product-rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <div class="product-price">Rp 4.500.000</div>
                <button class="add-to-cart">Add to Cart</button>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('assets/images/product_phone.png') }}" alt="X-Phone Z">
                </div>
                <div class="product-title">X-Phone Z</div>
                <div class="product-rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star gray"></i>
                </div>
                <div class="product-price">Rp 6.000.000</div>
                <button class="add-to-cart">Add to Cart</button>
            </div>
            
            <div class="product-card">
                <div class="product-image">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Black Earbuds" style="border-radius: 10px;">
                </div>
                <div class="product-title">Black Earbuds</div>
                <div class="product-rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star gray"></i>
                </div>
                <div class="product-price">Rp 3.200.000</div>
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </div>

        <!-- Floating Action Button -->
        <div class="fab">
            <i class="fa-solid fa-headset"></i> Free Consultation
        </div>

        <!-- Bottom Navigation -->
        <div class="bottom-nav">
            <a href="#" class="nav-item active">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                <span>Home</span>
            </a>
            <a href="#" class="nav-item">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span>Categories</span>
            </a>
            <a href="#" class="nav-item">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <span>Cart</span>
            </a>
            <a href="#" class="nav-item">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span>Account</span>
            </a>
        </div>
    </div>

</body>
</html>
