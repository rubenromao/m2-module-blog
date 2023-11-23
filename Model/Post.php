<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Model;

use Magento\Framework\Model\AbstractModel;
use Rubenromao\BlogPosts\Api\Data\PostInterface;

/**
 * Post model
 */
class Post extends AbstractModel implements PostInterface
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent(string $content): Post
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Resource (ORM)
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Post::class);
    }
}
