<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
	<h3>发送成功，请前往你填写的邮箱地址进行确认</h3><a href="/login"><span id="num"></span>秒后跳转登录页</a>
	</center>
</body>
<script src="static/assets/js/jquery.min.js"></script>
<script>
	var times = setInterval("fun()",1000);
	var i = 5;
	function fun(){
		if(i == 0){
		location.href = "/login";
		clearInterval(times);
		}
		$('#num').html(i);
		i--;
	}
</script>
</html>