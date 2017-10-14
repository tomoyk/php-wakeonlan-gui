<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>WakeOnLan on WEB</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" type="text/css" href="normalize.css">
  <style>
    body {
      background: #f7f7f7;
    }
    div#container {
      display: block;
      width: 600px;
      margin: 20px auto;
      overflow: hidden;
      padding: 30px;
      background: #c5dcfb;
      border: dotted 3px #3261a0;
      border-radius: 20px;
    }
    h1 {
      color: #153b6d;
    }
    button {
      background: #f78fa7;
      border: solid 1px #da254d;
      padding: 8px 13px;
      border-radius: 8px;
      color: #a90d31;
      text-shadow: #ff4145 0px 0px 5px;
      cursor: pointer;
    }
    button:disabled {
      background: #d0d0d0;
      border: #bdbdbd solid 1px;
      color: #888888;
      text-shadow: #f1f1f1 0px 0px 1px;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <div id="container">
    <h1>WakeOnLan Web Interface</h1>
    <hr />
    <p>ネットワーク経由でマシンを起動します。<br>起動するまで180秒程度かかります。</p>
    <form action="index.php">
      <button type="submit" name="wakeup" id="button">起動する</button>
    </form>
    <noscript>
      <b>JavaScriptを有効にしてください.<b>
    </noscript>
<?php

if( isset($_GET['wakeup']) ){
	$cmd = "sudo ether-wake -i eth0 mac-address";
	// $cmd = "date";
	$return = shell_exec($cmd);
  echo $return=='' ? '' : "<pre>$return</pre>";

  echo <<<EOF

    <script>

      // ボタンを隠す
      (function btn_hide() {
        document.getElementById("button").setAttribute("disabled", "");
      })();

      // カウントダウン
      var num = 0;
      var timerID = setInterval(function(){
        // console.log(num);
        document.getElementById("nokori").innerHTML = "<p>処理完了まで残り <b>" + (180-num) + " 秒</b></p>";
        if(num >= 3*60){
          clearInterval(timerID);
          document.getElementById("nokori").innerHTML = "<p>起動処理を完了しました。</p><ul><li>接続先: 192.168.0.2</li><li>ユーザ名: Test123</li><li>パスワード: PassWORD123</ul>";
        }
        num++;
      } ,1000);

    </script>
    <p>起動処理を実行しています。</p>
    <div id="nokori"></div>

EOF;

}

?>
  </div>
</body>
</html>
