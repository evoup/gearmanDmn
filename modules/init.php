<?php
/*
  +----------------------------------------------------------------------+
  | Name: init.php
  +----------------------------------------------------------------------+
  | Comment: 初始化
  +----------------------------------------------------------------------+
  | Author:Evoup     evoex@126.com                                                     
  +----------------------------------------------------------------------+
  | Create: 2015-05-26 11:08:03
  +----------------------------------------------------------------------+
  | Last-Modified: 2015-05-26 11:08:10
  +----------------------------------------------------------------------+
*/
$module_name="init";
makeDir(__CONF_FILE,"0755",0,'f'); // 创建配置文件目录
$conf_sample = <<<EOT
[general]
debug_level=5
log_facility="LOG_LOCAL3"          ;syslog syslog_facility
log_level="LOG_ALERT"              ;syslog syslog_level
EOT;
if (true === buildConf(__CONF_FILE,$conf_sample)) { // 创建默认SAMPLE配置文件
    echo "build configuration file,done. run again\n";
    doExit("build conf");
}
/* {{{ 系统信号
 */
/** 系统信号
 * 'kill -l' gives you a list of signals available on your UNIX.
 * Eg. Ubuntu:
 *
 *  1) SIGHUP      2) SIGINT      3) SIGQUIT      4) SIGILL
 *  5) SIGTRAP      6) SIGABRT      7) SIGBUS      8) SIGFPE
 *  9) SIGKILL    10) SIGUSR1    11) SIGSEGV    12) SIGUSR2
 * 13) SIGPIPE    14) SIGALRM    15) SIGTERM    17) SIGCHLD
 * 18) SIGCONT    19) SIGSTOP    20) SIGTSTP    21) SIGTTIN
 * 22) SIGTTOU    23) SIGURG      24) SIGXCPU    25) SIGXFSZ
 * 26) SIGVTALRM  27) SIGPROF    28) SIGWINCH    29) SIGIO
 * 30) SIGPWR      31) SIGSYS      33) SIGRTMIN    34) SIGRTMIN+1
 * 35) SIGRTMIN+2  36) SIGRTMIN+3  37) SIGRTMIN+4  38) SIGRTMIN+5
 * 39) SIGRTMIN+6  40) SIGRTMIN+7  41) SIGRTMIN+8  42) SIGRTMIN+9
 * 43) SIGRTMIN+10 44) SIGRTMIN+11 45) SIGRTMIN+12 46) SIGRTMIN+13
 * 47) SIGRTMIN+14 48) SIGRTMIN+15 49) SIGRTMAX-15 50) SIGRTMAX-14
 * 51) SIGRTMAX-13 52) SIGRTMAX-12 53) SIGRTMAX-11 54) SIGRTMAX-10
 * 55) SIGRTMAX-9  56) SIGRTMAX-8  57) SIGRTMAX-7  58) SIGRTMAX-6
 * 59) SIGRTMAX-5  60) SIGRTMAX-4  61) SIGRTMAX-3  62) SIGRTMAX-2
 * 63) SIGRTMAX-1  64) SIGRTMAX
 *
 * SIG_IGN, SIG_DFL, SIG_ERR are no real signals
 *
 */
$GLOBALS['_daemon']['signalsName'] = array(
    SIGHUP    => 'SIGHUP',
    SIGINT    => 'SIGINT',
    SIGQUIT   => 'SIGQUIT',
    SIGILL    => 'SIGILL',
    SIGTRAP   => 'SIGTRAP',
    SIGABRT   => 'SIGABRT',
    7         => 'SIGEMT',
    SIGFPE    => 'SIGFPE',
    SIGKILL   => 'SIGKILL',
    SIGBUS    => 'SIGBUS',
    SIGSEGV   => 'SIGSEGV',
    SIGSYS    => 'SIGSYS',
    SIGPIPE   => 'SIGPIPE',
    SIGALRM   => 'SIGALRM',
    SIGTERM   => 'SIGTERM',
    SIGURG    => 'SIGURG',
    SIGSTOP   => 'SIGSTOP',
    SIGTSTP   => 'SIGTSTP',
    SIGCONT   => 'SIGCONT',
    SIGCHLD   => 'SIGCHLD',
    SIGTTIN   => 'SIGTTIN',
    SIGTTOU   => 'SIGTTOU',
    SIGIO     => 'SIGIO',
    SIGXCPU   => 'SIGXCPU',
    SIGXFSZ   => 'SIGXFSZ',
    SIGVTALRM => 'SIGVTALRM',
    SIGPROF   => 'SIGPROF',
    SIGWINCH  => 'SIGWINCH',
    28        => 'SIGINFO',
    SIGUSR1   => 'SIGUSR1',
    SIGUSR2   => 'SIGUSR2',
);
/* }}} */

$pid_file = __ADDON_ROOT . '/' . __RUN_SUBPATH . '/' . __PROCESS_NAME.'.pid';

if (!file_exists($pid_file)) {
    makeDir($pid_file,"0755",0,'f');
}
?>
