<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Optimizer
 * @link https://github.com/Goomento/Optimizer
 */

namespace Goomento\Optimizer\Plugin\Framework\Controller;

use Goomento\Optimizer\Helper\Config;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class ProcessPageResult
 * @package Goomento\Optimizer\Plugin\Framework\Controller
 */
class ProcessPageResult
{
    /**
     * @var \Goomento\Optimizer\Model\ProcessorProxy
     */
    protected $processorProxy;

    public function __construct(
        \Goomento\Optimizer\Model\ProcessorProxy $processorProxy
    ) {
        $this->processorProxy = $processorProxy;
    }

    public function aroundRenderResult(
        \Magento\Framework\Controller\ResultInterface $subject,
        callable $proceed,
        ResponseInterface $response
    ) {
        /** @var ResultInterface $result */
        $result = $proceed($response);
        if (Config::staticIsActive()) {
            $output = $this->processorProxy->process($response->getBody());
            $response->setBody($output);
        }
        return $result;
    }
}
