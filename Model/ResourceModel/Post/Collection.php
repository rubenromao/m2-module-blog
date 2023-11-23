<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Rubenromao\BlogPosts\Model\Post;
use Rubenromao\BlogPosts\Model\ResourceModel\Post as PostResourceModel;

/**
 * Class Collection
 *
 * @package Rubenromao\BlogPosts\Model\ResourceModel\Post
 */
class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Post::class, PostResourceModel::class);
    }
}
