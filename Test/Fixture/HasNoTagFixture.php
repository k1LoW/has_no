<?php
class HasNoTagFixture extends CakeTestFixture {
    public $name = 'HasNoTag';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
        'tag' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    );

    public $records = array(
        array(
            'tag' => 'Tag',
            'created' => '2012-07-05 00:00:00',
            'modified' => '2012-07-05 00:00:00',
        ),
        array(
            'tag' => 'Tag2',
            'created' => '2012-07-05 00:00:00',
            'modified' => '2012-07-05 00:00:00',
        ),
    );
}
