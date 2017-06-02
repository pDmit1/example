<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lesson_user`.
 */
class m170514_140542_create_lesson_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lesson_user', [
            'id' => $this->primaryKey(),
            'lesson_id'=>$this->integer(),
            'user_id'=>$this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'tag_article_article_id',
            'lesson_user',
            'lesson_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'tag_article_article_id',
            'lesson_user',
            'lesson_id',
            'lesson',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'idx_tag_id',
            'lesson_user',
            'user_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-tag_id',
            'lesson_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lesson_user');
    }
}
