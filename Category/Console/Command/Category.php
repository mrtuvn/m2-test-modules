<?php
/**
 * Copyright © Vnecoms, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Tuna\Category\Console\Command;

/**
 * Class Category
 * @package Tuna\Category\Console\Command
 */
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Catalog\Model\CategoryFactory;

/**
 * Class ChangeCategory
 * @package Tuna\Category\Console\Command
 */
class Category extends Command
{
    /**
     *
     * @var CategoryFactory
     */
    private $categoryFactory;

    public function __construct(
        CategoryFactory $categoryFactory
    ) {
        $this->categoryFactory = $categoryFactory;

        parent::__construct();
    }

    /**
     *
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('create_cate');
        parent::configure();
    }

    /**
     *
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $url = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $url->get('\Magento\Store\Model\StoreManagerInterface');
        $mediaurl= $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $state = $objectManager->get('\Magento\Framework\App\State');
        $state->setAreaCode('frontend');
        /// Get Website ID
        $websiteId = $storeManager->getWebsite()->getWebsiteId();
        echo 'websiteId: '.$websiteId." ";

        /// Get Store ID
        $store = $storeManager->getStore();
        $storeId = $store->getStoreId();
        echo 'storeId: '.$storeId." ";

        /// Get Root Category ID
        $rootNodeId = $store->getRootCategoryId();
        echo 'rootNodeId: '.$rootNodeId." ";
        /// Get Root Category
        $rootCat = $objectManager->get('Magento\Catalog\Model\Category');
        $cat_info = $rootCat->load($rootNodeId);

        $categorys=array('Levis-test-category00001'); // Category Names
        foreach ($categorys as $cat) {
            $name=ucfirst($cat);
            $url=strtolower($cat);
            $cleanurl = trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($url))))));
            $categoryFactory = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');
            /// Add a new sub category under root category
            $categoryTmp = $categoryFactory->create();
            $categoryTmp->setName($name);
            $categoryTmp->setIsActive(true);
            $categoryTmp->setUrlKey($cleanurl);
            $categoryTmp->setData('description', 'description');
            $categoryTmp->setParentId($rootCat->getId());
            $mediaAttribute = array ('image', 'small_image', 'thumbnail');
            $categoryTmp->setImage('/m2.png', $mediaAttribute, true, false);// Path pub/meida/catalog/category/m2.png
            $categoryTmp->setStoreId($storeId);
            $categoryTmp->setPath($rootCat->getPath());
            $categoryTmp->save();
        }

    }
}
