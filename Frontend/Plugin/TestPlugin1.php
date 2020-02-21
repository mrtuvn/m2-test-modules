<?php
/**
 * Copyright © Vnecoms, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Tuna\Frontend\Plugin;

use Magento\PageCache\Model\DepersonalizeChecker;

/**
 * Class TestPlugin1
 * @package Tuna\Frontend\Plugin
 */
class TestPlugin1
{
    /**
     * @var DepersonalizeChecker
     */
    protected $depersonalizeChecker;

    /**
     * @var \Magento\Framework\Event\Manager
     */
    protected $eventManager;

    /**
     * @var \Magento\Framework\Message\Session
     */
    protected $messageSession;

    /**
     * @param DepersonalizeChecker $depersonalizeChecker
     * @param \Magento\Framework\Event\Manager $eventManager
     * @param \Magento\Framework\Message\Session $messageSession
     */
    public function __construct(
        DepersonalizeChecker $depersonalizeChecker,
        \Magento\Framework\Event\Manager $eventManager,
        \Magento\Framework\Message\Session $messageSession
    ) {
        $this->depersonalizeChecker = $depersonalizeChecker;
        $this->eventManager = $eventManager;
        $this->messageSession = $messageSession;
    }

    /**
     * After generate Xml
     *
     * @param \Magento\Framework\View\LayoutInterface $subject
     * @param \Magento\Framework\View\LayoutInterface $result
     * @return \Magento\Framework\View\LayoutInterface
     */
    public function afterGenerateXml(\Magento\Framework\View\LayoutInterface $subject, $result)
    {
        echo 'test run into plugin 1';
        return $result;
    }
}
