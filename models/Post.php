<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class Post
 *
 * @package app\models
 */
class Post extends AbstractActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [];
    }

    ### relations

    ### functions
}