# Toggle Position by Kmical Lights

## Features

Snow Monkeyテーマのトグルボタン, トグルメニューの位置をカスタマイズ拡張する非公式プラグインです。

## Requirement

* Snow Monkey v11.1.0 以降

## Installation

- https://github.com/kmix-39/kl-toggle-position/releases より kl-toggle-position.zip の最新版をダウンロードします。

- WordPress のプラグインディレクトリに本リポジトリのリリースファイルを配置した上で、本プラグインを有効化してください。

## Usage

カスタマイザーの [デザイン] > [ヘッダー] に [トグルボタンの位置] と [トグルメニューの位置] が追加されます。
( Snow Monkey Dropdown Navigation使用時は[トグルメニューの位置]は[トグルボタンの位置]に合わせられます )

## Note

+ Snow Monkey テーマのキャッシュ設定を有効にしている場合は正しく反映されない場合があります。その場合は一度 [キャッシュを削除] を行ってください。

+ Snow Monkey テーマのカスタマイズされている場合やデザインスキンによっては、正常に動作しない場合があります。

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
