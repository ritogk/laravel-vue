# laravel + spa + aws のポートフォリオ

## 概要aaccddee

求人検索サービスです。<br>
求人の追加、求人への応募が行えます。

## URL

https://portfolio-rito.net/<br>
※現在停止しています。

|                                                 ログイン(会員)　                                                  |                                                     会員登録                                                      |
| :---------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------: |
| <img src="https://user-images.githubusercontent.com/72111956/163326286-0a71bee8-94d7-4190-b7c1-fa7013e3a98e.PNG"> | <img src="https://user-images.githubusercontent.com/72111956/163326306-5f40b9a9-0ffe-475d-a6b8-5186f642d459.PNG"> |

<br>

|                                                    職種選択　                                                     |     |
| :---------------------------------------------------------------------------------------------------------------: | :-: |
| <img src="https://user-images.githubusercontent.com/72111956/163326301-9755e279-2e1a-4b81-9534-6fec19443737.PNG"> |     |

<br>

|                                                    仕事一覧　                                                     |                                                     仕事詳細                                                      |
| :---------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------: |
| <img src="https://user-images.githubusercontent.com/72111956/163326297-6d5a1867-6e04-44d2-ba40-c33dee62b29b.PNG"> | <img src="https://user-images.githubusercontent.com/72111956/163326291-55007948-f81f-4b4a-93c7-6dbceb9b24e6.PNG"> |

<br>

|                                                ログイン(管理者)　                                                 |                                                     管理画面                                                      |
| :---------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------: |
| <img src="https://user-images.githubusercontent.com/72111956/163326342-f1dbd732-afd9-44d4-9bee-b9104fab79c8.PNG"> | <img src="https://user-images.githubusercontent.com/72111956/163326730-b180a0b7-320e-42d2-a702-1d70786d2340.png"> |

<br>

|                                                    選考一覧　                                                     |     |
| :---------------------------------------------------------------------------------------------------------------: | :-: |
| <img src="https://user-images.githubusercontent.com/72111956/163326340-2565e805-35f5-409f-893b-0f41c99016b9.PNG"> |     |

<br>

|                                                職種マスタ(一覧)　                                                 |                                                 職種マスタ(新規)                                                  |
| :---------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------: |
| <img src="https://user-images.githubusercontent.com/72111956/163326333-7db5e432-bd60-424a-a675-8c8a76816252.PNG"> | <img src="https://user-images.githubusercontent.com/72111956/163326337-29628c32-ad84-4f5f-b344-5e9876e9d2c2.PNG"> |

<br>

|                                                職種マスタ(編集)　                                                 |     |
| :---------------------------------------------------------------------------------------------------------------: | :-: |
| <img src="https://user-images.githubusercontent.com/72111956/163326338-3a8d2aef-8d36-4c3a-9d8d-7557fbd02a97.PNG"> |     |

<br>

|                                                仕事マスタ(一覧)　                                                 |                                                 仕事マスタ(新規)                                                  |
| :---------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------: |
| <img src="https://user-images.githubusercontent.com/72111956/163326327-9b5533e1-3cac-43db-a8e2-3bb3f5dc731d.PNG"> | <img src="https://user-images.githubusercontent.com/72111956/163326330-b1e8fb1c-ca9b-428a-90c4-cf2984082536.PNG"> |

<br>

|                                                仕事マスタ(編集)　                                                 |     |
| :---------------------------------------------------------------------------------------------------------------: | :-: |
| <img src="https://user-images.githubusercontent.com/72111956/163326983-098bd8bd-72be-44ab-8d24-dd8b5a2063f0.PNG"> |     |

<br>

## 使用技術・環境

### フロントエンド

- vue 2.6.12
- vue-router 3.4.9
- vuex 3.6.2
- bootstrap-vue 2.19.x
- typescript 4.2.4

### バックエンド

- php 7.4
- laravel 8.4.0
- docker 20.10.4
- docker-compose 1.11.2
- nginx 8.3.0
- mysql 8.0.20

### 開発環境

- vscode
- eslint
- github
- windows
- wsl2

### CI/CD

- GithubActions
- larastan 0.7.x
- PHPUnit 9.3.3
- laravel Dusk 6.9

### 本番環境(AWS)

- VPC
- EC2
- ALB
- RDS
- ElastiCache
- S3
- CloudFront
- Route53
- ACM
- SQS
- SES

![aws構成図](https://user-images.githubusercontent.com/72111956/163324921-0af30b0b-3fef-44c9-bffb-a75ac2b40e76.png)

## 工夫した点

バックエンドとフロントエンドを api と vue で切り離した設計<br>
クリーンアーキテクチャ設計<br>
フロントエンド側を spa で作成<br>
一般会員と管理者のマルチログイン機能<br>
typescript, 静的チェック, テストコード等を使用して品質向上<br>
コンテナはローカル環境と本番環境で同じものを使用<br>
ci/cd でテスト、デプロイを自動化<br>
セキュリティを意識した aws 構成<br>
高可用でスケール可能な aws 構成<br>

## 開発環境構築

#### wsl

```
git clone git@github.com:ritogk/laravel-spa.git
cd laravel-spa
code .
```

#### windows ホスト

```
vscodeからRemoteContainer経由でコンテナを起動
※なぜかエラーが出る。wsl側からdocker-compose downして再度繋ぎ直すとなぜか動く。
```

#### php コンテナ

```
chmod +x setup.sh
./setup.sh
php artisan migrate:refresh --seed
.vim .env
# 「LOG_SLACK_WEBHOOK_URL」にwebhook urlを書き込む
```

#### 開発 便利コマンド

```
■Tableモデル、aliasとかを変更したら実行。コード補完してくれるファイルを自動生成してくれる。
php artisan ide-helper:model
php artisan ide-helper:generate
■キャッシュ等をクリア
./clear.sh
```

## 職務経歴書

https://github.com/homing-job/laravel-spa/blob/main/resume.md
