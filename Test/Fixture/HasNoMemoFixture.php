<?php
class HasNoMemoFixture extends CakeTestFixture {
    public $name = 'HasNoMemo';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
        'has_no_post_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
        'memo' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    );

    public $records = array(
        array(
            'has_no_post_id' => '1',
            'memo' => 'Memo',
            'created' => '2012-07-05 00:00:00',
            'modified' => '2012-07-05 00:00:00',
        ),
        array(
            'has_no_post_id' => '2',
            'memo' => 'Memo2',
            'created' => '2012-07-05 00:00:00',
            'modified' => '2012-07-05 00:00:00',
        ),
    );
}
