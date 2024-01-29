<?php
declare(strict_types=1);

namespace RubenRomao\BlogPosts\Setup\Patch\Data;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;
use RubenRomao\BlogPosts\Api\PostRepositoryInterface;
use RubenRomao\BlogPosts\Model\PostFactory;

/**
 * Data patch to add two blog posts to the database.
 */
class PopulateBlogPostsWithMultiplePosts implements DataPatchInterface
{
    /**
     * Constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PostFactory              $postFactory
     * @param PostRepositoryInterface  $postRepository
     * @param LoggerInterface          $logger
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly PostFactory              $postFactory,
        private readonly PostRepositoryInterface  $postRepository,
        private readonly LoggerInterface          $logger,
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Add two blog posts to the database.
     *
     * @return void
     * @throws LocalizedException
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $posts = [
            [
                'title'   => 'Today is sunny',
                'content' => 'The weather has been great all week.',
            ],
            [
                'title'   => 'My movie review',
                'content' => 'I give this movie 5 out of 5 stars!',
            ],
        ];

        foreach ($posts as $postData) {
            $post = $this->postFactory->create();
            $post->setData($postData);

            try {
                $this->postRepository->save($post);
            } catch (LocalizedException $e) {
                $logMessage = 'Could not save post: ' . $e->getMessage();
                $this->logger->critical($logMessage);
            }
        }

        $this->moduleDataSetup->endSetup();
    }
}
