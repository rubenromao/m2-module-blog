<?php declare(strict_types=1);

namespace Rubenromao\Blog\Model\ResourceModel\Post;

use Rubenromao\Blog\Model\Post;
use Rubenromao\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResourceModel::class);
    }
}
