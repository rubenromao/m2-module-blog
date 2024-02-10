<?php

declare(strict_types=1);

namespace RubenRomao\BlogPosts\Model\Resolver;

use RubenRomao\BlogPosts\Model\ResourceModel\Post\Collection;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class BlogPostsResolver implements ResolverInterface
{
    /**
     * BlogPostsResolver constructor.
     *
     * @param Collection $collection
     */
    public function __construct(
        private readonly Collection $collection,
    ) {
    }

    /**
     * Get a list of blog posts.
     *
     * @param Field $field
     * @param mixed $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null,
    ): array {
        try {

            // getting the arguments of request
            $search_text = $args['search'];
            $pageSize = $args['pageSize'];
            $currentPage = $args['currentPage'];

            // search
            if ('' != $search_text) {
                $this->collection->addFieldToFilter(
                    [
                        'title',
                        'content',
                    ],
                    [
                        ['like' => '%' . $search_text . '%'],
                        ['like' => '%' . $search_text . '%'],
                    ],
                );
            }

            // pagination
            $this->collection->setPageSize($pageSize)->setCurPage($currentPage);

            // get the posts
            $posts = $this->collection->getItems();

            // mapping to schema
            $items = [];
            foreach ($posts as $post) {
                $items[] = [
                    'id'         => $post->getId(),
                    'title'      => $post->getTitle(),
                    'content'    => $post->getContent(),
                    'created_at' => $post->getCreationTime(),
                ];
            }

            $total_count = $this->collection->getSize();
            $total_pages = ceil($total_count / $pageSize);
        } catch (\Exception $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return [
            'total_count' => $total_count,
            'total_pages' => $total_pages,
            'items'       => $items,
        ];
    }
}
