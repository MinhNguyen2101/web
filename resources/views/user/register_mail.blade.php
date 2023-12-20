<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3 style = "text-align: center">Đăng ký tài khoản thành công</h3>
        <p>Xin chào,  {{ $user['name'] }}</p>
        <p>Chúc mừng bạn đăng ký tài khoản thành công với hệ thống của chúng tôi với tài khoản</p>
        <p> User name: {{$user['name']}}</p> <br>
        <p>Password : {{$user['password']}}</p> <br>
        <p>Chúc bạn sẽ tìm được nhưng sản phẩm ưng ý</p>
</body>
</html>