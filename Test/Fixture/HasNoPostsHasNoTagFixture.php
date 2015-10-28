<?php
class HasNoPostsHasNoTagFixture extends CakeTestFixture {
    public $name = 'HasNoPostsHasNoTag';

    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
        'has_no_post_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
        'has_no_tag_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
    );

    public $records = array(
        array(
            'has_no_post_id' => 1,
            'has_no_tag_id' => 1,
            'created' => '2012-07-05 00:00:00',
            'modified' => '2012-07-05 00:00:00',
        ),
        array(
            'has_no_post_id' => 1,
            'has_no_tag_id' => 2,
            'created' => '2012-07-05 00:00:00',
            'modified' => '2012-07-05 00:00:00',
        ),
    );
}
