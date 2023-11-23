<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;

/**
 * Blog index controller.
 *
 * @package Rubenromao\BlogPosts\Controller\Index
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
     * @return Forward
     */
    public function execute(): Forward
    {
        /**
 * @var Forward $forward
*/
        $forward = $this->forwardFactory->create();

        return $forward->setController('post')->forward('list');
    }
}
