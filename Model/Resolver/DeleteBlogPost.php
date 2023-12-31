<?php

namespace Rubenromao\BlogPosts\Model\GraphQl;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\BatchResolverInterface;
use Magento\Framework\GraphQl\Query\Resolver\BatchResponse;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Psr\Log\LoggerInterface;
use Rubenromao\BlogPosts\Api\PostRepositoryInterface;

class DeleteBlogPost implements BatchResolverInterface
{
    /**
     * DeleteBlogPost constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly PostRepositoryInterface $postRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * Delete a blog post
     *
     * @param ContextInterface $context
     * @param Field $field
     * @param array $requests
     * @return BatchResponse
     * @throws LocalizedException
     */
    public function resolve(ContextInterface $context, Field $field, array $requests): BatchResponse
    {
        $responses = [];
        foreach ($requests as $request) {
            $args = $request->getArgs();
            try {
                $this->postRepository->deleteById($args['id']);
            } catch (NoSuchEntityException $e) {
                $this->logger->error($e->getMessage());
                $responses[] = false;
                continue;
            }
            $responses[] = true;
        }

        return $this->batchResponse->addResponse($responses);
    }
}
