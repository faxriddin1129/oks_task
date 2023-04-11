<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%menu}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230411_065023_create_menu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'url' => $this->string(),
            'parent_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            '{{%idx-menu-parent_id}}',
            '{{%menu}}',
            'parent_id'
        );

        // add foreign key for table `{{%menu}}`
        $this->addForeignKey(
            '{{%fk-menu-parent_id}}',
            '{{%menu}}',
            'parent_id',
            '{{%menu}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-menu-created_by}}',
            '{{%menu}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-menu-created_by}}',
            '{{%menu}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-menu-updated_by}}',
            '{{%menu}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-menu-updated_by}}',
            '{{%menu}}',
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
        // drops foreign key for table `{{%menu}}`
        $this->dropForeignKey(
            '{{%fk-menu-parent_id}}',
            '{{%menu}}'
        );

        // drops index for column `parent_id`
        $this->dropIndex(
            '{{%idx-menu-parent_id}}',
            '{{%menu}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-menu-created_by}}',
            '{{%menu}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-menu-created_by}}',
            '{{%menu}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-menu-updated_by}}',
            '{{%menu}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-menu-updated_by}}',
            '{{%menu}}'
        );

        $this->dropTable('{{%menu}}');
    }
}
