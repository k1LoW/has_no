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
    private $contain;

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

        if (empty($config['init']) || $config['init'] === true) {
            $this->hasNo($model, false);
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
    public function hasNo(Model $model, $reset = false){
        $this->contain = array();
        return $this->contain;
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
                array_push($this->contain, $assocModel);
            }
        }
        return $this->contain;
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
        $this->contain = array_unique(array_merge($this->contain, (array)$conditions));
    }

    /**
     * beforeFind
     *
     */
    public function beforeFind(Model $model, $queryData){
        if (!isset($queryData['contain'])) {
            $queryData['contain'] = $this->contain;
        }
        return $queryData;
    }
  }
