# Toggle Position by Kmical Lights

## Features

Snow Monkeyテーマ v11.5.x系に対応したトグルボタン, トグルメニューの位置をカスタマイズ拡張する非公式プラグインです。

## Requirement

* Snow Monkey v11.5.x 系

標準で左右変更が可能になりましたので、Snow Monkey v11.6.x系には対応していません。（対応予定もありません）
v11.6.x系からは標準の機能をお使いください。

## Installation

WordPress のプラグインディレクトリに本リポジトリのリリースファイルを配置した上で、本プラグインを有効化してください。

## Usage

カスタマイザーの [デザイン] > [ヘッダー] に [トグルボタンの位置] と [トグルメニューの位置] が追加されます。
( Snow Monkey Dropdown Navigation 使用時は[トグルメニューの位置]は[トグルボタンの位置]に合わせられます )

## Note

+ Snow Monkey テーマのキャッシュ設定を有効にしている場合は正しく反映されない場合があります。その場合は一度 [キャッシュを削除] を行ってください。

+ Snow Monkey テーマのカスタマイズされている場合やデザインスキンによっては、正常に動作しない場合があります。

+ Snow Monkey v11.5.0 に合わせ、トグルボタンは「ヘッダーの文字色」のカラーに対応するようになりました。それ以外のカラーを適用する場合は、フックを使用した上で各自CSSでスタイリングしてください。

## Hook

### kl_toggle_position_enqueue_toggle_style

本プラグインのトグルボタンスタイルの読み込みを制御

```
add_filter( 'kl_toggle_position_enqueue_toggle_style', '__return_false' );
```

## Author

Kmical Lights
+ 開発: Kmix39
+ サポート: Hatsuki

## License

GPL-2.0+
