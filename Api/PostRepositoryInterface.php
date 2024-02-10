<?php

declare(strict_types=1);

namespace RubenRomao\BlogPosts\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use RubenRomao\BlogPosts\Api\Data\PostInterface;

/**
 * Blog post CRUD interface.
 *
 * @api
 * @since 1.0.0
 */
interface PostRepositoryInterface
{
    /**
     * Get post by ID.
     *
     * @param int $id
     * @return PostInterface|null
     * @throws LocalizedException
     */
    public function getById(int $id): ?PostInterface;

    /**
     * Get posts by date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @return PostInterface[]|null
     * @throws NoSuchEntityException
     */
    public function getByDateRange(string $startDate, string $endDate): ?array;

    /**
     * Save post.
     *
     * @param PostInterface $post
     * @return PostInterface
     * @throws LocalizedException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * Delete post by ID.
     *
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
