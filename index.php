<?php

if( isset($_GET['wakeup']) ){
	$cmd = "sudo ether-wake -i eth0 mac-address";
	$result = shell_exec($cmd);
	echo $result;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Wake Up Machine on LAN</title>
	<meta name="viewport" content="width=device-width">
</head>
<body>
	<h1>Wake on LAN</h1>
	<hr />
	<p>ネットワーク経由でマシンを起動します。<br>起動するまで180秒程度かかります。</p>
	<form action="index.php">
		<input type="submit" name="wakeup" value="NETBOOT" id="button">
	</form>
<script>
var num = 0;
function mes(){
	// console.log(num);
	document.getElementById("nokori").innerHTML = "処理完了まで " + (3*60-num) + " 秒";
	if(num >= 3*60){
		clearInterval(timerID);
		document.getElementById("nokori").innerHTML = "起動処理を完了しました。<br><br>接続先： 192.168.0.200<br>ユーザ名： koyama</p>";
	}
	num++;
}

function btn_hide() {
	document.getElementById("button").setAttribute("disabled", "");
}

<?php

if( isset($_GET['wakeup']) ){
	echo "btn_hide();\n";
	echo "var timerID = setInterval(\"mes()\",1000);\n";
}

?>
</script>
<?php

if( isset($_GET['wakeup']) ){
	echo "<p>起動処理を実行しています。</p>\n";
	echo "<p id=\"nokori\"></p>\n";
}

?>
</body>
</html>
