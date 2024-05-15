<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo Mua gói VIP thành công</title>
</head>
<body>
    <h1>Cảm ơn bạn đã mua gói VIP!</h1>
    <p>Xin chào</p>
    <p>Cảm ơn bạn đã mua gói VIP của chúng tôi. Chúng tôi rất vui vì đã có bạn gia nhập cộng đồng VIP!</p>
    
    <div class="container" style="text-align: center;">
        <h4 style="font-size: 18px; margin-top: 50px; text-transform: uppercase;
        color: #4ece4e;font-weight: 600;">Chúc mừng</h4>
        <h4 style="font-size: 18px;
        margin-top: 10px;
        text-transform: uppercase;
        color: #4ece4e;
        font-weight: 600">Bạn đã thanh toán thành công</h4>
        <div class="box-content" style="margin-top: 20px;margin-bottom: 30px;">
            <h4>Mã đơn hàng: #{{$order->transactionNo}}</h4>
            <h4>Thanh toán vào ngày: {{date('d-m-Y', strtotime($order->created_at))}}</h4>
            <h4>Hết hạn vào ngày: {{date('d-m-Y', strtotime($order->expired_at))}}</h4>
            <h4>Gói: {{$order->goivip->name}}</h4>
            <h4>Số tiền: {{$order->total}}</h4>
            <h4>Hình thức thanh toán: {{$order->hinhthuctt}}</h4>
        </div>
    </div>

    <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu nào, xin vui lòng liên hệ với chúng tôi qua email: <a href="mailto:example@example.com">example@example.com</a>.</p>
    <p>Chúc bạn một ngày tuyệt vời!</p>
</body>
</html>
