<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Blog post list controller.
 *
 * @package Rubenromao\BlogPosts\Controller\Post
 */
class ListAction implements HttpGetActionInterface
{
    /**
     * Constructor.
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(
        private readonly PageFactory $pageFactory,
    ) {
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
