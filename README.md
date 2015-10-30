# Simple binding model practice plugin for CakePHP. [![Build Status](https://travis-ci.org/k1LoW/has_no.svg)](https://travis-ci.org/k1LoW/has_no)

This plugin support following binding model practice.

> Bake and write bind property on model file.
> unbindModel() all.
> bindModel() you want to.

## Features

* unbindModel() all by Model::belongsTo, Model::hasOne, Model::hasMany, Model::hasAndBelongsToMany.
* Provide simple bind model method has(), hasAll() by Model::belongsTo, Model::hasOne, Model::hasMany, Model::hasAndBelongsToMany.

## !!!!!NOTICE!!!!!

### HasNo 3.x

Containable based

### HasNo 2.x

Property modifiy based

## Usage

Add the following code in whichever model you want to unbindModel() all (ex. `Post` Model).

```
<?php
class Post extends Model {
    public $actsAs = array('HasNo.HasNo');

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'post_id',
            'dependent' => false,
        )
    );

    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'className' => 'Tag',
            'joinTable' => 'posts_tags',
            'foreignKey' => 'post_id',
            'associationForeignKey' => 'tag_id',
            'unique' => true,
        )
    );

}
```

And if you want to use model's bind property, use method `$this->Post->has('Comment')` , `$this->Post->has(array('Comment', 'Tag'))` or `$this->Post->hasAll()` .

## License

under MIT License
