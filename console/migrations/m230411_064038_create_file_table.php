<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230411_064038_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-file-created_by}}',
            '{{%file}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-file-created_by}}',
            '{{%file}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-file-updated_by}}',
            '{{%file}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-file-updated_by}}',
            '{{%file}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-file-created_by}}',
            '{{%file}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-file-created_by}}',
            '{{%file}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-file-updated_by}}',
            '{{%file}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-file-updated_by}}',
            '{{%file}}'
        );

        $this->dropTable('{{%file}}');
    }
}
