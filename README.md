# nagashi.me

RSSリーダー「ナガシミ」のソースコードです。

# デプロイ方法

（確かベース）

- nagashi.me - ./site/public_html/が参照されるように向ける（Webサイト）
- nagashi.me/app/ - ./app/public_html/が参照されるように向ける（アプリケーション）
- api.nagashi.me - ./app/api/が参照される用にReverse Proxyをむける（APIサーバー）
