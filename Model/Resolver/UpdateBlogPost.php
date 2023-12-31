<?php

namespace Rubenromao\BlogPosts\Model\GraphQl;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\BatchResolverInterface;
use Magento\Framework\GraphQl\Query\Resolver\BatchResponse;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Psr\Log\LoggerInterface;
use Rubenromao\BlogPosts\Api\PostRepositoryInterface;

class UpdateBlogPost implements BatchResolverInterface
{
    /**
     * UpdateBlogPost constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * Update a blog post
     *
     * @param ContextInterface $context
     * @param Field $field
     * @param array $requests
     * @return BatchResponse
     * @throws LocalizedException
     * @throws LocalizedException
     */
    public function resolve(ContextInterface $context, Field $field, array $requests): BatchResponse
    {
        $responses = [];
        foreach ($requests as $request) {
            $args = $request->getArgs();
            $post = $this->postRepository->getById($args['id']);
            $post->setTitle($args['input']['title']);
            $post->setContent($args['input']['content']);
            $this->postRepository->save($post);
            $responses[] = $post;
        }

        return new BatchResponse($responses);
    }
}
