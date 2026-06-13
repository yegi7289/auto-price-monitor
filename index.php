<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قیمت لحظه‌ای طلا - سیستم خودکار</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Tahoma', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .price-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
        }
        
        .price {
            font-size: 48px;
            font-weight: bold;
            color: #d4af37;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            margin: 10px 0;
        }
        
        .unit {
            font-size: 18px;
            color: #555;
        }
        
        .date {
            color: #666;
            font-size: 12px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
        
        .status {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 20px;
        }
        
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        button:hover {
            transform: scale(1.05);
        }
        
        .footer {
            margin-top: 20px;
            font-size: 11px;
            color: #999;
        }
        
        .error {
            background: #ffebee;
            color: #c62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💰 قیمت لحظه‌ای طلا</h1>
        <div class="subtitle">طلای ۱۸ عیار</div>
        
        <?php
        // خواندن فایل JSON
        $json_file = 'gold_price.json';
        
        if (file_exists($json_file)) {
            $content = file_get_contents($json_file);
            $data = json_decode($content, true);
            
            if ($data && isset($data['price'])) {
                echo "<div class='status'>✅ سیستم فعال | بروزرسانی خودکار</div>";
                echo "<div class='price-card'>";
                echo "<div class='price'>{$data['price']}</div>";
                echo "<div class='unit'>{$data['unit']}</div>";
                echo "<div class='date'>📅 آخرین بروزرسانی: {$data['date']}</div>";
                echo "</div>";
            } else {
                echo "<div class='status error'>⚠️ خطا در خواندن داده‌ها</div>";
                echo "<div class='price-card'>";
                echo "<div class='price'>ناموجود</div>";
                echo "<div class='unit'>لطفاً اسکریپت پایتون را اجرا کنید</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='status error'>⚠️ فایل داده وجود ندارد</div>";
            echo "<div class='price-card'>";
            echo "<div class='price'>---</div>";
            echo "<div class='unit'>ابتدا scrape_gold.py را اجرا کنید</div>";
            echo "</div>";
        }
        ?>
        
        <button onclick="location.reload()">🔄 بروزرسانی دستی</button>
        <div class="footer">
            این قیمت به صورت خودکار توسط ربات پایتون هر روز صبح بروز می‌شود
        </div>
    </div>
</body>
</html>