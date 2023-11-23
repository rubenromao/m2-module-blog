<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Rubenromao\BlogPosts\Api\Data\PostInterface;
use Rubenromao\BlogPosts\Api\PostRepositoryInterface;
use Rubenromao\BlogPosts\Model\ResourceModel\Post\Collection;

/**
 * ViewModel to get posts data from the database and make it available for the template
 */
class Post implements ArgumentInterface
{
    /**
     * Post constructor.
     *
     * @param Collection $collection
     * @param PostRepositoryInterface $postRepository
     * @param RequestInterface $request
     */
    public function __construct(
        private readonly Collection              $collection,
        private readonly PostRepositoryInterface $postRepository,
        private readonly RequestInterface        $request,
    ) {
    }

    /**
     * Get list of posts
     *
     * @return array
     */
    public function getList(): array
    {
        return $this->collection->getItems();
    }

    /**
     * Get count of posts
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->collection->count();
    }

    /**
     * Get post detail
     *
     * @return PostInterface
     * @throws LocalizedException
     */
    public function getDetail(): PostInterface
    {
        $id = (int)$this->request->getParam('id');

        return $this->postRepository->getById($id);
    }
}
