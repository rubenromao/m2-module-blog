<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Model;

use Magento\Framework\Model\AbstractModel;
use Rubenromao\BlogPosts\Api\Data\PostInterface;

/**
 * Class Post
 *
 * @package Rubenromao\BlogPosts\Model
 */
class Post extends AbstractModel implements PostInterface
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Post::class);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string $content): Post
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }
}
