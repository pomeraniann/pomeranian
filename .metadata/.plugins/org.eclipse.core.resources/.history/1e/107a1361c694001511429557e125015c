<?php
/**************************************************

	GETメソッドのリクエスト [ベアラートークン]

	* URLとオプションを変えて色々と試してみて下さい

**************************************************/

	// 設定
	$bearer_token = '' ;	// ベアラートークン
	$request_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json' ;		// エンドポイント

	// パラメータ
	$params = array(
		'screen_name' => '@arayutw' ,
		'count' => 10 ,
	) ;

	// パラメータがある場合
	if( $params )
	{
		$request_url .= '?' . http_build_query( $params ) ;
	}

	// リクエスト用のコンテキスト
	$context = array(
		'http' => array(
			'method' => 'GET' , // リクエストメソッド
			'header' => array(			  // ヘッダー
				'Authorization: Bearer ' . $bearer_token ,
			) ,
		) ,
	) ;

	// cURLを使ってリクエスト
	$curl = curl_init() ;
	curl_setopt( $curl , CURLOPT_URL , $request_url ) ;
	curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
	curl_setopt( $curl , CURLOPT_CUSTOMREQUEST , $context['http']['method'] ) ;			// メソッド
	curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;								// 証明書の検証を行わない
	curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;								// curl_execの結果を文字列で返す
	curl_setopt( $curl , CURLOPT_HTTPHEADER , $context['http']['header'] ) ;			// ヘッダー
	curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

	// [cURL]ではなく、[file_get_contents()]を使うには下記の通りです…
	// $json = @file_get_contents( $request_url , false , stream_context_create( $context ) ) ;

	// JSONをオブジェクトに変換
	$obj = json_decode( $json ) ;

	// HTML用
	$html = '' ;

	// エラー判定
	if( !$json || !$obj )
	{
		$html .= '<h2>エラー内容</h2>' ;
		$html .= '<p>データを取得することができませんでした…。設定を見直して下さい。</p>' ;
	}

	// 検証用にレスポンスヘッダーを出力 [本番環境では不要]
	$html .= '<h2>取得したデータ</h2>' ;
	$html .= '<p>下記のデータを取得できました。</p>' ;
	$html .= 	'<h3>ボディ(JSON)</h3>' ;
	$html .= 	'<p><textarea rows="8">' . $json . '</textarea></p>' ;
	$html .= 	'<h3>レスポンスヘッダー</h3>' ;
	$html .= 	'<p><textarea rows="8">' . $header . '</textarea></p>' ;

?>

<?php
	// ブラウザに[$html]を出力 (HTMLのヘッダーとフッターを付けましょう)
	echo $html ;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/all.css">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<title>SmartBoard トップ</title>
</head>
<body>

<!-- ヘッダー赤 -->
<div id="header1">
  <a href="top.html"><img src="../img/logo.png" height="45px" style="vertical-align: middle"></a>
  <input type="text" id="search-box" name="searchword" value="ゲームの検索">
  <div id="loginicon">
 	<img src="../img/twitter.png" width="40px" style="vertical-align: middle">
 	<font color="#ffffff" size="2px"><span style="vertical-align: bottom;">
 	<a href="http://smartboard-p.sakura.ne.jp/src/redirect.php">ログアウト</a></span></font>
 </div>
</div>

<!-- ヘッダー黒 -->
<div id="header2">
  <font color="#ffffff" size="2px">　　-SmartPhone Game Application Community-</font>
</div>

<div id="sub-box">
  <div style="width:100%;height:25px;background-color:#fe0000;"><font color="#ffffff">　ジャンル</font></div>
  <table id="kind">
  <tr><td>すべて</td></tr>
  <tr><td>ロールプレイング</td>
  <tr><td>パズル</td></tr>
  <tr><td>カジノ</td></tr>
  <tr><td>アクション</td></tr>
  <tr><td>カード</td></tr>
  <tr><td>アドベンチャー</td></tr>
  <tr><td>シュミレーション</td></tr>
  <tr><td>スポーツ</td></tr>
  <tr><td>音楽</td></tr>
  <tr><td>アーケード</td></tr>
  <tr><td>ボード</td></tr>
  <tr><td>レース</td></tr>
  <tr><td>その他</td></tr>
  </table>
</div>

<div id="main-box">
  <div style="width:100%;height:25px;background-color:#fe0000;"><font color="#ffffff">　ゲーム一覧</font></div>
  <a href="list.html">遷移テスト（グループ一覧画面）</a>
</div>

<div id="account-box">
  <div style="width:100%;height:25px;background-color:#fe0000;"><font color="#ffffff">　アカウント情報</font></div>
　
</div>

</body>
</html>