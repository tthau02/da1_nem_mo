<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giao dịch thành công</title>
</head>

<body>
  <h1>Thanh toán thành công!</h1>
  <p>Mã đơn hàng: <?= htmlspecialchars($data['vnp_TxnRef']) ?></p>
  <p>Số tiền: <?= htmlspecialchars($data['vnp_Amount'] / 100) ?> VND</p>
  <p>Cảm ơn bạn đã sử dụng dịch vụ!</p>
</body>

</html>