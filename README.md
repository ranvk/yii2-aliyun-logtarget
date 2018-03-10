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
"ranvk/yii2-aliyun-logtarget"
```

to the require section of your composer.json.

> Note: Version 2.1 of this extensions uses Swiftmailer 6, which requires PHP 7. If you are using PHP 5, 
> you have to use version 2.0 of this extension, which uses Swiftmailer 5, which is compatible with 
> PHP 5.4 and higher. Use the following version constraint in that case:
> 
> ```json
> "ranvk/yii2-aliyun-logtarget"
> ```

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