<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $url
 * @property int|null $parent_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property Menu[] $menus
 * @property Menu $parent
 * @property User $updatedBy
 */
class Menu extends \yii\db\ActiveRecord
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
        return '{{%menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['title'], 'string'],
            [['parent_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['parent_id' => 'id']],
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
            'title' => 'Title',
            'url' => 'Url',
            'parent_id' => 'Parent ID',
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
     * Gets query for [[Menus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menu::class, ['id' => 'parent_id']);
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
            'url',
            'parent_id',
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
            'parent' => function($model){
                return $model->parent;
            },
        ];
    }
}
