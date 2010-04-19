<?php

  /**
   *  CakePHP HasNo Plugin
   *
   *
   * @params
   */
class HasNoBehavior extends ModelBehavior {

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
     * unbind all association
     *
     * @param &$model
     * @param $reset
     * @return
     */
    function hasNo(&$model, $reset = false){
        $this->_makeAssociation();
        return $model->unbindModel($this->association, $reset);
    }

    /**
     * hasAll
     * reset all association
     *
     * @param &$model
     * @param $reset
     * @return
     */
    function hasAll(&$model, $reset = false){
        $this->_makeAssociation();
        return $model->bindModel($this->association, $reset);
    }

    /**
     * _makeAssociation
     *
     * @param $conditions
     * @return
     */
    function _makeAssociation($conditions = null){
        $this->association = array();
        if (empty($conditions)) {
            if (!empty($this->belongsTo)) {
                $this->association['belongsTo'] = array_keys($this->belongsTo);
            }

            if (!empty($this->hasOne)) {
                $this->association['hasOne'] = array_keys($this->hasOne);
            }

            if (!empty($this->hasMany)) {
                $this->association['hasMany'] = array_keys($this->hasMany);
            }

            if (!empty($this->hasAndBelongsToMany)) {
                $this->association['hasAndBelongsToMany'] = array_keys($this->hasAndBelongsToMany);
            }
        }
    }

  }