<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Post resource model
 */
class Post extends AbstractDb
{
    public const MAIN_TABLE = 'rubenromao_blog_post';
    public const ID_FIELD_NAME = 'id';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
