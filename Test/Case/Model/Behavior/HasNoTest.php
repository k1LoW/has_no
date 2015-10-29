<?php
App::uses('Model', 'Model');
App::uses('AppModel', 'Model');

class HasNoPost extends CakeTestModel{

    public $name = 'HasNoPost';
    public $actsAs = array(
        'HasNo.HasNo',
    );

    public $hasOne = array(
        'HasNoMemo' => array(
            'className' => 'HasNoMemo',
            'foreignKey' => 'has_no_post_id',
            'dependent' => true,
        )
    );

    public $hasMany = array(
        'HasNoComment' => array(
            'className' => 'HasNoComment',
            'foreignKey' => 'has_no_post_id',
            'dependent' => true,
        )
    );

    public $hasAndBelongsToMany = array(
        'HasNoTag'
    );

}

class HasNoMemo extends CakeTestModel{

    public $name = 'HasNoMemo';
    public $actsAs = array('HasNo.HasNo');

    public $belongsTo = array(
        'HasNoPost' => array(
            'className' => 'HasNoPost',
            'foreignKey' => 'has_no_post_id',
        )
    );
}

class HasNoComment extends CakeTestModel{

    public $name = 'HasNoComment';
    public $actsAs = array('HasNo.HasNo');

    public $belongsTo = array(
        'HasNoPost' => array(
            'className' => 'HasNoPost',
            'foreignKey' => 'has_no_post_id',
        )
    );
}

class HasNoTag extends CakeTestModel{
    public $name = 'HasNoTag';
    public $actsAs = array('HasNo.HasNo');

}

class HasNoPostsHasNoTag extends CakeTestModel{
    public $name = 'HasNoPostsHasNoTag';
    public $actsAs = array('HasNo.HasNo');
}

class HasNoTestCase extends CakeTestCase{

    public $fixtures = array(
        'plugin.HasNo.has_no_post',
        'plugin.HasNo.has_no_memo',
        'plugin.HasNo.has_no_comment',
        'plugin.HasNo.has_no_posts_has_no_tag',
        'plugin.HasNo.has_no_tag',
    );

    public function setUp() {
        $this->HasNoPost = new HasNoPost();
        $this->HasNoPost->setUp();
    }

    public function tearDown() {
        unset($this->HasNoPost);
    }

    /**
     * testHasNo
     *
     */
    public function testHasNo(){
        $result = $this->HasNoPost->find('first');
        $expect = array (
            'HasNoPost' => array (
                'id' => '1',
                'title' => 'Title',
                'body' => 'HasNo Test',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
        );
        $result = $this->fitPostgresResult($result);
        $this->assertIdentical($result, $expect);
    }

    /**
     * testHas
     *
     */
    public function testHas(){
        $this->HasNoPost->has('HasNoMemo');
        $result = $this->HasNoPost->find('first');
        $expect = array (
            'HasNoPost' => array (
                'id' => '1',
                'title' => 'Title',
                'body' => 'HasNo Test',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
            'HasNoMemo' => array (
                'id' => '1',
                'has_no_post_id' => '1',
                'memo' => 'Memo',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
        );
        $result = $this->fitPostgresResult($result);
        $this->assertIdentical($result, $expect);
    }

    /**
     * testHasMulti
     *
     */
    public function testHasMulti(){
        $this->HasNoPost->has(array('HasNoMemo', 'HasNoComment'));
        $result = $this->HasNoPost->find('first');
        $expect = array (
            'HasNoPost' => array (
                'id' => '1',
                'title' => 'Title',
                'body' => 'HasNo Test',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
            'HasNoMemo' => array (
                'id' => '1',
                'has_no_post_id' => '1',
                'memo' => 'Memo',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
            'HasNoComment' => array (
                0 => array (
                    'id' => '1',
                    'has_no_post_id' => '1',
                    'comment' => 'Comment',
                    'created' => '2012-07-05 00:00:00',
                    'modified' => '2012-07-05 00:00:00',
                ),
                1 => array (
                    'id' => '2',
                    'has_no_post_id' => '1',
                    'comment' => 'Comment2',
                    'created' => '2012-07-05 00:00:00',
                    'modified' => '2012-07-05 00:00:00',
                ),
            ),
        );
        $result = $this->fitPostgresResult($result);
        $this->assertIdentical($result, $expect);
    }

    /**
     * testHasAll
     *
     */
    public function testHasAll(){
        $this->HasNoPost->hasAll();
        $result = $this->HasNoPost->find('first');
        $expect = array (
            'HasNoPost' => array (
                'id' => '1',
                'title' => 'Title',
                'body' => 'HasNo Test',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
            'HasNoMemo' => array (
                'id' => '1',
                'has_no_post_id' => '1',
                'memo' => 'Memo',
                'created' => '2012-07-05 00:00:00',
                'modified' => '2012-07-05 00:00:00',
            ),
            'HasNoComment' => array (
                0 => array (
                    'id' => '1',
                    'has_no_post_id' => '1',
                    'comment' => 'Comment',
                    'created' => '2012-07-05 00:00:00',
                    'modified' => '2012-07-05 00:00:00',
                ),
                1 => array (
                    'id' => '2',
                    'has_no_post_id' => '1',
                    'comment' => 'Comment2',
                    'created' => '2012-07-05 00:00:00',
                    'modified' => '2012-07-05 00:00:00',
                ),
            ),
            'HasNoTag' => array (
                0 => array (
                    'id' => '1',
                    'tag' => 'Tag',
                    'created' => '2012-07-05 00:00:00',
                    'modified' => '2012-07-05 00:00:00',
                    'HasNoPostsHasNoTag' => array (
                        'id' => '1',
                        'has_no_post_id' => '1',
                        'has_no_tag_id' => '1',
                        'created' => '2012-07-05 00:00:00',
                        'modified' => '2012-07-05 00:00:00',
                    ),
                ),
                1 => array (
                    'id' => '2',
                    'tag' => 'Tag2',
                    'created' => '2012-07-05 00:00:00',
                    'modified' => '2012-07-05 00:00:00',
                    'HasNoPostsHasNoTag' => array (
                        'id' => '2',
                        'has_no_post_id' => '1',
                        'has_no_tag_id' => '2',
                        'created' => '2012-07-05 00:00:00',
                        'modified' => '2012-07-05 00:00:00',
                    ),
                ),
            ),
        );
        $result = $this->fitPostgresResult($result);
        $this->assertIdentical($result, $expect);
    }

    /**
     * fitPostgresResult
     * PostgreSQL return integer / MySQL return string
     *
     */
    private function fitPostgresResult($result){
        $func = function(&$value) {
            if (is_int($value)) {
                $value = (string)$value;
            }
        };
        array_walk_recursive($result, $func);
        return $result;
    }
}
