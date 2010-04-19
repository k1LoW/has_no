<?php

  /**
   * HasNo: hasNo() plugin for CakePHP.
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

    var $belongsTo;
    var $hasOne;
    var $hasMany;
    var $hasAndBelongsToMany;
    var $association = array();

    /**
     * setup
     *
     * @param &$model
     * @param $config
     */
    function setup(&$model, $config = array()){

        $this->belongsTo = (!empty($model->belongsTo)) ? $model->belongsTo : false;
        $this->hasOne = (!empty($model->hasOne)) ? $model->hasOne : false;
        $this->hasMany = (!empty($model->hasMany)) ? $model->hasMany : false;
        $this->hasAndBelongsToMany = (!empty($model->hasAndBelongsToMany)) ? $model->hasAndBelongsToMany : false;

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
        $this->_makeAssociation(null, false);
        return $model->unbindModel($this->association, $reset);
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
        $this->_makeAssociation(null, true);
        return $model->bindModel($this->association, $reset);
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
        $this->_makeAssociation($conditions, true);
        return $model->bindModel($this->association, $reset);
    }

    /**
     * _makeAssociation
     *
     * @param $conditions
     * @param $bind
     * @return
     */
    function _makeAssociation($conditions = null, $bind = true){
        $this->association = array();
        if (empty($conditions)) {
            if (!empty($this->belongsTo)) {
                if ($bind) {
                    $this->association['belongsTo'] = $this->belongsTo;
                } else {
                    $this->association['belongsTo'] = array_keys($this->belongsTo);
                }
            }

            if (!empty($this->hasOne)) {
                if ($bind) {
                    $this->association['hasOne'] = $this->hasOne;
                } else {
                    $this->association['hasOne'] = array_keys($this->hasOne);
                }
            }

            if (!empty($this->hasMany)) {
                if ($bind) {
                    $this->association['hasMany'] = $this->hasMany;
                } else {
                    $this->association['hasMany'] = array_keys($this->hasMany);
                }
            }

            if (!empty($this->hasAndBelongsToMany)) {
                if ($bind) {
                    $this->association['hasAndBelongsToMany'] = $this->hasAndBelongsToMany;
                } else {
                    $this->association['hasAndBelongsToMany'] = array_keys($this->hasAndBelongsToMany);
                }
            }
            return;
        }

        if (is_string($conditions)) {
            $conditions = array($conditions);
        }

        if (is_array($conditions)) {
            if (!empty($this->belongsTo) && array_intersect(array_keys($this->belongsTo), $conditions)) {
                if ($bind) {
                    $this->association['belongsTo'] = array_intersect_key($this->belongsTo, array_flip($conditions));
                } else {
                    $this->association['belongsTo'] = array_intersect(array_keys($this->belongsTo), $conditions);
                }
            }

            if (!empty($this->hasOne) && array_intersect(array_keys($this->hasOne), $conditions)) {
                if ($bind) {
                    $this->association['hasOne'] = array_intersect_key($this->hasOne, array_flip($conditions));
                } else {
                    $this->association['hasOne'] = array_intersect(array_keys($this->hasOne), $conditions);
                }
            }

            if (!empty($this->hasMany) && array_intersect(array_keys($this->hasMany), $conditions)) {
                if ($bind) {
                    $this->association['hasMany'] = array_intersect_key($this->hasMany, array_flip($conditions));
                } else {
                    $this->association['hasMany'] = array_intersect(array_keys($this->hasMany), $conditions);
                }
            }

            if (!empty($this->hasAndBelongsToMany) && array_intersect(array_keys($this->hasAndBelongsToMany), $conditions)) {
                if ($bind) {
                    $this->association['hasAndBelongsToMany'] = array_intersect_key($this->hasAndBelongsToMany, array_flip($conditions));
                } else {
                    $this->association['hasAndBelongsToMany'] = array_intersect(array_keys($this->hasAndBelongsToMany), $conditions);
                }
            }
            return;
        }
    }

  }