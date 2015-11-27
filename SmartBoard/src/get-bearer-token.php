<?php
/**************************************************

	ベアラートークンの取得

**************************************************/

	// 設定項目
	$api_key = '' ;		// APIキー
	$api_secret = '' ;		// APIシークレット

	// クレデンシャルを作成
	$credential = base64_encode( $api_key . ':' . $api_secret ) ;

	// リクエストURL
	$request_url = 'https://api.twitter.com/oauth2/token' ;

	// リクエスト用のコンテキストを作成する
	$context = array(
		'http' => array(
			'method' => 'POST' , // リクエストメソッド
			'header' => array(			  // ヘッダー
				'Authorization: Basic ' . $credential ,
				'Content-Type: application/x-www-form-urlencoded;charset=UTF-8' ,
			) ,
			'content' => http_build_query(	// ボディ
				array(
					'grant_type' => 'client_credentials' ,
				)
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
	curl_setopt( $curl , CURLOPT_POSTFIELDS , $context['http']['content'] ) ;			// リクエストボディ
	curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;										// タイムアウトの秒数
	$res1 = curl_exec( $curl ) ;
	$res2 = curl_getinfo( $curl ) ;
	curl_close( $curl ) ;

	// 取得したデータ
	$json = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

	// [cURL]ではなく、[file_get_contents()]を使うには下記の通りです…
	// $response = @file_get_contents( $request_url , false , stream_context_create( $context ) ) ;

	// JSONをオブジェクトに変換
	$obj = json_decode( $json ) ;

	// HTML用
	$html = '' ;

	// 実行結果を出力
	$html .= '<h2>実行結果</h2>' ;

	// エラー判定
	if( !$obj || !isset( $obj->access_token ) )
	{
		$html .= '<p>トークンを取得することができませんでした…。設定を見直して下さい。</p>' ;
	}
	else
	{
		// 各データ
		$bearer_token = $obj->access_token ;

		// 出力する
		$html .=  '<dl>' ;
		$html .=  	'<dt>ベアラートークン</dt>' ;
		$html .=  		'<dd>' . $bearer_token . '</dd>' ;
		$html .=  '</dl>' ;
	}

	// 検証用にレスポンスヘッダーを出力 [本番環境では不要]
	$html .= '<h2>取得したデータ</h2>' ;
	$html .= '<p>下記のデータを取得できました。</p>' ;
	$html .= 	'<h3>ボディ</h3>' ;
	$html .= 	'<p><textarea rows="8">' . $json . '</textarea></p>' ;
	$html .= 	'<h3>レスポンスヘッダー</h3>' ;
	$html .= 	'<p><textarea rows="8">' . $header . '</textarea></p>' ;

?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="robots" content="noindex,nofollow">

		<!-- ビューポートの設定 -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Twitter APIで、ベアラートークンを取得するサンプルデモ</title><!-- 

/********************************************************************************

	SYNCER 〜 知識、感動をみんなと同期(Sync)するブログ

	* 配布場所
	https://syncer.jp/twitter-api-matome

	* 動作確認
	https://syncer.jp/twitter-api-matome/demo/get-bearer-token.php

	* 最終更新日時
	2015/08/08 17:50

	* 作者
	あらゆ

	** 連絡先
	Twitter: https://twitter.com/arayutw
	Facebook: https://www.facebook.com/arayutw
	Google+: https://plus.google.com/114918692417332410369/
	E-mail: info@syncer.jp

	※ バグ、不具合の報告、提案、ご要望など、お待ちしております。
	※ 申し訳ありませんが、ご利用者様、個々の環境における問題はサポートしていません。

********************************************************************************/

		-->
	</head>
<body>



<?php echo $html ?>


<p style="text-align:center"><a href="https://syncer.jp/twitter-api-matome">配布元: Syncer</a></p>






</body>
</html>
