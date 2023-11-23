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
 *
 * @package Rubenromao\BlogPosts\Model
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * Constructor.
     *
     * @param PostFactory $postFactory
     * @param PostResourceModel $postResourceModel
     */
    public function __construct(
        private readonly PostFactory       $postFactory,
        private readonly PostResourceModel $postResourceModel,
    ) {}

    /**
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
}
