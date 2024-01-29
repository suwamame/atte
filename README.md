# atte

## アプリケーション名
Atte（アット）
概要説明
　→勤怠管理システムになります。
　「勤務開始」「勤務終了」「休憩開始」「休憩終了」を出勤したら押すことで
　毎日の勤怠を管理できます。

##　作成した目的
　企業に向けて毎日使用する勤怠管理システムを作成しました。

##　機能一覧
・会員登録
・ログイン
・ログアウト
・勤務開始
・勤務終了
・休憩開始
・休憩終了
・日付別勤怠情報取得
・ページネーション5ページずつ取得

## 使用技術
・mysql:8.0.26 
・nginx:1.21.1 
・php:7.4.9 
・laravel:8
・データベース:http://localhost:8080/

## テーブル設計
https://docs.google.com/spreadsheets/d/1gxB890Emx7EbdQ0GirE2tgxcemktoHlQxY8QK1VFBhg/edit#gid=1844436133

#　ER図
https://docs.google.com/spreadsheets/d/1gxB890Emx7EbdQ0GirE2tgxcemktoHlQxY8QK1VFBhg/edit#gid=1008316442

## 環境構築
Laravel環境構築
●docker-compose exec php bash
●combos install
●.env の環境変数の変更
●phpArtisan key:generate
●phpArtisan 移行 
●mysql -u laravel_user -p

Dockerビルド
●git clone git@github.com:suwamame/atte.git-docker-template.git
●docker-compose up -d --build



