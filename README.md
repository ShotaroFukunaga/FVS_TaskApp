<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# FVSコーディングテスト
## 開発環境
- PHP 8.1.5
- Laravel Framework 9.10.1
- mysql 8.0
- macOS Monterey 12.3.1
- docker 20.10.13
### 使用した開発ツール
- Visual Studio Code
- Vim
  
### バージョン管理
- Git Hub

## 本番環境
- AWS EC2
- SES
- Nginx 1.20.0 
- MySQL 8.0
- Laravel 9.11.0
- PHP 8.0.16



</br>


# アプリ名 ： FVS_TaskApp
## 概要
要件に沿って作成したタスク管理アプリです。

## 基本機能
- ユーザー登録機能
- ユーザー認証機能
- パスワードリセット機能
- タスク管理機能
- タスク検索機能

## 使用方法
1. まずは会員登録画面にて会員情報を入力してください、情報を登録するとアプリからURLが記載されたメールが送られて来るので記載されたURLにアクセスし本登録を完了してください。
   
2. やらなくてはいけない仕事が出来たらタスク追加ボタンでタスク作成画面に遷移してタスクを作成してください。入力項目はタイトルとコンテンツ、期限選択カレンダーがあります。
   
3. タスク一覧に戻ったら期限超過、または完了済みタスクのボタンをクリックして表示するタスクを絞り込みして現在のタスクを確認して下さい。
   
4. 探したいタスクのタイトルがあれば検索フォームにてキーワードを入力して下さい、うろ覚えでも大丈夫です。近いワードのタイトルが表示されます。
   
5. タスクが完了したらタスク詳細をクリックして対応済みにチェックを入れましょう、またこのページではタスクの編集、削除、期限の変更も行えます。
   
6. 以上です。ありがとうございました！

</br>

## 制作手順
1. Laravel + Docker | Laravel Sailにて環境構築
2. 各種パッケージをインストール
3. Breezeにてユーザー登録、認証機能を構築
4. タスク機能に伴うMVC CRUDの作成
5. デザインはLaravel-adminLTEを採用
6. メール機能の各種機能の変更
7. アプリ全体の調整
8. AWS EC2の登録、本番環境の構築
9. アプリのデプロイ
10. SESにてメールサーバーを構築、申請承諾待ち ←イマココ



</br>

---

</br>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
