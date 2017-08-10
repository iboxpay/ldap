# zentao ldap plugin

AD, LDAP 的认证， 从mantis 的LDAP code 扩展剪裁。在win2003+active directory 测试过。原地址： http://www.zentao.net/extension-viewext-25.html


*注：现在添加的认证只是基于 LDAP 密码验证，需要在禅道系统里面有对应的用户名，否则登陆不成功。*

## 安装文档

1. 在右侧导航栏点 **Download ZIP** ，文件默认保存为 `ldap-master.zip`。管理员登陆禅道后台—》插件—》本地安装，选择刚才保存的 `ldap-master.zip`。
2. 进入操作系统，编辑 `module/user/ext/config/ldap.php`，填写相应的参数。如果配置有问题，查看php 日志 tmp/log/php.xxxxxx.log.php 进行排查调试。

## 修改纪录

### version 0.2

- admin 系统管理员跳过LDAP 认证，如果你系统超级管理员不叫 admin,自行修改 `module/user/ext/model/ldap.php` 文件第8行。
- 修复 `lib/ldap/ldap.class.php` php Warnning
