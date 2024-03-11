<?php
/**
 * @author Ruben Romao
 * @email rubenromao@gmail.com
 * @date 2024-01-04
 */
declare(strict_types=1);

namespace RubenRomao\BlogPosts\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use RubenRomao\BlogPosts\Model\ResourceModel\Post\CollectionFactory;

/**
 * PostDataProvider.php
 *
 * This class is responsible for providing data for the blog post listing in the admin panel.
 * It extends the  AbstractDataProvider  class and has the following method:
 *  - getData() : This method retrieves the data from the database and prepares it for the UI components.
 */
class PostDataProvider extends AbstractDataProvider
{
    /**
     * PostDataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Get data
     *
     * This method retrieves the data from the database and prepares it for the UI components.
     *
     * @return array
     */
    public function getData(): array
    {
        $items = $this->collection->getItems();

        // Prepare the result array.
        $result = [];
        foreach ($items as $item) {
            $result[$item->getId()] = $item->getData();
        }

        return $result;
    }
}
