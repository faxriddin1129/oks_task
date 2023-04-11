<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%useful_link}}".
 *
 * @property int $id
 * @property int|null $file_id
 * @property string|null $title
 * @property string|null $url
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property File $file
 * @property User $updatedBy
 */
class UsefulLink extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%useful_link}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'title', 'url'], 'required'],
            [['file_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string'],
            [['url'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'title' => 'Title',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'file_id',
            'url',
        ];
    }

    public function extraFields()
    {
        return [
            'owner' => function($model){
                return [
                    'created_by' => [
                        'user_id' => $model->created_by,
                        'username' => $model->createdBy->username,
                    ],
                    'updated_by' => [
                        'user_id' => $model->updated_by,
                        'username' => $model->updatedBy->username,
                    ],
                ];
            },
            'time' => function($model){
                return [
                    'created_at' => [
                        'time' => $model->created_at,
                        'format' => date('Y-m-d H:i', $model->created_at),
                    ],
                    'updated_at' => [
                        'time' => $model->updated_at,
                        'format' => date('Y-m-d H:i', $model->updated_at),
                    ],
                ];
            },
            'file' => function($model){
                return $model->file;
            },
        ];
    }
}
