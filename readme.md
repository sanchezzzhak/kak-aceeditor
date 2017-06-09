AceEditor widgets
================
AceEditor widgets for Yii2

Preview
------------

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kak/aceeditor "dev-master"
```

or add

```
"kak/aceeditor": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php
    echo yii\helpers\Html::activeLabel($model,'html_wrap');  
    echo \kak\widgets\aceeditor\AceEditor::widget([
        // You can either use it for model attribute
        'model' => $model,
        'attribute' => 'html_wrap',
        'mode'=>'html', // programing language mode. Default "html"
        'theme'=>'github' // editor theme. Default "github"
    ]);
?>
```

