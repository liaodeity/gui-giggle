
## 关于 Gui Giggle

`Gui Giggle` 是一个laravel的后台系统，可以帮你快速的搭建一个后台系统，系统默认会有基础功能，其余功能可以根据业务需要安装模块，然后进行二开调整适应自身业务需求:

- 演示站点：

简单不复杂，让你无文档，只要会 `laravel` 就能正常开发

名字来源 `Gui` 是来源我的名字，`Giggle` 是“咯咯笑”的意思，寄望着有本项目的助力，让开发者都能在开发中咯咯笑。
### 使用前了解
- `Laravel` 配置及开发
- `Composer` 环境及使用
### 快速使用
- GIT下载代码，或直接下载打包zip解压
```bash
git clone https://github.com/liaodeity/gui-giggle.git
```
- `Composer` 安装，进入项目根目录
```bash
composer install
```
- 修改 `.env` 文件配置，如不存在请复制 `.env.example`
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gui_giggle
DB_USERNAME=root
DB_PASSWORD=root
```
- 进行数据库迁移
```bash
php artisan migrate
```
- 初始化系统基础数据
```bash
php artisan db:seed --class=InitSeeder
```
- 启动或部署web环境
```bash
php artisn serve
```
- 登录地址 账号：admin 初始密码：123456
```base
http://127.0.0.1:8000/admin/login
```


### 开发任务
- 本项目会根据 `laravel8` 以后的大版本一直同步更新（但不确保所有版本，`LTS` 版本必须有）
- 项目会开发基础版本功能后，后期将所有功能都以插件模块形式开发
- 将进行基础版本维护以及插件功能更新维护
### 相关功能

- 用户管理
- 账号管理
- 角色管理
- 权限管理
- 日志管理
- 登录管理
- 配置管理
- 菜单管理
- 版本更新
- 模块安装

## License

The Gui Giggle is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
