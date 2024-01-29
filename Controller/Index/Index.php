<?php
declare(strict_types=1);

namespace RubenRomao\BlogPosts\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;

/**
 * Blog index controller.
 */
class Index implements HttpGetActionInterface
{
    /**
     * Constructor.
     *
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(
        private readonly ForwardFactory $forwardFactory,
    ) {
    }

    /**
     * Execute action based on request and return result.
     *
     * @return Forward
     */
    public function execute(): Forward
    {
        /**
         * Forward to list action.
         *
         * @var Forward $forward
         */
        $forward = $this->forwardFactory->create();

        return $forward->setController('post')->forward('list');
    }
}
