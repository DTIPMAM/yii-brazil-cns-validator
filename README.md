<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://yiisoft.github.io/docs/images/yii_logo.svg" height="100px">
    </a>
    <h1 align="center">Yii1 Brazil CNS validator</h1>
    <br>
</p>

The package provides Yii validation capabilities for Brazil's National Health Card (Cartão Nacional de Saúde do SUS).

We know that Yii1 isn't being maintained anymore, but this will be helpful for legacy applications.

## Compatibility
- Working in Yii 1.1.23

## Requirements
- PHP 7.4 or higher.

## Installation

The package could be installed with composer:

```shell
composer require dtipmam/yii-brazil-cns-validator --prefer-dist
```

## General usage

Library could be used validating a Yii1 model's field that store be the CNS number.

### Validating attribute in a CActiveRecord model class

```php
public function rules() {
    array('cadastro_nacional_saude_sus', '\Dtipmam\YiiValidator\CnsValidator');
}
```

## Credits
Code based on Diego Aguiar's project: https://github.com/diegoraguiar/ngx-brazilian-helpers

## TODO
* Unit tests
* infection-static-analysis-plugin, phpunit-watcher and psalm for development use