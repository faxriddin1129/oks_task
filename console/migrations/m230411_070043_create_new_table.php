<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%new}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%category}}`
 */
class m230411_070043_create_new_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%new}}', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'title' => $this->text(),
            'description' => $this->text(),
            'new_owner' => $this->text(),
            'new_date' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-new-file_id}}',
            '{{%new}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-new-file_id}}',
            '{{%new}}',
            'file_id',
            '{{%file}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-new-created_by}}',
            '{{%new}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-new-created_by}}',
            '{{%new}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-new-updated_by}}',
            '{{%new}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-new-updated_by}}',
            '{{%new}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-new-category_id}}',
            '{{%new}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-new-category_id}}',
            '{{%new}}',
            'category_id',
            '{{%category}}',
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
            '{{%fk-new-file_id}}',
            '{{%new}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-new-file_id}}',
            '{{%new}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-new-created_by}}',
            '{{%new}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-new-created_by}}',
            '{{%new}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-new-updated_by}}',
            '{{%new}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-new-updated_by}}',
            '{{%new}}'
        );

        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-new-category_id}}',
            '{{%new}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-new-category_id}}',
            '{{%new}}'
        );

        $this->dropTable('{{%new}}');
    }
}
