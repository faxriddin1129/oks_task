<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%useful_link}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230411_065306_create_useful_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%useful_link}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'title' => $this->text(),
            'url' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-useful_link-file_id}}',
            '{{%useful_link}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-useful_link-file_id}}',
            '{{%useful_link}}',
            'file_id',
            '{{%file}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-useful_link-created_by}}',
            '{{%useful_link}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-useful_link-created_by}}',
            '{{%useful_link}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-useful_link-updated_by}}',
            '{{%useful_link}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-useful_link-updated_by}}',
            '{{%useful_link}}',
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
            '{{%fk-useful_link-file_id}}',
            '{{%useful_link}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-useful_link-file_id}}',
            '{{%useful_link}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-useful_link-created_by}}',
            '{{%useful_link}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-useful_link-created_by}}',
            '{{%useful_link}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-useful_link-updated_by}}',
            '{{%useful_link}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-useful_link-updated_by}}',
            '{{%useful_link}}'
        );

        $this->dropTable('{{%useful_link}}');
    }
}
