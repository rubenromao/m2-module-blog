<?php

namespace RubenRomao\BlogPosts\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use RubenRomao\BlogPosts\Model\PostRepository;
use RubenRomao\BlogPosts\Model\PostFactory;
use RubenRomao\BlogPosts\Model\ResourceModel\Post as PostResourceModel;
use RubenRomao\BlogPosts\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class PostRepositoryTest extends TestCase
{
    private $postRepository;
    private $postFactory;
    private $postResourceModel;
    private $postCollectionFactory;
    private $logger;

    protected function setUp(): void
    {
        $this->postFactory = $this->createMock(PostFactory::class);
        $this->postResourceModel = $this->createMock(PostResourceModel::class);
        $this->postCollectionFactory = $this->createMock(PostCollectionFactory::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->postRepository = new PostRepository(
            $this->postFactory,
            $this->postResourceModel,
            $this->postCollectionFactory,
            $this->logger
        );
    }

    public function testGetById()
    {
        $postId = 1;
        $postMock = $this->getMockBuilder(PostInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postFactory->expects($this->once())
            ->method('create')
            ->willReturn($postMock);

        $this->postResourceModel->expects($this->once())
            ->method('load')
            ->with($postMock, $postId);

        $postMock->expects($this->once())
            ->method('getId')
            ->willReturn($postId);

        $this->assertEquals($postMock, $this->postRepository->getById($postId));
    }

    public function testGetByIdThrowsException()
    {
        $this->expectException(NoSuchEntityException::class);

        $postId = 1;
        $postMock = $this->getMockBuilder(PostInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postFactory->expects($this->once())
            ->method('create')
            ->willReturn($postMock);

        $this->postResourceModel->expects($this->once())
            ->method('load')
            ->with($postMock, $postId);

        $postMock->expects($this->once())
            ->method('getId')
            ->willReturn(null);

        $this->postRepository->getById($postId);
    }
}
