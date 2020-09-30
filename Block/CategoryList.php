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
     * @var StoreManagerInterface $_storeManager
     */
    protected $_storeManager;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;


    public function __construct(
        Template\Context $context,
        CategoryRepository $categoryRepository,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getCategoryList()
    {
        $rootCategory=  $this->_storeManager->getStore()->getRootCategoryId();
        $categoryObj = $this->categoryRepository->get($rootCategory);
        return $categoryObj->getChildrenCategories();
    }
}
