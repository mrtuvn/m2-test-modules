<?php
/**
 * Copyright © Vnecoms, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Tuna\Routing\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class Index
 * @package Tuna\Routing\Controller\Adminhtml\Index
 */
class Index extends Action implements HttpGetActionInterface
{
    public function execute()
    {
        $this->_redirect('adminhtml/*/');
    }
}
