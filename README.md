# zentao ldap plugin

AD, LDAP 的认证， 从mantis 的LDAP code 扩展剪裁。在win2003+active directory 测试过。原地址： http://www.zentao.net/extension-viewext-25.html

## 安装文档

管理员登陆禅道后台—》插件—》本地安装


## 修改纪录

### version 0.2


- admin 系统管理员跳过LDAP 认证，如果你系统超级管理员不叫 admin,自行修改 `module/user/ext/model/ldap.php` 文件第8行。
- 修复 `lib/ldap/ldap.class.php` php Warnning