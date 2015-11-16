<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| メール配信
	|--------------------------------------------------------------------------
	|
	| メール送信のドライバーとしてSMTPとPHPの"mail"機能の二つをLaravelは
	| サポートしています。アプリケーション全体で使用する方法を選び指定して
	| ください。デフォルトではSMTPメールをセットしています。
	|
	| サポート："smtp"、"mail", "sendmail", "mailgun", "mandrill", "log"
	|
	*/

	'driver' => 'smtp',

	/*
	|--------------------------------------------------------------------------
	| SMTPホストアドレス
	|--------------------------------------------------------------------------
	|
	| アプリケーションで使用するSMTPサーバーのホストアドレスを指定します。
	| デフォルトでは確実な配信サービスを提供しているMailgunメールサービス
	| を使用するオプションを設定しています。
	|
	*/

	'host' => 'smtp.mailgun.org',

	/*
	|--------------------------------------------------------------------------
	| SMTPホストポート
	|--------------------------------------------------------------------------
	|
	| これはアプリケーションのユーザーにメールを送信するために使用される
	| SMTPポートです。デフォルトでは、ホストと同様に、Mailgunメール
	| アプリケーション向けに設定しています。
	|
	*/

	'port' => 587,

	/*
	|--------------------------------------------------------------------------
	| グローバルな「送信元」アドレス
	|--------------------------------------------------------------------------
	|
	| メールの送信元は全部同じメールアドレスに設定したいと思うはずです。
	| アプリケーションから送信される全メールの送信元名とアドレスはここで
	| 設定します。
	|
	*/

	'from' => array('address' => null, 'name' => null),

	/*
	|--------------------------------------------------------------------------
	| メール暗号化プロトコル
	|--------------------------------------------------------------------------
	|
	| アプリケーションがメールでメッセージを送信する時に使用されるべき
	| 暗号化プロトコルをここで指定します。とても安全なトランスポート層の
	| 暗号化プロトコルがデフォルトとして設定されています。
	|
	*/

	'encryption' => 'tls',

	/*
	|--------------------------------------------------------------------------
	| SMTPサーバーユーザー名
	|--------------------------------------------------------------------------
	|
	| もしSMTPサーバーが認証でユーザー名を必要としているのでしたら、
	| ここで設定してください。サーバーに接続する時の認証に使用されます。
	| 更に"password"も、次のオプションで設定できます。
	|
	*/

	'username' => null,

	/*
	|--------------------------------------------------------------------------
	| SMTPサーバーパスワード
	|--------------------------------------------------------------------------
	|
	| アプリケーションからSMTPサーバーにメッセージを送信する時に必要な
	| パスワードをここで設定します。これはサーバーとの接続時に使用され、
	| このアプリケーションからメッセージが送信できます。
	|
	*/

	'password' => null,

	/*
	|--------------------------------------------------------------------------
	| Sendmailシステムパス
	|--------------------------------------------------------------------------
	|
	| メールの送信に"sendmail"ドライバーを使用する場合、このサーバーで
	| どこにSendmailがあるのか知る必要があります。ここで指定している
	| デフォルトのパスはほとんどのシステムで上手く動作します。
	|
	*/

	'sendmail' => '/usr/sbin/sendmail -bs',

	/*
	|--------------------------------------------------------------------------
	| メール"Pretend"モード
	|--------------------------------------------------------------------------
	|
	| このオプションを有効にすると、Web上で本当に送信せず、
	| 内容を確認するために代わりにアプリケーションの
	| ログファイルに書き込みます。これはローカル開発で便利です。
	|
	*/

	'pretend' => false,

);
