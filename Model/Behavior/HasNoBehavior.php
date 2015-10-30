<?php

  /**
   * Simple binding model practice plugin for CakePHP.
   *
   */
  /**
   * HasNoBehavior code license:
   *
   * @copyright   Copyright (C) 2010-2015 by 101000code/101000LAB
   * @since       CakePHP(tm) v 2.0
   * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
   */
class HasNoBehavior extends ModelBehavior {

    private $model;
    private $modelName;
    private $contain = array();

    /**
     * setup
     *
     * @param $model
     * @param $config
     */
    public function setUp(Model $model, $config = array()){

        $this->model = $model;
        $this->modelName = $model->alias;
        $this->model->Behaviors->unload('Containable');
        $this->model->Behaviors->load('Containable');
        $this->model->Behaviors->enable('Containable');
        $this->contain[$this->modelName] = false;

        if (empty($config['init']) || $config['init'] === true) {
            $this->hasNo($model);
        }
    }

    /**
     * hasNo
     * unbind all association by Model::belongsTo, Model::hasOne, Model::hasMany, Model::hasAndBelongsToMany
     *
     * @param Model $model
     * @param $reset
     * @return
     */
    public function hasNo(Model $model){
        $this->contain[$this->modelName] = array();
        return $this->contain[$this->modelName];
    }

    /**
     * hasAll
     * bind all association by Model::belongsTo, Model::hasOne, Model::hasMany, Model::hasAndBelongsToMany
     *
     * @param Model $model
     * @param $reset
     * @return
     */
    public function hasAll(Model $model, $reset = false){
        $associations = array('belongsTo', 'hasOne', 'hasMany', 'hasAndBelongsToMany');
        foreach ($associations as $assoc) {
            if (empty($model->{$assoc})) {
                continue;
            }
            foreach ($model->{$assoc} as $assocModel => $param) {
                array_push($this->contain[$this->modelName], $assocModel);
            }
        }
        return $this->contain[$this->modelName];
    }

    /**
     * has
     * bind association
     *
     * @param Model $model
     * @param $conditions
     * @param $reset
     * @return
     */
    public function has(Model $model, $conditions = null){
        if (empty($conditions)) {
            return $this->hasAll($model);
        }
        $this->contain[$this->modelName] = array_unique(array_merge($this->contain[$this->modelName], (array)$conditions));
        return $this->contain[$this->modelName];
    }

    /**
     * beforeFind
     *
     */
    public function beforeFind(Model $model, $queryData){
        if (!isset($queryData['contain']) && $this->contain[$this->modelName] !== false) {
            $queryData['contain'] = $this->contain[$this->modelName];
        }
        return $queryData;
    }
  }
