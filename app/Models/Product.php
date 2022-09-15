<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        "name",
        "fast_charge",
        "category",
        "main_image",
        "price",
        "description",
        "seller_id",
        "likes",
        "old_price",
        "brand",
        "phone_type",
        "sim_card",
        "product_ID",
        "operating_system",
        "processor",
        "screen_protection",
        "body_material",
        "color",
        "storage",
        "ram",
        "quantity",
        "screen_size",
        "network",
        "battery",
        "main_camera",
        "front_camera",
        "year",
        "deleted_at"
    ];

    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, "seller_id");
    }

    public function subImages()
    {
        return $this->hasMany(SubImage::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    const PRODUCT_CATEGORY_MOBILES = 1;
    const PRODUCT_CATEGORY_LAPTOPS = 2;
    const PRODUCT_CATEGORY_ACCESSORIES = 3;

    const PRODUCT_TYPE_REGULAR = 1;
    const PRODUCT_TYPE_SMART = 2;

    const PRODUCT_SIM_CARD_SINGLE = 1;
    const PRODUCT_SIM_CARD_DUAL = 2;

    const PRODUCT_FAST_CHARGING_NO = 1;
    const PRODUCT_FAST_CHARGING_YES = 2;

    const PRODUCT_BODY_MATERIAL_BALASTIC = 1;
    const PRODUCT_BODY_MATERIAL_GLASS = 2;
    const PRODUCT_BODY_MATERIAL_GLASS_BALASTIC = 3;
    const PRODUCT_BODY_MATERIAL_METAL = 4;
    const PRODUCT_BODY_MATERIAL_OTHER = 5;

    const PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_3 = 1;
    const PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_4 = 2;
    const PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_5 = 3;
    const PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_6 = 4;
    const PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_7 = 5;
    const PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_8 = 6;
    const PRODUCT_SCREEN_PROTECTION_OTHER = 7;

    const PRODUCT_BRAND_SAMSUNG = 1;
    const PRODUCT_BRAND_APPLE = 2;
    const PRODUCT_BRAND_HUAWEI = 3;
    const PRODUCT_BRAND_XIAOMI = 4;
    const PRODUCT_BRAND_OPPO = 5;
    const PRODUCT_BRAND_VIVO = 6;
    const PRODUCT_BRAND_NOKIA = 7;
    const PRODUCT_BRAND_LENOVO = 8;
    const PRODUCT_BRAND_GOOGLE = 9;
    const PRODUCT_BRAND_ONEPLUS = 10;
    const PRODUCT_BRAND_HTC = 11;
    const PRODUCT_BRAND_SONY = 12;
    const PRODUCT_BRAND_LG = 13;
    const PRODUCT_BRAND_ALCATEL = 14;
    const PRODUCT_BRAND_OTHER = 15;

    const PRODUCT_OPERATING_SYSTEM_ANDROID = 1;
    const PRODUCT_OPERATING_SYSTEM_WINDOWS = 2;
    const PRODUCT_OPERATING_SYSTEM_IOS = 3;
    const PRODUCT_OPERATING_SYSTEM_MAC = 4;
    const PRODUCT_OPERATING_SYSTEM_LINUX = 5;
    const PRODUCT_OPERATING_SYSTEM_OTHER = 6;

    const PRODUCT_COLOR_BLACK = 1;
    const PRODUCT_COLOR_RED =  2;
    const PRODUCT_COLOR_GREEN = 3;
    const PRODUCT_COLOR_SILVER = 4;
    const PRODUCT_COLOR_WHITE = 5;
    const PRODUCT_COLOR_BLUE = 6;
    const PRODUCT_COLOR_PINK = 7;
    const PRODUCT_COLOR_YELLOW = 8;
    const PRODUCT_COLOR_ORANGE = 9;
    const PRODUCT_COLOR_GOLD = 10;
    const PRODUCT_COLOR_OTHER = 11;

    const PRODUCT_STORAGE_4GB = 1;
    const PRODUCT_STORAGE_8GB = 2;
    const PRODUCT_STORAGE_16GB =   3;
    const PRODUCT_STORAGE_32GB = 4;
    const PRODUCT_STORAGE_64GB = 5;
    const PRODUCT_STORAGE_128GB = 6;
    const PRODUCT_STORAGE_256GB = 7;
    const PRODUCT_STORAGE_512GB = 8;
    const PRODUCT_STORAGE_1TB = 9;
    const PRODUCT_STORAGE_2TB = 10;
    const PRODUCT_STORAGE_4TB = 11;
    const PRODUCT_STORAGE_8TB = 12;
    const PRODUCT_STORAGE_16TB = 13;
    const PRODUCT_STORAGE_32TB = 14;
    const PRODUCT_STORAGE_64TB = 15;
    const PRODUCT_STORAGE_128TB = 16;
    const PRODUCT_STORAGE_256TB = 17;
    const PRODUCT_STORAGE_512TB = 18;
    const PRODUCT_STORAGE_1PB = 19;

    const PRODUCT_NETWORK_2G = 1;
    const PRODUCT_NETWORK_3G = 2;
    const PRODUCT_NETWORK_4G = 3;
    const PRODUCT_NETWORK_5G = 4;

    const PRODUCT_YEAR_LAST_LAST_YEAR = 1;
    const PRODUCT_YEAR_LAST_YEAR = 2;
    const PRODUCT_YEAR_THIS_YEAR = 3;
    const PRODUCT_YEAR_NEXT_YEAR = 4;


    public static function getAllProductCategories()
    {
        return [
            Product::PRODUCT_CATEGORY_MOBILES => "Mobiles",
            Product::PRODUCT_CATEGORY_LAPTOPS => "Laptops",
            Product::PRODUCT_CATEGORY_ACCESSORIES => "Accessories"
        ];
    }

    public static function getAllProductTypes()
    {
        return [
            Product::PRODUCT_TYPE_REGULAR => "Regular",
            Product::PRODUCT_TYPE_SMART => "Smart"
        ];
    }

    public static function getAllProductSimCards()
    {
        return [
            Product::PRODUCT_SIM_CARD_SINGLE => "Single",
            Product::PRODUCT_SIM_CARD_DUAL => "Dual"
        ];
    }

    public static function getAllProductFastChargings()
    {
        return [
            Product::PRODUCT_FAST_CHARGING_NO => "No",
            Product::PRODUCT_FAST_CHARGING_YES => "Yes"
        ];
    }

    public static function getAllProductBodyMaterials()
    {
        return [
            Product::PRODUCT_BODY_MATERIAL_BALASTIC => "Balastic",
            Product::PRODUCT_BODY_MATERIAL_GLASS => "Glass",
            Product::PRODUCT_BODY_MATERIAL_GLASS_BALASTIC => "Glass Balastic",
            Product::PRODUCT_BODY_MATERIAL_METAL => "Metal",
            Product::PRODUCT_BODY_MATERIAL_OTHER => "Other"
        ];
    }

    public static function getAllProductScreenProtections()
    {
        return [
            Product::PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_3 => "Gorela Glass 3",
            Product::PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_4 => "Gorela Glass 4",
            Product::PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_5 => "Gorela Glass 5",
            Product::PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_6 => "Gorela Glass 6",
            Product::PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_7 => "Gorela Glass 7",
            Product::PRODUCT_SCREEN_PROTECTION_GORELA_GLASS_8 => "Gorela Glass 8",
            Product::PRODUCT_SCREEN_PROTECTION_OTHER => "Other"
        ];
    }

    public static function getAllProductBrands()
    {
        return [
            Product::PRODUCT_BRAND_APPLE => "Apple",
            Product::PRODUCT_BRAND_SAMSUNG => "Samsung",
            Product::PRODUCT_BRAND_XIAOMI => "Xiaomi",
            Product::PRODUCT_BRAND_LG => "LG",
            Product::PRODUCT_BRAND_ALCATEL => "Alcatel",
            Product::PRODUCT_BRAND_HUAWEI => "Huawei",
            Product::PRODUCT_BRAND_NOKIA => "Nokia",
            Product::PRODUCT_BRAND_OPPO => "Oppo",
            Product::PRODUCT_BRAND_SONY => "Sony",
            Product::PRODUCT_BRAND_HTC => "HTC",
            Product::PRODUCT_BRAND_VIVO => "Motorola",
            Product::PRODUCT_BRAND_LENOVO => "Lenovo",
            Product::PRODUCT_BRAND_GOOGLE => "Google Pixel",
            Product::PRODUCT_BRAND_ONEPLUS => "OnePlus",
            Product::PRODUCT_BRAND_OTHER => "Other"
        ];
    }

    public static function getAllProductColors()
    {
        return [
            Product::PRODUCT_COLOR_BLACK => "Black",
            Product::PRODUCT_COLOR_GREEN => "Green",
            Product::PRODUCT_COLOR_WHITE => "White",
            Product::PRODUCT_COLOR_GOLD => "Gold",
            Product::PRODUCT_COLOR_SILVER => "Silver",
            Product::PRODUCT_COLOR_RED => "Red",
            Product::PRODUCT_COLOR_BLUE => "Blue",
            Product::PRODUCT_COLOR_PINK => "Pink",
            Product::PRODUCT_COLOR_YELLOW => "Yellow",
            Product::PRODUCT_COLOR_OTHER => "Other"
        ];
    }

    public static function getAllProductStorages()
    {
        return [
            Product::PRODUCT_STORAGE_4GB => "4 GB",
            Product::PRODUCT_STORAGE_8GB => "8 GB",
            Product::PRODUCT_STORAGE_16GB => "16 GB",
            Product::PRODUCT_STORAGE_32GB => "32 GB",
            Product::PRODUCT_STORAGE_64GB => "64 GB",
            Product::PRODUCT_STORAGE_128GB => "128 GB",
            Product::PRODUCT_STORAGE_256GB => "256 GB",
            Product::PRODUCT_STORAGE_512GB => "512 GB",
            Product::PRODUCT_STORAGE_1TB => "1 TB",
            Product::PRODUCT_STORAGE_2TB => "2 TB",
            Product::PRODUCT_STORAGE_4TB => "4 TB",
            Product::PRODUCT_STORAGE_8TB => "8 TB",
            Product::PRODUCT_STORAGE_16TB => "16 TB",
            Product::PRODUCT_STORAGE_32TB => "32 TB",
            Product::PRODUCT_STORAGE_64TB => "64 TB",
            Product::PRODUCT_STORAGE_128TB => "128 TB",
            Product::PRODUCT_STORAGE_256TB => "256 TB",
            Product::PRODUCT_STORAGE_512TB => "512 TB",
            Product::PRODUCT_STORAGE_1PB => "1 PB"
        ];
    }

    public static function getAllProductNetworks()
    {
        return [
            Product::PRODUCT_NETWORK_2G => "2G",
            Product::PRODUCT_NETWORK_3G => "3G",
            Product::PRODUCT_NETWORK_4G => "4G",
            Product::PRODUCT_NETWORK_5G => "5G"
        ];
    }

    public static function getAllProductOperatingSystems()
    {
        return [
            Product::PRODUCT_OPERATING_SYSTEM_ANDROID => "Android",
            Product::PRODUCT_OPERATING_SYSTEM_IOS => "IOS",
            Product::PRODUCT_OPERATING_SYSTEM_WINDOWS => "Windows",
            Product::PRODUCT_OPERATING_SYSTEM_MAC => "Mac",
            Product::PRODUCT_OPERATING_SYSTEM_LINUX => "Linux",
            Product::PRODUCT_OPERATING_SYSTEM_OTHER => "Other"
        ];
    }

    public static function getAllProductYears()
    {
        return [
            Product::PRODUCT_YEAR_LAST_LAST_YEAR => date("Y") - 2,
            Product::PRODUCT_YEAR_LAST_YEAR => date("Y") - 1,
            Product::PRODUCT_YEAR_THIS_YEAR => date("Y"),
            Product::PRODUCT_YEAR_NEXT_YEAR => date("Y") + 1
        ];
    }

    public function getBrandAttribute($value)
    {
        return $this->getAllProductBrands()[$value];
    }

    public function getPhoneTypeAttribute($value)
    {
        return $this->getAllProductTypes()[$value];
    }

    public function getSimCardAttribute($value)
    {
        return $this->getAllProductSimCards()[$value];
    }

    public function getFastChargeAttribute($value)
    {
        return $this->getAllProductFastChargings()[$value];
    }

    public function getBodyMaterialAttribute($value)
    {
        return $this->getAllProductBodyMaterials()[$value];
    }

    public function getScreenProtectionAttribute($value)
    {
        return $this->getAllProductScreenProtections()[$value];
    }
    public function getColorAttribute($value)
    {
        return $this->getAllProductColors()[$value];
    }

    public function getStorageAttribute($value)
    {
        return $this->getAllProductStorages()[$value];
    }

    public function getNetworkAttribute($value)
    {
        return $this->getAllProductNetworks()[$value];
    }

    public function getOperatingSystemAttribute($value)
    {
        return $this->getAllProductOperatingSystems()[$value];
    }

    public function getYearAttribute($value)
    {
        return $this->getAllProductYears()[$value];
    }

    public static function latestProducts()
    {
        return Product::latest()->take(4)->get();
    }

    public static function highlineProducts()
    {
        $highline = Product::where('price', '>', 8000)->take(4)->get();
        return $highline;
    }

    public static function randomProducts()
    {
        // $random = Product::inRandomOrder()->take(4)->get();
        $random = Product::orderBy("sold", "desc")->take(4)->get();

        return $random;
    }

    public static function bestSellerrProducts()
    {
        $best = Product::orderBy("sold", "desc")->take(4)->get();

        return $best;
    }

    static function getProduct($product_id)
    {
        return Product::where('id', $product_id)->first();
    }

    public function getFrontCameraAttribute($value)
    {
        return "$value MP";
    }

    public function getOldPriceAttribute($value)
    {
        return "$value EP";
    }

    public function getPriceAttribute($value)
    {
        return "$value EP";
    }

    public function getMainBatteryAttribute($value)
    {
        return "$value mAh";
    }

    public function getMainCameraAttribute($value)
    {
        return "$value MP";
    }
}
