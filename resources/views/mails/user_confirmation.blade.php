<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <table>
        <tr><td>Dear {{$name}}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Please click on below link to activate your E-com09 account</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><a href="{{url('confirm/'.$code)}}">Confirm Account</a></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards</td></tr>
        <tr><td>Protyay Roy</td></tr>
    </table>
</body>
</html>


