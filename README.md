# kadai11_php
PHP選手権プロダクト（蔵書管理アプリ）
## ①課題番号-プロダクト名
蔵書管理アプリ

## ②課題内容（どんな作品か）
- リサイクル（中長期保管、売却、図書館等への寄贈）を目的に、蔵書を管理するアプリ
- 新規ユーザー登録を実装
- 登録された蔵書をcsv形式で出力可能 

## ③DEMO
https://rimani.sakura.ne.jp/kadai11_20240427/login.php

## ④工夫した点・こだわった点
- 新規ユーザー登録とlogin画面のpasswordにページにまとめました。
　新規ユーザー登録した後で、登録したloginID/Passwordでloginしてください（動線がイマイチなのはご容赦ください）。
- SQLのデータの登録（id）順に連番を振り、登録されている冊数が分かるようにしました。
- current_date関数で現在の時間を取得し、時間帯に応じて挨拶を設定しました。

## ⑤難しかった点・次回トライしたいこと(又は機能)
- 実在する新規ユーザー登録画面を目指して、新規ユーザー登録とloginをまとめました。
- SNSログイン（既存のSNSアカウントを利用して、Webサイトやサービスにログインできる機能）を付けたかったです。
- 現在の構成では、ユーザー登録したときに全員が共通のデータを見ることができてしまうので、ユーザー毎に固有の蔵書一覧ページを用意すべきと感じました。

## ⑥質問・疑問・感想、シェアしたいこと等なんでも
- [感想] 前回の課題の微調整や不具合の解消に時間が割かれ、地味な改修で終止してしまいました。
- [感想]致命的ではない微調整や不具合の改修は、思いの外時間を要すること、作り込んでいくほどに、エラーの発生源をたどるにも見るべきところが多く、やはり時間を要することがわかったので、この経験を卒制に活かしたいです。
