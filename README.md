# laravel + vue + aws のポートフォリオ

## 概要
現状のスキルを保証するためのポートフォリオです。

## なにこれ
求人検索サービスです。  
求人の追加、求人への応募が行えます。

### ユーザー画面
https://user.ritogk5.net/  
### 管理画面
https://admin.ritogk5.net/  
basic認証のウィンドウが表示された場合→(ユーザー名:root, パスワード:P@ssw0rd)


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

- vue 3系
- bootstrap 5系
- typescript 

### バックエンド

- php 7.4
- laravel 8.55.0
- docker
- docker-compose
- nginx
- mysql

### 開発環境

- vscode
- vscode remote container
- github
- windows
- wsl2

### CI/CD

- GithubActions
- jest
- larastan
- PHPUnit

### 本番環境(AWS)

- VPC
- Route53
- CertificateManager
- IAM
- EC2
- ALB
- Aurora
- S3
- CloudFront

![aws構成図](https://user-images.githubusercontent.com/72111956/163324921-0af30b0b-3fef-44c9-bffb-a75ac2b40e76.png)

## 工夫した点
openapiから生成したコードを最大限利用した事<br>
ステートレスでスケールアップしやすい設計<br>
ci/cd でテスト、デプロイを自動化した事<br>
管理画面用のvueファイルをbasic認証で保護した事<br>

## 開発環境構築

#### git
```
git clone git@github.com:ritogk/laravel-vue.git
```

#### api
```
cd laravel-vue/back
docker-compose up -d
docker-compose exec -T php sh ./setup.sh
docker-compose exec -T php php artisan migrate:refresh --seed
```

#### vue(ユーザー画面)
```
cd laravel-vue/front/user
docker-compose up -d
docker-compose exec -T vue sh ./setup.sh
docker-compose exec -T vue npm run serve
```

#### vue(管理画面)
```
cd laravel-vue/admin/user
docker-compose up -d
docker-compose exec -T vue sh ./setup.sh
docker-compose exec -T vue npm run serve
```

####  フォワーディング
localhostでapiを呼び出すとset-cookieが上手く動かないのでhosts等でフォワーディングする事。
#### C:\Windows\System32\drivers\etc\hosts
```
127.0.0.1 front.test.com
172.20.193.203 server.test.com　※172.20.193.203 == wslのipアドレス
```

#### 開発 便利コマンド

```
■Tableモデル、aliasとかを変更したら実行する。コードの補完してくれるファイルを自動生成してくれる。
php artisan ide-helper:model
php artisan ide-helper:generate

■laravelのキャッシュ等をまとめてクリア
./clear.sh

■laravelのtest
./test.sh
```
