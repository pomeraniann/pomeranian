<?php
/******************************

	認証画面にユーザーを飛ばす

******************************/

	// [API Key]と[API Secret]
	$api_key = 'PTn6fVX7wKvUDABkec5M0QKlK' ;
	$api_secret = 'TeZbftHWUXvWoyHEKyIotVeNSLovgazCbRkZ8MikzPJ8yO3MuW' ;

	// Callback URL
	// * 自動的にこのプログラムのURLが指定されるようにしていますが、もし不具合がある場合は、直接、URLを指定して下さい。
	// * 例 ) $callback_url = 'https://syncer.jp/get-access-token.php' ;
	//$callback_url = ( !isset($_SERVER['HTTPS']) || empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;
	$callback_url = 'http://smartboard-r.sakura.ne.jp/src/l_top.php' ;
	
	
	/*** [手順1] リクエストトークンの取得 ***/

	// [アクセストークンシークレット] (まだ存在しないので「なし」)
	$access_token_secret = '' ;

	// エンドポイントURL
	$request_url = 'https://api.twitter.com/oauth/request_token' ;

	// リクエストメソッド
	$request_method = 'POST' ;

	// キーを作成する (URLエンコードする)
	$signature_key = rawurlencode( $api_secret ) . '&' . rawurlencode( $access_token_secret ) ;

	// パラメータ([oauth_signature]を除く)を連想配列で指定
	$params = array(
		'oauth_callback' => $callback_url ,
		'oauth_consumer_key' => $api_key ,
		'oauth_signature_method' => 'HMAC-SHA1' ,
		'oauth_timestamp' => time() ,
		'oauth_nonce' => microtime() ,
		'oauth_version' => '1.0' ,
	) ;

	// 各パラメータをURLエンコードする
	foreach( $params as $key => $value )
	{
		// コールバックURLだけはここでエンコードしちゃダメ(よ〜、ダメダメ)
		if( $key == 'oauth_callback' )
		{
			continue ;
		}

		// URLエンコード処理
		$params[ $key ] = rawurlencode( $value ) ;
	}

	// 連想配列をアルファベット順に並び替える
	ksort( $params ) ;

	// パラメータの連想配列を[キー=値&キー=値...]の文字列に変換する
	$request_params = http_build_query( $params , '' , '&' ) ;
 
	// 変換した文字列をURLエンコードする
	$request_params = rawurlencode( $request_params ) ;
 
	// リクエストメソッドをURLエンコードする
	$encoded_request_method = rawurlencode( $request_method ) ;
 
	// リクエストURLをURLエンコードする
	$encoded_request_url = rawurlencode( $request_url ) ;
 
	// リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
	$signature_data = $encoded_request_method . '&' . $encoded_request_url . '&' . $request_params ;

	// キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
	$hash = hash_hmac( 'sha1' , $signature_data , $signature_key , TRUE ) ;

	// base64エンコードして、署名[$signature]が完成する
	$signature = base64_encode( $hash ) ;

	// パラメータの連想配列、[$params]に、作成した署名を加える
	$params['oauth_signature'] = $signature ;

	// パラメータの連想配列を[キー=値,キー=値,...]の文字列に変換する
	$header_params = http_build_query( $params , '' , ',' ) ;

	// リクエスト用のコンテキストを作成する
	$context = array(
		'http' => array(
			'method' => $request_method , //リクエストメソッド
			'header' => array(			  //カスタムヘッダー
				'Authorization: OAuth ' . $header_params ,
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
	$response = substr( $res1, $res2['header_size'] ) ;				// 取得したデータ(JSONなど)
	$header = substr( $res1, 0, $res2['header_size'] ) ;		// レスポンスヘッダー (検証に利用したい場合にどうぞ)

	// [cURL]ではなく、[file_get_contents()]を使うには下記の通りです…
	// $response = @file_get_contents( $request_url , false , stream_context_create( $context ) ) ;

	// リクエストが成功しなかった場合
	if( !isset( $response ) || empty( $response ) )
	{
		$error = 'リクエストが失敗してしまったようです。Twitterからの応答自体がありません…。' ;
	}

	// 成功した場合
	else
	{
		// 文字列を[&]で区切る
		$parameters = explode( '&' , $response ) ;

		// エラー判定
		if( !isset( $parameters[1] ) || empty( $parameters[1] ) )
		{
			$error_msg = true ;
		}
		else
		{
			// それぞれの値を格納する配列
			$query = array() ;

			// [$parameters]をループ処理
			foreach( $parameters as $parameter )
			{
				// 文字列を[=]で区切る
				$pair = explode( '=' , $parameter ) ;

				// 配列に格納する
				if( isset($pair[1]) )
				{
					$query[ $pair[0] ] = $pair[1] ;
				}
			}

			// エラー判定
			if( !isset( $query['oauth_token'] ) || !isset( $query['oauth_token_secret'] ) )
			{
				$error_msg = true ;
			}
			else
			{
				// 出力する
				$html = '' ;
				$html .=  '<h2>実行結果</h2>' ;
				$html .=  '<dl>' ;
				$html .=  	'<dt>oauth_token</dt>' ;
				$html .=  		'<dd>' . $query['oauth_token'] . '</dd>' ;
				$html .=  	'<dt>oauth_token_secret</dt>' ;
				$html .=  		'<dd>' . $query['oauth_token_secret'] . '</dd>' ;
				$html .=  '</dl>' ;

				/*** [手順2] ユーザーを認証画面に移動させる ***/

				// セッション[$_SESSION["oauth_token_secret"]]に[oauth_token_secret]を保存する
				session_start() ;
				session_regenerate_id( true ) ;
				$_SESSION['oauth_token_secret'] = $query['oauth_token_secret'] ;

				// ユーザーを認証画面へ飛ばす
				header( 'Location: https://api.twitter.com/oauth/authorize?oauth_token=' . $query['oauth_token'] ) ;

				// 処理を終了
				exit ;
			}
		}

		// エラーの場合
		if( isset( $error_msg ) && !empty( $error_msg ) )
		{
			$error = '' ;
			$error .= 'リクエストトークンを取得できませんでした…。[$api_key]と[$callback_url]、そしてTwitterのアプリケーションに設定している[Callback URL]を確認して下さい。' ;
			$error .= '([Callback URLに設定されているURL]→<mark>' . $callback_url . '</mark>)' ;
		}
	}

	// エラーメッセージがある場合
	if( isset( $error ) && $error )
	{
		$html .=  '<h2>エラー内容</h2>' ;
		$html .= '<p>' . $error . '</p>' ;
	}
?>