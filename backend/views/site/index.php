<?php

use common\models\systemInfo;

$this->title = '系统信息';

?>
<div id="systemInfo">

    <?php
        $sysInfo = new systemInfo();
        $info = $sysInfo->save();
        $sysInfo->load($info);
        $extensions = $sysInfo->getExtensions();
    ?>
    <h1>服务器系统信息</h1>

    <?php
    echo $this->render('table', [
        'caption' => '应用信息',
        'values' => [
            'Yii 版本' => $sysInfo->data['application']['yii'],
            '应用名称' => $sysInfo->data['application']['name'],
            '应用环境' => $sysInfo->data['application']['env'],
            '调试模式' => $sysInfo->data['application']['debug'] ? '开' : '关',
        ],
    ]);



    echo $this->render('table', [
        'caption' => 'PHP 信息',
        'values' => [
            'PHP 版本' => $sysInfo->data['php']['version'],
            'Xdebug' => $sysInfo->data['php']['xdebug'] ? '开' : '关',
            'APC' => $sysInfo->data['php']['apc'] ? '开' : '关',
            'Memcache' => $sysInfo->data['php']['memcache'] ? '开' : '关',
            'php API 模式' => $sysInfo->data['php']['phpApiName'],
            '安全模式' => $sysInfo->data['php']['safeMode'],
            'GD库版本' => $sysInfo->data['php']['gdVersion'],
            'Zend版本' => $sysInfo->data['php']['zendVersion'],
            '内存使用' => $sysInfo->data['php']['memoryUsage'],
        ],
    ]);

    echo $this->render('table', [
        'caption' => '服务器信息',
        'values' => [
            '系统' => $sysInfo->data['server']['system'],
            '服务器' => $sysInfo->data['server']['server'],
            'Mysql 版本' => $sysInfo->data['server']['mysqlVersion'],
            'Http 版本' => $sysInfo->data['server']['httpVersion'],
            '服务器 IP' => $sysInfo->data['server']['serverIp'],
            '客户 IP' => $sysInfo->data['server']['clientIp'],
            '服务器 域名' => $sysInfo->data['server']['serverDomainName'],
            '服务器 CPU' => $sysInfo->data['server']['serverCpu'],
            '监听端口' => $sysInfo->data['server']['serverPort'],
            '根目录' => $sysInfo->data['server']['documentRoot'],
            '最大执行时间' => $sysInfo->data['server']['maxExecutionTime'],
            '文件上传限制' => $sysInfo->data['server']['serverFileUpload'],
            '全局模式' => $sysInfo->data['server']['registerGlobals'],
            '语言' => $sysInfo->data['server']['serverLanguage'],

        ],
    ]);


    if (!empty($extensions)) {
    echo $this->render('table', [
    'caption' => '扩展信息',
    'values' => $extensions,
    ]);
    }

    ?>
</div>

