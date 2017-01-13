<?php
if(!defined('HOST'))die('not access');
//[管理员]在2017-01-12 19:49:40通过[系统→系统工具→系统设置]，保存修改了配置文件
return array(
	'url'	=> 'http://oa.hrwuu.com/',	//系统URL
	'localurl'	=> '',	//本地系统URL，用于服务器上浏览地址
	'title'	=> '海浪公司协同办公系统',	//系统默认标题
	'apptitle'	=> '',	//APP上或PC客户端上的标题
	'weblogo'	=> '',	//PC客户端上的logo图片
	'db_host'	=> '127.0.0.1',	//数据库地址
	'db_user'	=> 'root',	//数据库用户名
	'db_pass'	=> 'Wdp@2009',	//数据库密码
	'db_base'	=> 'xinhu',	//数据库名称
	'perfix'	=> 'hailang_',	//数据库表名前缀
	'qom'	=> 'xinhu_',	//session、cookie前缀
	'highpass'	=> '',	//超级管理员密码，可用于登录任何帐号
	'db_drive'	=> 'mysqli',	//操作数据库驱动有mysql,mysqli,pdo三种
	'randkey'	=> 'wtnfdpshyrguxibczevolkqmaj',	//系统随机字符串密钥
	'asynkey'	=> '514f562b6eb0b50222bf01f68f24fbbf',	//这是异步任务key
	'openkey'	=> '41ff7a8827de34ce83fa286a6d176e06',	//对外接口openkey
	'sqllog'	=> false,	//是否记录sql日志保存upload/sqllog下
	'asynsend'	=> false,	//是否异步发送提醒消息，为true需开启服务端
	'install'	=> true,	//已安装，不要去掉啊

);
