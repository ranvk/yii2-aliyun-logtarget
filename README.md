# yii2-aliyun-logtarget
阿里云log 使用logtarget 记录日志


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```

php composer.phar require --prefer-dist ranvk/yii2-aliyun-logtarget
```

or add

```json
"ranvk/yii2-aliyun-logtarget": "dev-master"
```

Usage
-----

To use this extension,  simply add the following code in your application configuration:

```php
return [
    //....
    'components' => [
        'log' => [
            'targets' => [
                [
                    'levels' => ['error', 'warning', 'info'],
                    'class' => 'Ranvk\yii2AliyunLogtarget\AliyunLogTarget',
                    'logstore' => 'your_logstore',
                    'topic' => YII_ENV,
                    'project' => 'your_project',
                    'accessKeyId' => 'your_accessKeyId',
                    'accessKeySecret' => 'your_accessKeySecret',
                    'endpoint' => 'aliyun_endpoint',
                ],
            
            ],
        ],
    ],
];
```