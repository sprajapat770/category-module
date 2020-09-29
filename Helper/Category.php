<?php
namespace Suraj\Category\Helper;

class Category extends Magento\Framework\App\Helper\AbstractHelper
{
    protected $registry;

    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->$registry = $registry;
    }
    public function getCurrentCategory()
    {
        return $this->registry->registry('current_category');
    }
}
