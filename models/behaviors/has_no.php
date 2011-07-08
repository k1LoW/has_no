<?php

  /**
   * Simple binding model practice plugin for CakePHP.
   *
   */
  /**
   * HasNoBehavior code license:
   *
   * @copyright   Copyright (C) 2010 by 101000code/101000LAB
   * @since       CakePHP(tm) v 1.3
   * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
   */
class HasNoBehavior extends ModelBehavior {

    var $belongsTo = array();
    var $hasOne = array();
    var $hasMany = array();
    var $hasAndBelongsToMany = array();
    var $modelName;

    /**
     * setup
     *
     * @param &$model
     * @param $config
     */
    function setup(&$model, $config = array()){

        $this->model = $model;
        $this->modelName = $model->alias;

        $this->belongsTo[$this->modelName] = (!empty($model->belongsTo)) ? $model->belongsTo : false;
        $this->hasOne[$this->modelName] = (!empty($model->hasOne)) ? $model->hasOne : false;
        $this->hasMany[$this->modelName] = (!empty($model->hasMany)) ? $model->hasMany : false;
        $this->hasAndBelongsToMany[$this->modelName] = (!empty($model->hasAndBelongsToMany)) ? $model->hasAndBelongsToMany : false;

        if (empty($config['init']) || $config['init'] === true) {
            $this->hasNo($model, false);
        }
    }

    /**
     * hasNo
     * unbind all association by Model::belongsTo, Model::hasOne, Model::hasMany, Model::hasAndBelongsToMany
     *
     * @param &$model
     * @param $reset
     * @return
     */
    function hasNo(&$model, $reset = false){
        $this->modelName = $model->alias;
        $this->_makeAssociation(null, false);
        return $model->unbindModel($this->model->hasNoAssociation, $reset);
    }

    /**
     * hasAll
     * bind all association by Model::belongsTo, Model::hasOne, Model::hasMany, Model::hasAndBelongsToMany
     *
     * @param &$model
     * @param $reset
     * @return
     */
    function hasAll(&$model, $reset = false){
        $this->modelName = $model->alias;
        $this->_makeAssociation(null, true);
        return $model->bindModel($this->model->hasNoAssociation, $reset);
    }

    /**
     * has
     * bind association
     *
     * @param &$model
     * @param $conditions
     * @param $reset
     * @return
     */
    function has(&$model, $conditions = null, $reset = false){
        $this->modelName = $model->alias;
        $this->_makeAssociation($conditions, true);
        return $model->bindModel($this->model->hasNoAssociation, $reset);
    }

    /**
     * _makeAssociation
     *
     * @param $conditions
     * @param $bind
     * @return
     */
    function _makeAssociation($conditions = null, $bind = true){
        $this->model->hasNoAssociation = array();
        if (empty($conditions)) {
            if (!empty($this->belongsTo[$this->modelName])) {
                if ($bind) {
                    $this->model->hasNoAssociation['belongsTo'] = $this->belongsTo[$this->modelName];
                } else {
                    $this->model->hasNoAssociation['belongsTo'] = array_keys($this->belongsTo[$this->modelName]);
                }
            }

            if (!empty($this->hasOne[$this->modelName])) {
                if ($bind) {
                    $this->model->hasNoAssociation['hasOne'] = $this->hasOne[$this->modelName];
                } else {
                    $this->model->hasNoAssociation['hasOne'] = array_keys($this->hasOne[$this->modelName]);
                }
            }

            if (!empty($this->hasMany[$this->modelName])) {
                if ($bind) {
                    $this->model->hasNoAssociation['hasMany'] = $this->hasMany[$this->modelName];
                } else {
                    $this->model->hasNoAssociation['hasMany'] = array_keys($this->hasMany[$this->modelName]);
                }
            }

            if (!empty($this->hasAndBelongsToMany[$this->modelName])) {
                if ($bind) {
                    $this->model->hasNoAssociation['hasAndBelongsToMany'] = $this->hasAndBelongsToMany[$this->modelName];
                } else {
                    $this->model->hasNoAssociation['hasAndBelongsToMany'] = array_keys($this->hasAndBelongsToMany[$this->modelName]);
                }
            }
            return;
        }

        if (is_string($conditions)) {
            $conditions = array($conditions);
        }

        if (is_array($conditions)) {
            if (!empty($this->belongsTo[$this->modelName]) && array_intersect(array_keys($this->belongsTo[$this->modelName]), $conditions)) {
                if ($bind) {
                    $this->model->hasNoAssociation['belongsTo'] = array_intersect_key($this->belongsTo[$this->modelName], array_flip($conditions));
                } else {
                    $this->model->hasNoAssociation['belongsTo'] = array_intersect(array_keys($this->belongsTo[$this->modelName]), $conditions);
                }
            }

            if (!empty($this->hasOne[$this->modelName]) && array_intersect(array_keys($this->hasOne[$this->modelName]), $conditions)) {
                if ($bind) {
                    $this->model->hasNoAssociation['hasOne'] = array_intersect_key($this->hasOne[$this->modelName], array_flip($conditions));
                } else {
                    $this->model->hasNoAssociation['hasOne'] = array_intersect(array_keys($this->hasOne[$this->modelName]), $conditions);
                }
            }

            if (!empty($this->hasMany[$this->modelName]) && array_intersect(array_keys($this->hasMany[$this->modelName]), $conditions)) {
                if ($bind) {
                    $this->model->hasNoAssociation['hasMany'] = array_intersect_key($this->hasMany[$this->modelName], array_flip($conditions));
                } else {
                    $this->model->hasNoAssociation['hasMany'] = array_intersect(array_keys($this->hasMany[$this->modelName]), $conditions);
                }
            }

            if (!empty($this->hasAndBelongsToMany[$this->modelName]) && array_intersect(array_keys($this->hasAndBelongsToMany[$this->modelName]), $conditions)) {
                if ($bind) {
                    $this->model->hasNoAssociation['hasAndBelongsToMany'] = array_intersect_key($this->hasAndBelongsToMany[$this->modelName], array_flip($conditions));
                } else {
                    $this->model->hasNoAssociation['hasAndBelongsToMany'] = array_intersect(array_keys($this->hasAndBelongsToMany[$this->modelName]), $conditions);
                }
            }
            return;
        }
    }

  }