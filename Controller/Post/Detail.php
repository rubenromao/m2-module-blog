<?php
declare(strict_types=1);

namespace Rubenromao\BlogPosts\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Blog post detail controller.
 *
 * @package Rubenromao\BlogPosts\Controller\Post
 */
class Detail implements HttpGetActionInterface
{
    /**
     * Constructor.
     *
     * @param PageFactory $pageFactory
     * @param EventManager $eventManager
     * @param RequestInterface $request
     */
    public function __construct(
        private readonly PageFactory      $pageFactory,
        private readonly EventManager     $eventManager,
        private readonly RequestInterface $request,
    ) {}

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $this->eventManager->dispatch('rubenromao_blog_post_detail_view', [
            'request' => $this->request,
        ]);

        return $this->pageFactory->create();
    }
}
