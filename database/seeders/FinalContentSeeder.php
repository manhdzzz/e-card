<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\KnowledgeArticle;

class FinalContentSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();
        
        // ECard VIP
        Product::create([
            'title' => 'ECard VIP - Danh Thiếp Điện Tử Chuyên Nghiệp Dành Cho Cá Nhân',
            'slug' => 'ecard-vip',
            'image' => 'https://media.ecard.vn/upload/file/2025/04/17/imageecard4.png',
            'price' => '185.000 VNĐ / 3 năm',
            'short_desc' => 'ECard VIP là một giải pháp danh thiếp điện tử cao cấp dành cho cá nhân - một liên kết chứa toàn bộ "hồ sơ số" của bạn trên nền tảng Ecard.vn.',
            'full_desc' => '<h2><strong>Ưu điểm nổi bật của Ecard Online là gì?</strong></h2>
<ul>
<li>Không cần in ấn – không lo thất lạc – không tốn không gian.</li>
<li>Tất cả thông tin về bạn được trình bày trên 1 trang duy nhất</li>
<li>Chỉnh sửa thông tin dễ dàng, thời gian thực.</li>
<li>Giao diện Profile đa đạng tùy chỉnh màu sắc nhanh chóng dễ dàng</li>
<li>Chia sẻ linh hoạt qua Zalo, Messenger, Email, Facebook, LinkedIn,…</li>
</ul>
<h2><strong>Ecard VIP hiển thị được những thông tin gì?</strong></h2>
<p>Ecard Vip hay còn gọi là BioLink – viết tắt từ “Biography Link”, hiểu đơn giản là một liên kết chứa  các thông tin như sau:</p>
<ul>
<li>Ảnh đại diện,  Ảnh bìa về cá nhân </li>
<li>Số điện thoại, email, vị trí, thông tin liên hệ.</li>
<li>Các kênh mạng xã hội (Facebook, Zalo, Instagram, LinkedIn…).</li>
<li>Link website, Địa chỉ cửa hàng, kênh YouTube, TikTok…</li>
<li>Video giới thiệu, ảnh sản phẩm, tài liệu tham khảo.</li>
</ul>
<h2> So sánh ECard VIP và Danh thiếp giấy truyền thống</h2>
<table style="width: 100%; border-collapse: collapse;">
<thead>
<tr style="background-color: #f2f2f2;">
<th style="border: 1px solid #ddd; padding: 12px;">Tiêu chí</th>
<th style="border: 1px solid #ddd; padding: 12px;"> ECard VIP</th>
<th style="border: 1px solid #ddd; padding: 12px;"> Danh thiếp giấy</th>
</tr>
</thead>
<tbody>
<tr>
<td style="border: 1px solid #ddd; padding: 12px;">Chi phí</td>
<td style="border: 1px solid #ddd; padding: 12px;">185.000đ / 3 năm</td>
<td style="border: 1px solid #ddd; padding: 12px;">300.000 – 1.000.000đ / lần in</td>
</tr>
<tr>
<td style="border: 1px solid #ddd; padding: 12px;">Cập nhật thông tin</td>
<td style="border: 1px solid #ddd; padding: 12px;">Cập nhật dễ dàng, miễn phí</td>
<td style="border: 1px solid #ddd; padding: 12px;">Không thể chỉnh sửa</td>
</tr>
<tr>
<td style="border: 1px solid #ddd; padding: 12px;">Lưu danh bạ</td>
<td style="border: 1px solid #ddd; padding: 12px;">1 chạm lưu toàn bộ thông tin</td>
<td style="border: 1px solid #ddd; padding: 12px;">Phải nhập thủ công</td>
</tr>
</tbody>
</table>
<h2><strong>Quy trình sở hữu ECard VIP:</strong></h2>
<p>Bước 1: Đăng ký tài khoản. Bước 2: Kích hoạt. Bước 3: Thanh toán. Bước 4: Thiết kế hồ sơ. Bước 5: Chia sẻ.</p>',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // ECard Pro
        Product::create([
            'title' => 'ECard Pro - Danh Thiếp Điện Tử Chuyên Nghiệp Dành Cho Doanh Nghiệp',
            'slug' => 'ecard-pro',
            'image' => 'https://media.ecard.vn/upload/file/2025/04/17/imageecard6.png',
            'price' => 'Liên hệ báo giá',
            'short_desc' => 'ECard Pro là danh thiếp điện tử Online phiên bản cao cấp của nền tảng ECard.vn, được phát triển dành riêng cho doanh nghiệp.',
            'full_desc' => '<h2><strong>Tính năng nổi bật của ECard Pro</strong></h2>
<p>1. Đồng bộ thương hiệu doanh nghiệp: Giao diện chuẩn nhận diện, tên miền thương hiệu riêng.</p>
<p>2. Quản lý tập trung: Admin quản lý toàn bộ danh thiếp nhân sự, phân quyền linh hoạt.</p>
<p>3. Hồ sơ năng lực số: Hiển thị sản phẩm, dịch vụ, video, tài liệu công ty.</p>
<p>4. Báo cáo thống kê: Theo dõi lượt truy cập của từng nhân viên.</p>
<h2><strong>Lợi ích cho doanh nghiệp</strong></h2>
<ul>
<li>Quảng bá thương hiệu chuyên nghiệp.</li>
<li>Tiết kiệm chi phí in ấn trọn đời.</li>
<li>Quản trị dữ liệu nhân sự hiệu quả.</li>
</ul>',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // ECard NFC
        Product::create([
            'title' => 'ECard NFC - Thẻ Danh Thiếp Thông Minh',
            'slug' => 'danh-thiep-nfc',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/10/danhthiepnfcmauxanhngocbich.jpg',
            'price' => '100.000 đ - 215.000 đ',
            'short_desc' => 'Thẻ cứng tích hợp chip NFC công nghệ chạm thông minh, giúp chia sẻ thông tin chỉ với 1 lần chạm vào điện thoại đối tác.',
            'full_desc' => '<p><strong>Ecard NFC</strong> là thẻ cứng in trên nền nhựa có tích hợp chip NFC công nghệ chạm thông minh và mã QR liên kết trực tiếp với tài khoản danh thiếp điện tử của bạn.</p>
<p><strong>Thông tin sản phẩm:</strong></p>
<ul>
<li>Kích thước: 91x54 mm (chuẩn card visit).</li>
<li>Chất liệu: Nhựa PVC cao cấp, chống nước.</li>
<li>Chip: NFC Ntag 215 bảo mật cao.</li>
</ul>
<p><strong>Các mẫu thiết kế:</strong></p>
<ul>
<li>Mẫu sẵn: 100.000 đ/thẻ.</li>
<li>Mẫu thiết kế riêng (In UV chống xước): 215.000 đ/thẻ.</li>
</ul>',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // NFC Samples
        Product::create([
            'title' => 'Danh thiếp NFC (Mẫu Sóng màu Xanh Ngọc Bích #01)',
            'slug' => 'nfc-mau-song-xanh-ngoc',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/10/danhthiepnfcmauxanhngocbich.jpg',
            'price' => '100,000 đ',
            'short_desc' => 'Thiết kế hiện đại với tone màu xanh ngọc bích sang trọng.',
            'full_desc' => '<p>Mẫu sẵn có chip NFC Ntag 215.</p>',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        Product::create([
            'title' => 'Danh thiếp NFC (Mẫu Sóng màu Đỏ #01)',
            'slug' => 'nfc-mau-song-do',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/18/ecardnfc1.png',
            'price' => '100,000 đ',
            'short_desc' => 'Mạnh mẽ và nổi bật với mẫu thiết kế màu đỏ.',
            'full_desc' => '<p>Mẫu sẵn có chip NFC Ntag 215.</p>',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        Product::create([
            'title' => 'Danh thiếp NFC (Mẫu Trống Đồng #01)',
            'slug' => 'nfc-mau-trong-dong',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/05/06/ecardnfcmautrongdong.png',
            'price' => '100,000 đ',
            'short_desc' => 'Họa tiết trống đồng truyền thống kết hợp công nghệ hiện đại.',
            'full_desc' => '<p>Mẫu sẵn có chip NFC Ntag 215.</p>',
            'sort_order' => 6,
            'is_active' => true,
        ]);

        KnowledgeArticle::truncate();
        
        KnowledgeArticle::create([
            'title' => 'NFC (Giao tiếp gần) và ứng dụng trong ECard thông minh',
            'slug' => 'nfc-va-ung-dung',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/17/imageecard111.png',
            'short_desc' => 'Công nghệ NFC đang cách mạng hóa cách chúng ta chia sẻ thông tin liên hệ trong thời đại số.',
            'full_desc' => '<p>NFC (Near Field Communication) là công nghệ giao tiếp không dây tầm ngắn. Khi tích hợp vào danh thiếp ECard, nó cho phép truyền dữ liệu ngay lập tức khi chạm thẻ vào điện thoại di động có hỗ trợ NFC.</p>',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        KnowledgeArticle::create([
            'title' => 'VCard (Danh bạ điện tử) và ứng dụng trong ECard',
            'slug' => 'vcard-va-ung-dung',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/16/vcf.png',
            'short_desc' => 'VCard giúp lưu trữ thông tin liên hệ một cách khoa học và đồng bộ trên mọi thiết bị.',
            'full_desc' => '<p>VCard là định dạng tệp chuẩn cho danh bạ điện tử. Với ECard, đối tác có thể lưu toàn bộ thông tin của bạn vào danh bạ chỉ với một nút bấm.</p>',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        KnowledgeArticle::create([
            'title' => 'Giới thiệu về Ecard.vn – Giải pháp danh thiếp thông minh',
            'slug' => 'gioi-thieu-ecard',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/17/imageecard112.png',
            'short_desc' => 'Tìm hiểu về sứ mệnh và tầm nhìn của ECard trong việc xây dựng thương hiệu cá nhân.',
            'full_desc' => '<p>ECard.vn cung cấp các giải pháp danh thiếp điện tử tối ưu cho cá nhân và doanh nghiệp, giúp tiết kiệm chi phí và bảo vệ môi trường.</p>',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        KnowledgeArticle::create([
            'title' => 'Hướng dẫn cập nhật thông tin tài khoản ECard Online',
            'slug' => 'huong-dan-cap-nhat',
            'image' => 'https://media.ecard.vn/upload/thumb/2025/04/17/imageecard4.png',
            'short_desc' => 'Các bước chi tiết để bạn tự thiết kế và cập nhật profile danh thiếp của mình.',
            'full_desc' => '<p>Đăng nhập vào hệ thống, chọn giao diện, cập nhật ảnh đại diện và các liên kết mạng xã hội của bạn một cách dễ dàng.</p>',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        KnowledgeArticle::create([
            'title' => 'Hướng dẫn cập nhật thông tin tài khoản Ecard Online',
            'slug' => 'huong-dan-cap-nhat-thong-tin',
            'image' => 'https://media.ecard.vn/upload/file/2025/04/17/imageecard4.png',
            'short_desc' => 'Các bước chi tiết để bạn tự thiết kế và cập nhật profile danh thiếp của mình.',
            'full_desc' => '<p><strong>Hướng dẫn cập nhật thông tin hồ sơ</strong></p>
<p><strong>Bước 1:</strong> Đăng nhập tài khoản tại link: <a href="/login">/login</a><br>Truy cập trang quản lý và đăng nhập bằng tài khoản của bạn.</p>
<p><strong>Bước 2:</strong> Cập nhật thông tin cá nhân<br>Tại giao diện sau khi đăng nhập, nhấn nút <strong>“Cập nhật”</strong> để bổ sung hoặc chỉnh sửa các thông tin hồ sơ cá nhân.</p>
<p><strong>I. Thông tin hồ sơ cá nhân</strong></p>
<ul>
<li><strong>Ảnh bìa:</strong> Kích thước tối thiểu : 420x285px</li>
<li><strong>Ảnh đại diện:</strong> Kích thước hình vuông, tối thiểu 500x500px.</li>
<li><strong>Tên đầy đủ:</strong> Nhập họ và tên đầy đủ của bạn.</li>
</ul>
<p><strong>II. Giới thiệu bản thân</strong><br>Viết đoạn giới thiệu ngắn gọn về bản thân hoặc doanh nghiệp.</p>
<p><strong>III. Thông tin liên hệ</strong><br>Điền các thông tin liên hệ như Số điện thoại, Email, Địa chỉ, Website...</p>',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        \App\Models\SiteSetting::set('facebook_page_url', 'https://www.facebook.com/ecard.vn');
    }
}
