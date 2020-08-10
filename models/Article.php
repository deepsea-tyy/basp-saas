<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property int|null $user_id 发表者id
 * @property int|null $owner_id
 * @property int|null $cat_id 分类id
 * @property string|null $keywords seo keywords
 * @property string|null $reprint_info 转载文章的来源说明
 * @property string|null $title 文章标题
 * @property string|null $image_id 封面
 * @property string|null $brief 文章摘要
 * @property string|null $content 文章内容
 * @property int|null $parent_id 文章的父级文章 id,表示文章层级关系
 * @property int|null $type 文章类型，1文章,2页面
 * @property int|null $comments_count 评论数
 * @property int|null $view_count 浏览数
 * @property int|null $like_count 文章赞数
 * @property int|null $is_comment 评论1允许，2不允许
 * @property int|null $is_top 1置顶 2不置顶
 * @property int|null $is_recommend 推荐 1推荐 2不推荐
 * @property int|null $release_at 文章发布日期
 * @property int|null $status 1正常 2删除 3未通过审核
 * @property int|null $created_at
 * @property int|null $updated_at 文章更新时间，可在前台修改，显示给用户
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'owner_id', 'cat_id', 'parent_id', 'type', 'comments_count', 'view_count', 'like_count', 'is_comment', 'is_top', 'is_recommend', 'release_at', 'status', 'created_at', 'updated_at'], 'integer'],
            [['brief', 'content'], 'string'],
            [['keywords', 'title'], 'string', 'max' => 255],
            [['reprint_info'], 'string', 'max' => 150],
            [['image_id'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'owner_id' => 'Owner ID',
            'cat_id' => 'Cat ID',
            'keywords' => 'Keywords',
            'reprint_info' => 'Reprint Info',
            'title' => 'Title',
            'image_id' => 'Image ID',
            'brief' => 'Brief',
            'content' => 'Content',
            'parent_id' => 'Parent ID',
            'type' => 'Type',
            'comments_count' => 'Comments Count',
            'view_count' => 'View Count',
            'like_count' => 'Like Count',
            'is_comment' => 'Is Comment',
            'is_top' => 'Is Top',
            'is_recommend' => 'Is Recommend',
            'release_at' => 'Release At',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
