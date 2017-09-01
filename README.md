yii2-gii
=

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require mirkhamidov/yii2-gii "*"
```




Configure
-----
add this lines to main-local.php config

```php

if (!YII_ENV_TEST) {
    ...
    
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [ //here
            'model' => [ // generator name
                'class' => 'mirkhamidov\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'myModel' => '@mirkhamidov/gii/generators/model/default', // template name => path to template
                ]
            ],
            'crud' => [ // generator name
                'class' => 'mirkhamidov\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'myCrud' => '@mirkhamidov/gii/generators/crud/default', // template name => path to template
                ]
            ],
        ],
    ];
}

```
