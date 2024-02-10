<?php
/**
 * @author: Ruben Romao
 * @date: 2024-01-04
 */
declare(strict_types=1);

namespace RubenRomao\BlogPosts\Model;

use Exception;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use RubenRomao\BlogPosts\Api\Data\PostInterface;
use RubenRomao\BlogPosts\Api\PostRepositoryInterface;
use RubenRomao\BlogPosts\Model\ResourceModel\Post as PostResourceModel;
use RubenRomao\BlogPosts\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

/**
 * Blog post CRUD class.
 *
 * The PostRepository class is responsible for handling the CRUD operations for the Post model.
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * Error messages.
     */
    public const MESSAGE_COULD_NOT_SAVE = 'Could not save the Post.';
    public const MESSAGE_COULD_NOT_DELETE = 'Could not delete the Post.';

    /**
     * PostRepository constructor.
     *
     * @param PostFactory $postFactory
     * @param PostResourceModel $postResourceModel
     * @param PostCollectionFactory $postCollectionFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly PostFactory $postFactory,
        private readonly PostResourceModel $postResourceModel,
        private readonly PostCollectionFactory $postCollectionFactory,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * Retrieves a post by its ID.
     *
     * @param int $id
     * @return PostInterface|null
     * @throws NoSuchEntityException
     */
    public function getById(int $id): ?PostInterface
    {
        try {
            $loadedPost = $this->postFactory->create();
            $this->postResourceModel->load($loadedPost, $id);

            if ($loadedPost === null || !$loadedPost->getId()) {
                $this->logger->error(__("The blog post with \"%1\" ID doesn't exist.", $id));

                return null;
            }

            return $loadedPost;

        } catch (Exception $ex) {
            $this->logger->critical(__($ex->getMessage()));
            throw new NoSuchEntityException(__($ex->getMessage()));
        }
    }

    /**
     * Retrieves an array of posts within the given date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @return array|null
     * @throws NoSuchEntityException
     */
    public function getByDateRange(string $startDate, string $endDate): ?array
    {
        try {
            $postCollection = $this->postCollectionFactory->create();
            $postCollection->addFieldToFilter('created_at', ['gteq' => $startDate])
                ->addFieldToFilter('created_at', ['lteq' => $endDate]);

            $posts = $postCollection->getItems();

            if (empty($posts)) {
                $this->logger->error(__('No blog posts found between "%1" and "%2".', $startDate, $endDate));

                return null;
            }

            return $posts;

        } catch (Exception $ex) {
            $this->logger->critical(__($ex->getMessage()));
            throw new NoSuchEntityException(__($ex->getMessage()));
        }
    }

    /**
     * Saves a post.
     *
     * @param PostInterface $post
     * @return PostInterface
     * @throws CouldNotSaveException
     */
    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->postResourceModel->save($post);
        } catch (Exception $couldNotSaveEx) {
            $this->logger->critical(__('%1 - %2', self::MESSAGE_COULD_NOT_SAVE, $couldNotSaveEx->getMessage()));
            throw new CouldNotSaveException(__($couldNotSaveEx->getMessage()), null, $couldNotSaveEx->getCode());
        }

        return $post;
    }

    /**
     * Delete a blog post by its ID.
     *
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): bool
    {
        $post = $this->getById($id);

        try {
            $this->postResourceModel->delete($post);
        } catch (Exception $couldNotDeleteEx) {
            $this->logger->critical(__('%1 - %2', self::MESSAGE_COULD_NOT_DELETE, $couldNotDeleteEx->getMessage()));
            throw new CouldNotDeleteException(__($couldNotDeleteEx->getMessage()), null, $couldNotDeleteEx->getCode());
        }

        return true;
    }
}
