/* 1. データベースの作成と利用 */
CREATE DATABASE IF NOT EXISTS kintaidb;
USE kintaidb;

/* 2. 従業員マスターテーブルの作成 */
/* 氏名を管理し、文字コードをutf8mb4に設定して日本語を許可する */
CREATE TABLE IF NOT EXISTS jugyoin (
    id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

/* 3. 出退勤記録テーブルの作成 */
/* 従業員IDと紐付け、出勤・退勤時刻を分単位（DATETIME）で保持する */
CREATE TABLE IF NOT EXISTS kiroku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jugyoin_id INT NOT NULL,
    start_work DATETIME,
    end_work DATETIME,
    -- 外部キー制約（任意ですが整合性のために推奨）
    CONSTRAINT fk_jugyoin FOREIGN KEY (jugyoin_id) REFERENCES jugyoin(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

/* 4. サンプルデータの投入 */
/* 動作確認用に3名の従業員を登録 */
INSERT INTO jugyoin (id, name) VALUES 
(101, '山田 太郎'), 
(102, '佐藤 花子'), 
(103, '鈴木 一郎')
ON DUPLICATE KEY UPDATE name=VALUES(name);

/* 5. ユーザー権限の設定 */
[cite_start]/* .envファイルに記載した情報（kintaiuser / kintaipass123）で接続を許可する [cite: 1] */
GRANT ALL PRIVILEGES ON kintaidb.* TO 'kintaiuser'@'localhost' IDENTIFIED BY 'kintaipass123';
FLUSH PRIVILEGES;