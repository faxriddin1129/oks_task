<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%file}}`
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m230411_064719_create_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'site_name' => $this->string(),
            'file_id' => $this->integer(),
            'phone' => $this->string(13),
            'telegram_url' => $this->string(),
            'facebook_url' => $this->string(),
            'twitter' => $this->string(),
            'instagram' => $this->string(),
            'youtube' => $this->string(),
            'email' => $this->string(),
            'lat' => $this->string(),
            'lon' => $this->string(),
            'footer_text' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `file_id`
        $this->createIndex(
            '{{%idx-setting-file_id}}',
            '{{%setting}}',
            'file_id'
        );

        // add foreign key for table `{{%file}}`
        $this->addForeignKey(
            '{{%fk-setting-file_id}}',
            '{{%setting}}',
            'file_id',
            '{{%file}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-setting-created_by}}',
            '{{%setting}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-setting-created_by}}',
            '{{%setting}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-setting-updated_by}}',
            '{{%setting}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-setting-updated_by}}',
            '{{%setting}}',
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
            '{{%fk-setting-file_id}}',
            '{{%setting}}'
        );

        // drops index for column `file_id`
        $this->dropIndex(
            '{{%idx-setting-file_id}}',
            '{{%setting}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-setting-created_by}}',
            '{{%setting}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-setting-created_by}}',
            '{{%setting}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-setting-updated_by}}',
            '{{%setting}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-setting-updated_by}}',
            '{{%setting}}'
        );

        $this->dropTable('{{%setting}}');
    }
}
