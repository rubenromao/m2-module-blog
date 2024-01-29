<?php

declare(strict_types=1);

namespace RubenRomao\BlogPosts\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use RubenRomao\BlogPosts\Api\PostRepositoryInterface;

class BlogPostResolver implements ResolverInterface
{
    /**
     * @var ?PostRepositoryInterface
     */
    private ?PostRepositoryInterface $postRepository;

    /**
     * BlogPostResolver constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * Get a single blog post by id
     *
     * @param Field $field
     * @param mixed $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws GraphQlInputException
     * @throws GraphQlNoSuchEntityException|LocalizedException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null,
    ): array {
        if (!isset($args['id'])) {
            throw new GraphQlInputException(__('Blog post id should be specified'));
        }

        try {
            $post = $this->postRepository->getById((int)$args['id']);
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return [
            'id'         => $post->getId(),
            'title'      => $post->getTitle(),
            'content'    => $post->getContent(),
            'created_at' => $post->getCreatedAt(),
        ];
    }
}
