<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 *
 * @package Rubenromao\BlogPosts\Model\ResourceModel
 */
class Post extends AbstractDb
{
    public const MAIN_TABLE = 'rubenromao_blog_post';
    public const ID_FIELD_NAME = 'id';

    protected function _construct(): void
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
