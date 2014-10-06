Banner module for Yii 2
=====


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webvimark/module-banner "*"
```

or add

```
"webvimark/module-banner": "*"
```

to the require section of your `composer.json` file.

Configuration
-------------

In your config/web.php

```php
	'modules'=>[
		...

		'banner' => [
			'class' => 'webvimark\modules\banner\BannerModule',
		],

		...
	],
```


Usage
-----

1 Go to http://site.com/banner/banner/index
