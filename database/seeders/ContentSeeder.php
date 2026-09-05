<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\KnowledgeArticle;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();
        Product::insert([
            ['title'=>'ECard VIP - (ECard Online)','slug'=>'ecard-vip','image'=>'/assets/images/product1.png','price'=>'185.000 đ (3 năm)','short_desc'=>'Giúp bạn giới thiệu bản thân và thông tin liên lạc nhanh chóng và chuyên nghiệp.','full_desc'=>'','sort_order'=>1,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'ECard NFC (ECard thẻ chip NFC)','slug'=>'ecard-nfc','image'=>'/assets/images/work2.png','price'=>'285.000 đ (3 năm)','short_desc'=>'Thẻ nhựa gắn chip NFC kết hợp ECard VIP giúp bạn tăng thêm công cụ chia sẻ.','full_desc'=>'','sort_order'=>2,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'ECard Pro - (ECard Doanh Nghiệp)','slug'=>'ecard-pro','image'=>'/assets/images/product3.png','price'=>'Từ 1.500.000 đ','short_desc'=>'Giúp doanh nghiệp đơn giản hóa việc quản lý nhân sự và danh thiếp số.','full_desc'=>'','sort_order'=>3,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);

        KnowledgeArticle::truncate();
        KnowledgeArticle::insert([
            ['title'=>'NFC (Giao tiếp gần) và ứng dụng trong ECard thông minh','slug'=>'nfc-ung-dung','image'=>'/assets/images/knowledge1.png','short_desc'=>'Công nghệ NFC đang cách mạng hóa cách chia sẻ thông tin liên hệ.','full_desc'=>'','sort_order'=>1,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'VCard (Danh bạ điện tử) và ứng dụng trong ECard thông minh','slug'=>'vcard-ung-dung','image'=>'/assets/images/knowledge2.png','short_desc'=>'VCard đang thay đổi cách quản lý thông tin liên hệ số.','full_desc'=>'','sort_order'=>2,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'Biolink (Hồ sơ liên kết) và ứng dụng trong ECard thông minh','slug'=>'biolink-ung-dung','image'=>'/assets/images/product1.png','short_desc'=>'Biolink đang cách mạng hóa cách xây dựng hồ sơ trực tuyến.','full_desc'=>'','sort_order'=>3,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['title'=>'QR Code (Mã QR) và ứng dụng trong ECard thông minh','slug'=>'qr-code-ung-dung','image'=>'/assets/images/work2.png','short_desc'=>'QR Code đang cách mạng hóa cách chia sẻ thông tin nhanh chóng.','full_desc'=>'','sort_order'=>4,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
