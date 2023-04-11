<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%indicator}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230411_070626_create_indicator_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%indicator}}', [
            'id' => $this->primaryKey(),
            'short_title' => $this->text(),
            'title' => $this->text(),
            'indicator' => $this->string(),
            'file_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-indicator-file_id}}',
            '{{%indicator}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-indicator-file_id}}',
            '{{%indicator}}',
            'file_id',
            '{{%file}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-indicator-created_by}}',
            '{{%indicator}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-indicator-created_by}}',
            '{{%indicator}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-indicator-updated_by}}',
            '{{%indicator}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-indicator-updated_by}}',
            '{{%indicator}}',
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
        // drops foreign key for table `{{%file}}`
        $this->dropForeignKey(
            '{{%fk-indicator-file_id}}',
            '{{%indicator}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-indicator-file_id}}',
            '{{%indicator}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-indicator-created_by}}',
            '{{%indicator}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-indicator-created_by}}',
            '{{%indicator}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-indicator-updated_by}}',
            '{{%indicator}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-indicator-updated_by}}',
            '{{%indicator}}'
        );

        $this->dropTable('{{%indicator}}');
    }
}
