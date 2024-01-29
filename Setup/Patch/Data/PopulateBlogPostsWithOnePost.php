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
 * Data patch to add one blog post sample to the database.
 */
class PopulateBlogPostsWithOnePost implements DataPatchInterface
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
     * Populate the database with one blog post sample.
     *
     * @return void
     * @throws LocalizedException
     */
    public function apply(): void
    {
        $this->moduleDataSetup->startSetup();

        $post = $this->postFactory->create();
        $post->setData(
            [
            'title'   => 'An awesome post',
            'content' => 'This is totally awesome!',
            ]
        );

        try {
            $this->postRepository->save($post);
        } catch (LocalizedException $e) {
            $logMessage = 'Could not save post: ' . $e->getMessage();
            $this->logger->critical($logMessage);
        }

        $this->moduleDataSetup->endSetup();
    }
}
