<?php

namespace Ranvk\yii2AliyunLogtarget;

use yii\base\InvalidConfigException;
use yii\log\Target;
use Yii;

require(dirname(__DIR__). '/aliyun-log-php-sdk/Log_Autoload.php');

class AliyunLogTarget extends Target
{
    public $endpoint = 'cn-shenzhen.sls.aliyuncs.com';
    public $accessKeyId = 'your_accesskeyid';
    public $accessKeySecret = 'your_accesskeysecret';
    public $project = 'your_project';
    public $logstore = 'your_logstore';

    public $topic = 'log';

    private $client;

    public function init()
    {
        if (!isset($this->accessKeyId)) {
            throw new InvalidConfigException(Yii::t('app','please configure your accesskeyid'));
        }
        if (!isset($this->accessKeySecret)) {
            throw new InvalidConfigException(Yii::t('app','please configure your accesskeysecret'));
        }
        $this->client = new \Aliyun_Log_Client($this->endpoint, $this->accessKeyId, $this->accessKeySecret);
    }


    function putLogs()
    {
        $contents[$this->topic] = '';
        foreach ($this->messages as $message) {
            $text = $this->formatMessage($message);
            $contents[$this->topic] .=  $text . PHP_EOL;
        }

        $logItem = new \Aliyun_Log_Models_LogItem();
        $logItem->setTime(time());
        $logItem->setContents($contents);
        $logitems = array($logItem);

        $request = new \Aliyun_Log_Models_PutLogsRequest($this->project, $this->logstore,
            $this->topic, null, $logitems);
        try {
            $response = $this->client->putLogs($request);
            $info = $response->getHeader('_info');
            return ($info['http_code']);
        } catch (\Aliyun_Log_Exception $ex) {
            return $ex->getErrorMessage();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function export()
    {
        $this->putLogs();
    }

    /**
     * 列出当前 project 下的所有日志库名称
     */
    public function listStores()
    {
        $req = new \Aliyun_Log_Models_ListLogstoresRequest($this->project);
        return $this->client->listLogstores($req);
    }

    /**
     * 创建 logstore
     */
    public function createStores()
    {
        $req = new \Aliyun_Log_Models_CreateLogstoreRequest($this->project, $this->logstore, 3, 2);
        return $this->client->createLogstore($req);
    }
}