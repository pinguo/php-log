# pinguo php-log

品果微服务日志库，继承于开源Monolog日志库，为php-msf微服务框架提供日志记录功能及追踪整个访问调用链

## 主要特性

* 继承Logger，并提供多种级别日志记录方法
* 继承StreamHandler，支持异步日志记录方法
* 记录logId,可追踪整个调用链

## 依赖

* php 7.0 or later
* swoole
* monolog 2.0.x-dev

## License

GNU General Public License, version 2 see [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)
    