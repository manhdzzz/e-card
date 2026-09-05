{{-- FEEDBACK SECTION --}}
<div class="e-feedback">
<div class="wrapper">
    <div class="uk-container uk-container-center">
        <div class="panel"><div class="wrapper">
            <div class="name"><h2>Phản hồi khách hàng về Card Visit Điện Tử - ECard</h2></div>
            <div class="description"><p>Mỗi phản hồi của khách hàng là niềm động lực to lớn để ECard tiếp tục cho ra những sản phẩm ngày càng cải tiến và chất lượng hơn.</p></div>
        </div></div>
        <div class="grid">
            <div class="uk-grid uk-grid-medium uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-match" data-uk-grid-match="{target:'.description'}">
                @php $feedbacks = [
                    ['img'=>asset('assets/images/fb1.jpg'),'name'=>'Lê Nhật Vi','job'=>'Trưởng phòng kinh doanh','text'=>'Mình rất ấn tượng với danh thiếp thông minh vì quá tiện lợi! Hôm trước đi công tác, quên mang danh thiếp giấy, may mà có danh thiếp online nên vẫn kết nối được với đối tác.'],
                    ['img'=>asset('assets/images/fb2.png'),'name'=>'Duyên Phạm','job'=>'Trưởng phòng nhân sự','text'=>'Mình thích nhất là danh thiếp thông minh không cần cài app. Chỉ cần quét mã QR hoặc chạm NFC là có ngay thông tin, cực kỳ tiện lợi!'],
                    ['img'=>asset('assets/images/fb3.png'),'name'=>'Nhung Vũ','job'=>'Trưởng phòng kinh doanh','text'=>'Khi đưa danh thiếp thông minh cho đối tác, họ rất ngạc nhiên và thích thú vì công nghệ mới mẻ này. Nhờ vậy, để lại ấn tượng chuyên nghiệp ngay từ lần gặp đầu tiên.'],
                    ['img'=>asset('assets/images/fb4.png'),'name'=>'Đặng Anh Dũng','job'=>'Luật sư','text'=>'Vừa đổi số điện thoại và email, nếu là danh thiếp giấy chắc phải in lại toàn bộ. Nhưng với danh thiếp thông minh, chỉ cần cập nhật trên hệ thống là xong, quá tiện!'],
                    ['img'=>asset('assets/images/fb5.jpg'),'name'=>'Phạm Linh Ân','job'=>'Giám đốc truyền thông','text'=>'Trước đây phải in hàng trăm danh thiếp mỗi năm, tốn kém mà lại dễ thất lạc. Từ khi dùng danh thiếp thông minh, chỉ cần một lần đầu tư là dùng mãi mãi.'],
                    ['img'=>asset('assets/images/fb6.jpg'),'name'=>'Phan Quỳnh Sơn','job'=>'CEO Công ty bảo vệ','text'=>'Rất thích tính năng đa ngôn ngữ vì thường xuyên làm việc với đối tác nước ngoài. Đối tác có thể dễ dàng chuyển đổi ngôn ngữ để hiểu đầy đủ thông tin.'],
                ]; @endphp
                @foreach($feedbacks as $fb)
                <div>
                    <div class="item">
                        <div class="body">
                            <div class="author">
                                <div class="uk-flex uk-flex-middle">
                                    <div><div class="image cover round avatar"><img src="{{ $fb['img'] }}" alt="{{ $fb['name'] }}" /></div></div>
                                    <div><div class="information"><strong>{{ $fb['name'] }}</strong><br /><span>{{ $fb['job'] }}</span></div></div>
                                </div>
                            </div>
                            <div class="star"><i class="ti ti-star-filled"></i><i class="ti ti-star-filled"></i><i class="ti ti-star-filled"></i><i class="ti ti-star-filled"></i><i class="ti ti-star-filled"></i></div>
                            <div class="description"><p>{{ $fb['text'] }}</p></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="tool cta">
            <div class="uk-grid uk-grid-small">
                <div class="uk-width-1-1"><a href="#lead" class="register nowrap"><span>Đăng ký trải nghiệm</span><i class="ti ti-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
</div>
</div>
