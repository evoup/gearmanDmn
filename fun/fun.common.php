<?php
/*
  +----------------------------------------------------------------------+
  | Name:fun.common.php
  +----------------------------------------------------------------------+
  | Comment:常用函数
  +----------------------------------------------------------------------+
  | Author:evoup     evoex@126.com                                                     
  +----------------------------------------------------------------------+
  | Create:
  +----------------------------------------------------------------------+
  | Last-Modified: 2015-05-26 13:50:03
  +----------------------------------------------------------------------+
 */

/**
 * @brief 返回浮点microtime
 * @return 
 */
function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}


/**
 * @brief 记录syslog日志
 * @param $data 记录的数据
 * @param $debug_lev调试等级
 * @param $syslog_facility
 * @param $syslog_level
 * @param $syslog_tag
 * @return 
 */
function SaveSysLog($data, $debug_lev=4, $syslog_facility='LOG_LOCAL1', $syslog_level='LOG_ALERT', $syslog_tag=__PRGM_NAME) {
    $debug_level=$GLOBALS['debug_level']; // 调试等级
    $log_facility=$GLOBALS['log_facility'];
    $log_level=$GLOBALS['log_level'];
    $stag=$GLOBALS['stag'];
    // 如果配置了syslog level使用配置的，否则使用默认的
    $syslog_level = !empty($log_level)?$log_level:$syslog_level;
    // 如果配置了syslog facility使用配置的，否则使用默认的
    $syslog_facility = !empty($log_facility)?$log_facility:$syslog_facility;

    if ($debug_lev<=$debug_level) {
        @define_syslog_variables();
        openlog($syslog_tag,LOG_PID,constant($syslog_facility));
        syslog(constant($syslog_level),"[$stag]".$data."[".__VERSION."]");
        closelog();
    }
}

/**
 *@brief 调试信息 
 *@param $debug_level_org
 *@param $debug_level_input
 *@param $debug_data
 *@return 
 */
function DebugInfo($debug_level_org,$debug_level_input,$debug_data) {
    if ($debug_level_org<=$debug_level_input && !empty($debug_data)) {
        $debug_data.='::['.__VERSION."]";
        echo $debug_data."\n";
    }
}


/**
 * @brief 创建配置文件
 * @param $conf_file
 * @param $conf_data
 * @return 
 */
function buildConf($conf_file,$conf_data) {
    if (!file_exists($conf_file)) {
        file_put_contents($conf_file,$conf_data);
        return true;
    }
}

/**
 * @brief     from php.net递归array_diff得到全部维数的区别数组
 * @param $a1 数组1
 * @param $a2 数组2
 * @return    返回全部出现在数组1中但不出现在数组2中的数组
 */
function array_diff_key_recursive ($a1, $a2) {
    foreach ($a1 as $k => $v) {
        if (is_array($v)) {
            $r[$k] = array_diff_key_recursive($a1[$k], $a2[$k]);
        } else {
            $r = @array_diff_key($a1, $a2);
        }

        if (is_array($r[$k]) && count($r[$k])==0) {
            unset($r[$k]);
        }
    }
    return $r;
}

/**
 *@brief 处理退出需要做的工作
 */
function doExit($why="") {
    global $module_name;
    !empty($why) && SaveSysLog("[$module_name][fun.doExit][because:$why]",3);
    exit();
}
