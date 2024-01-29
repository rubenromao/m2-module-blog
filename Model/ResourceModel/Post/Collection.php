<?php
declare(strict_types=1);

namespace RubenRomao\BlogPosts\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use RubenRomao\BlogPosts\Model\Post;
use RubenRomao\BlogPosts\Model\ResourceModel\Post as PostResourceModel;

/**
 * Post Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Collection initialization
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Post::class, PostResourceModel::class);
    }
}
