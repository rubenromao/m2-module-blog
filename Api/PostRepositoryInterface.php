<?php

declare(strict_types=1);

namespace Rubenromao\BlogPosts\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Rubenromao\BlogPosts\Api\Data\PostInterface;

/**
 * Blog post CRUD interface.
 *
 * @api
 * @since 1.0.0
 */
interface PostRepositoryInterface
{
    /**
     * Get posts by date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @return PostInterface[]
     * @throws NoSuchEntityException
     */
    public function getByDateRange(string $startDate, string $endDate): array;

    /**
     * Get post by ID.
     *
     * @param int $id
     * @return PostInterface
     * @throws LocalizedException
     */
    public function getById(int $id): PostInterface;

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
