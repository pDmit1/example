<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lesson`.
 */
class m170514_125900_create_lesson_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lesson', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->text(),
            'content'=>$this->text(),
            'image'=>$this->string(),
            'user_id'=>$this->integer(),
            'status'=>$this->integer(),
            'program_id'=>$this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lesson');
    }
}
