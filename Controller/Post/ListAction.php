<?php
declare(strict_types=1);

namespace RubenRomao\BlogPosts\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Blog post list controller.
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
     * Render blog post list page.
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
