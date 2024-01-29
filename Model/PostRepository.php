<?php

declare(strict_types=1);

namespace Rubenromao\BlogPosts\Model;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Rubenromao\BlogPosts\Api\Data\PostInterface;
use Rubenromao\BlogPosts\Api\PostRepositoryInterface;
use Rubenromao\BlogPosts\Model\ResourceModel\Post as PostResourceModel;

/**
 * Blog post CRUD class.
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * PostRepository Constructor.
     *
     * @param PostFactory $postFactory
     * @param PostResourceModel $postResourceModel
     */
    public function __construct(
        private readonly PostFactory $postFactory,
        private readonly PostResourceModel $postResourceModel,
    ) {}

    /**
     * Get posts by date range
     *
     * @param string $startDate
     * @param string $endDate
     * @return PostInterface[]
     * @throws NoSuchEntityException
     */
    public function getByDateRange(string $startDate, string $endDate): array
    {
        $postCollection = $this->postFactory->create()->getCollection();
        $postCollection->addFieldToFilter('created_at', ['gteq' => $startDate])
            ->addFieldToFilter('created_at', ['lteq' => $endDate]);

        $posts = $postCollection->getItems();

        if (empty($posts)) {
            throw new NoSuchEntityException(__('No blog posts found between "%1" and "%2".', $startDate, $endDate));
        }

        return $posts;
    }

    /**
     * Get post by ID Model
     *
     * @param int $id
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): PostInterface
    {
        $post = $this->postFactory->create();
        $this->postResourceModel->load($post, $id);

        if (!$post->getId()) {
            throw new NoSuchEntityException(__('The blog post with "%1" ID doesn\'t exist.', $id));
        }

        return $post;
    }

    /**
     * Save post Model
     *
     * @param PostInterface $post
     * @return PostInterface
     * @throws CouldNotSaveException
     */
    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->postResourceModel->save($post);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $post;
    }

    /**
     * Delete post Model
     *
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        $post = $this->getById($id);

        try {
            $this->postResourceModel->delete($post);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
    /**
     * Delete posts by date range
     *
     * @param string $startDate
     * @param string $endDate
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteByDateRange(string $startDate, string $endDate): bool
    {
        $postCollection = $this->postFactory->create()->getCollection();
        $postCollection->addFieldToFilter('created_at', ['from' => $startDate, 'to' => $endDate]);

        $posts = $postCollection->getItems();

        if(!empty($posts)) {
            try {
                foreach ($posts as $post) {
                    $this->postResourceModel->delete($post);
                }
            } catch (Exception $exception) {
                throw new CouldNotDeleteException(__($exception->getMessage()));
            }
        }

        return true;
    }
}
