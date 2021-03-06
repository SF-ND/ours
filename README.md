# SU-Ours

这是由云南师大附中 ~~校学生会~~ 学联网络部开发的网站。

## 目录结构

* [html](https://github.com/SF-ND/ours/tree/master/html): `Ours`网站

* [api](https://github.com/SF-ND/ours/tree/master/api): `Ours`提供的`API`

## Intro

### 故事

`SU-Ours`于2019年九月中旬诞生，很幸运，现在它已经活过了一年。

开始时，她由一个前后端都只学了个一知半解的[人](https://github.com/flwfdd)花了约两周乱搞了出来，主要基于`Nginx`、`PHP`和`Mysql`。她的界面大概算得上简洁（在网络部0202年的招新中还被来面试的dalao批判了一番），代码十分混乱，可谓屎山。

2020年，师附的学生组织架构遭到了奇怪的重组，`SU`悠悠`75`载春秋，却转眼间就灰飞烟灭了。`SU-Ours`眼看也只能变成`Ours`了。23届大概会招进来许多有想法有实力的小部员，`Ours`或许会遭到大改甚至重构，我也无法想象未来它将会变成什么样子，但我相信这样的改变是好的。

为此建立仓库，作为时光胶囊，铭刻下`Ours`的雪泥鸿爪。

### 技术架构

主要基于三大件： `Nginx` | `PHP` | `Mysql`

（当然现在认识到前后端分离单页面应用等思想是有多香，`PHP`感觉上过于臃肿了

图片放在阿里云`OSS`上以获得几乎没有带宽限制的加载速度。

由于国内政策原因，未成年无法取得网络备案，因此域名[suours.com](http://suours.com)使用了内网穿透，否则就只能通过`IP`访问了。

网站文件结构见[html目录](https://github.com/SF-ND/ours/tree/master/html)。
