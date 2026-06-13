import requests
import json
import re
from datetime import datetime

# هدف: گرفتن قیمت طلا و ذخیره در فایل JSON

print("در حال گرفتن قیمت طلا...")

try:
    # آدرس سایت مقصد
    url = "https://www.tgju.org/price/gold_18"
    
    # هدرها برای اینکه سایت فکر کنه یک مرورگر واقعی هستیم
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
    }
    
    # ارسال درخواست به سایت
    response = requests.get(url, headers=headers, timeout=15)
    
    # چک کردن اینکه سایت جواب داده یا نه
    if response.status_code == 200:
        print("✅ ارتباط با سایت برقرار شد.")
        
        # محتوای صفحه
        html_content = response.text
        
        # جستجوی قیمت در صفحه
        # الگوی جستجو: اعدادی که بین 1,000,000 تا 99,000,000 هستند
        price_pattern = r'(\d{1,2},\d{3},\d{3})'
        found_prices = re.findall(price_pattern, html_content)
        
        if found_prices:
            # اولین عدد بزرگ که شبیه قیمت طلاست
            price = found_prices[0]
            print(f"💰 قیمت پیدا شد: {price} تومان")
        else:
            # اگر پیدا نشد، یک قیمت نمونه بذار
            price = "۳,۲۵۰,۰۰۰"
            print("⚠️ قیمت واقعی پیدا نشد، مقدار نمونه ذخیره شد.")
    else:
        print(f"❌ خطا: سایت جواب نداد. کد خطا: {response.status_code}")
        price = "۳,۲۵۰,۰۰۰"
        print("⚠️ مقدار نمونه ذخیره شد.")
        
except Exception as e:
    print(f"❌ خطا: {e}")
    price = "۳,۲۵۰,۰۰۰"
    print("⚠️ مقدار نمونه ذخیره شد.")

# ساخت دیکشنری داده‌ها
data = {
    "date": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
    "price": price,
    "unit": "تومان",
    "source": "tgju.org"
}

# ذخیره در فایل JSON
try:
    with open('gold_price.json', 'w', encoding='utf-8') as file:
        json.dump(data, file, ensure_ascii=False, indent=4)
    print("✅ فایل gold_price.json با موفقیت ذخیره شد.")
    print(f"📄 مسیر: C:\\xampp\\htdocs\\my_project\\gold_price.json")
except Exception as e:
    print(f"❌ خطا در ذخیره فایل: {e}")

input("\nبرای خروج Enter بزن...")
