<?php

namespace common\components;

class ActiveRecord extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;

    public function delete()
    {
        $this->updateAttributes(['status' => $this::STATUS_DELETED]);
    }
}
