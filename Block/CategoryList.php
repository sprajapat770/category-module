<?php

namespace Suraj\Category\Block;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\CategoryRepository;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class CategoryList extends Template
{

    /**
     * @var CollectionFactory $collection
     */
    public $collection;

    /**
     * @var Collection $collectionData
     */
    private $collectionData;

    /**
     * @var StoreManagerInterface $_storeManager
     */
    protected $_storeManager;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var CategoryFactory
     */
    private $categoryFactory;

    /**
     * @var Registry
     */
    protected $_registry;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        CategoryFactory $categoryFactory,
        CategoryRepository $categoryRepository,
        StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->collection = $collectionFactory;
        $this->_storeManager = $storeManager;
        $this->categoryFactory = $categoryFactory;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function getCategoryList()
    {
             $levels = 2;
           /*  $categories=  $this->collection->create()->addAttributeToSelect('*')
                 ->setStore()
                 ->addAttributeToFilter('is_active', '1');
             return $categories;*/
        $rootCategory=  $this->_storeManager->getStore()->getRootCategoryId();
      //  $parentId = 2;

     //   $currentCategory = $this->_registry->create()->registry('current_category');
      // $parentId =  $currentCategory->getId();

        $categoryObj = $this->categoryRepository->get($rootCategory);
        return $categoryObj->getChildrenCategories();
    }
}
