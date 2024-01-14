# atte

#アプリケーション名
Atte（アット）

#　作成した目的
ある企業に勤怠管理システムを作成しました。

#　アプリケーションのURL

#　ほかのリポジトリ


#　機能一覧
・会員登録
・ログイン
・ログアウト
・勤務開始
・勤務終了
・休憩開始
・休憩終了
・日付別勤怠情報取得
・ページネーション5ページずつ取得

#　使用技術
・mysql:8.0.26 
・nginx:1.21.1 
・php:7.4.9 
・laravel:8
・データベース:http://localhost:8080/

#　テーブル設計

#　ER図

#　環境構築
docker-compose exec php bash
combos install
.env の環境変数の変更
phpArtisan key:generate
phpArtisan 移行 
mysql -u laravel_user -p