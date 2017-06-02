<?php

use yii\db\Migration;

/**
 * Handles the creation of table `program`.
 */
class m170514_120506_create_program_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('program', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->text(),
            'content'=>$this->text(),
            'image'=>$this->string(),
            'status'=>$this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('program');
    }
}
