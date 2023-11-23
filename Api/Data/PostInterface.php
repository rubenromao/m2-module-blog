<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Api\Data;

/**
 * Blog post interface.
 *
 * @api
 * @since 1.0.0
 */
interface PostInterface
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const CREATED_AT = 'created_at';

    /**
     * Post ID getter.
     *
     * @return int
     */
    public function getId();

    /**
     * Post title setter.
     *
     * @param int $id
     * @return $this
     */
    public function setId(int $id);

    /**
     * Post title getter.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Post title setter.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

    /**
     * Post content getter.
     *
     * @return string
     */
    public function getContent();

    /**
     * Post content setter.
     *
     * @param string $content
     * @return $this
     */
    public function setContent(string $content);

    /**
     * Post creation date getter.
     *
     * @return string
     */
    public function getCreatedAt();
}
