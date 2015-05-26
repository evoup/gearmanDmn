<?php
/*
  +----------------------------------------------------------------------+
  | Name: gmDaemon.php
  +----------------------------------------------------------------------+
  | Comment: daemon for manager workers of gearman 
  +----------------------------------------------------------------------+
  | Author:Evoup     evoex123@gmail.com 
  +----------------------------------------------------------------------+
  | Create: 2015-05-26 10:48:42
  +----------------------------------------------------------------------+
  | Last-Modified: 2015-05-26 10:53:02
  +----------------------------------------------------------------------+
*/
$module_name='gmDaemon';
date_default_timezone_set('RPC');
define(__PRGM_PATH, dirname(__FILE__));
include_once(__DIR__."/fun/fun.fs.php");
chdir(dirname(__FILE__)); // for crontab设置路径 
$runCli=substr(php_sapi_name(), 0, 3) == 'cli'?true:false;
if ($runCli) {
    echo "cli";
    include_once(__DIR__."/modules/init.php");
}
?>
