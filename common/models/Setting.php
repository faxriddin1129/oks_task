<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property int $id
 * @property string|null $site_name
 * @property int|null $file_id
 * @property string|null $phone
 * @property string|null $telegram_url
 * @property string|null $facebook_url
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $youtube
 * @property string|null $email
 * @property string|null $lat
 * @property string|null $lon
 * @property string|null $footer_text
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property File $file
 * @property User $updatedBy
 */
class Setting extends \yii\db\ActiveRecord
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
        return '{{%setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'footer_text', 'site_name', 'telegram_url', 'facebook_url', 'twitter', 'instagram', 'youtube', 'email', 'lat', 'lon', 'phone'], 'required'],
            [['file_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['footer_text'], 'string'],
            [['site_name', 'telegram_url', 'facebook_url', 'twitter', 'instagram', 'youtube', 'email', 'lat', 'lon'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 13],
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
            'site_name' => 'Site Name',
            'file_id' => 'File ID',
            'phone' => 'Phone',
            'telegram_url' => 'Telegram Url',
            'facebook_url' => 'Facebook Url',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube',
            'email' => 'Email',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'footer_text' => 'Footer Text',
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
            'site_name',
            'file_id',
            'phone',
            'telegram_url',
            'facebook_url',
            'twitter',
            'instagram',
            'youtube',
            'email',
            'lat',
            'lon',
            'footer_text',
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
