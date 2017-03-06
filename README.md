# laravel-scout-elastic-demo

## 目录

- [介绍](#introduction)
- [技术栈](#versions)
- [安装](#installation)

## Introduction
我们要做的东西比较简单，就是把一个公众账号的文章拉下来，然后实现所有文章的“标题”和“内容”的搜索，在项目中我选择了李笑来老师的”学习学习再学习“中的50篇文章。
 
这个 Demo 是“[笑来搜](http://xiaolai.co)”的一个原型。
 
你可以直接看一下最终的效果，请查看 http://scout.lijinma.com/search 。
 
# Versions
> Laravel 5.4
 
> ElasticSearch 5.1.1
 
因为使用 `Laravel 5.4` 版本，所以需要一些基本的安装需求：

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
 
## Installation

你可以使用 homestead 或者 valet 来跑这个项目，但是为了你更快就玩起来，我建议你这么做：

如果是你 Mac 平台：

```bash
# 安装最新的 php 7.1 版本
$ brew install php71

# 安装 mysql 5.7
$ brew install mysql
```
如果 brew 下载太慢了，推荐一个我使用的镜像，执行命令：

```
$ export HOMEBREW_BOTTLE_DOMAIN="http://homebrew-mirror-china.tycdn.net"
```
好了，以上依赖按照完成之后，就可以安装项目了。

```bash
$ git clone https://github.com/lijinma/laravel-scout-elastic-demo.git
```
### 安装依赖：
```bash
$ composer install
```
如果没有 `composer`，请下载 `composer`，参考
> https://getcomposer.org/download/

### 创建数据库：
```
$ mysql -uroot
> create database laravel_scout_elastic_demo;
```
### 修改 .env：
```
$ cp .env.example .env
```
确认里面的数据库配置正确：
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_scout_elastic_demo
DB_USERNAME=root
DB_PASSWORD=
```
### 安装 ElasticSearch:

因为我们要使用 ik 插件，在安装这个插件的时候，如果自己想办法安装这个插件会浪费你很多精力。

所以我们直接使用项目： https://github.com/medcl/elasticsearch-rtf

当前的版本是 `Elasticsearch 5.1.1`，ik 插件也是直接自带了。

安装好 ElasticSearch，跑起来服务，测试服务安装是否正确：

```bash
$ curl http://localhost:9200

{
  "name" : "Rkx3vzo",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "Ww9KIfqSRA-9qnmj1TcnHQ",
  "version" : {
    "number" : "5.1.1",
    "build_hash" : "5395e21",
    "build_date" : "2016-12-06T12:36:15.409Z",
    "build_snapshot" : false,
    "lucene_version" : "6.3.0"
  },
  "tagline" : "You Know, for Search"
}
```
如果正确的打印以上信息，证明 ElasticSearch 已经安装好了。

### 开启 php 自带 Web sever
请确保你的 8000 端口没有被占用。
```
$ php artisan serve
```
从浏览器打开 [http://localhost:8000](http://localhost:8000) ，确认是否正常显示：

![demo1](https://raw.githubusercontent.com/lijinma/MyBox/master/demo1.png)

### 初始化和 ElasticSearch 相关的配置，创建 index

```bash
$ php artisan es:init
```

### 初始化数据库表格

```bash
$ php artisan migrate
```

### 爬取公众号数据并导入。

```bash
$ php artisan post:import
```
出现以下内容，说明正确导入了：

```
...
create one post!
create one post!
create one post!
create one post!
...
```
### 完成
从浏览器打开 [http://localhost:8000](http://localhost:8000)，搜索一个数据，比如`成长`

![demo2](https://raw.githubusercontent.com/lijinma/MyBox/master/demo2.png)









