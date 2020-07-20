<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Optimizer
 * @link https://github.com/Goomento/Optimizer
 */

namespace Goomento\Optimizer\Model;

use Goomento\Optimizer\Helper\Config;
use Goomento\Optimizer\Helper\Logger;

/**
 * Class ProcessorProxy
 * @package Goomento\Optimizer\Model
 */
class ProcessorProxy implements ProcessorInterface
{
    /**
     * @var ProcessorComposite
     */
    protected $processorComposite;

    /**
     * ProcessorProxy constructor.
     * @param ProcessorComposite $processorComposite
     */
    public function __construct(
        ProcessorComposite $processorComposite
    ) {
        $this->processorComposite = $processorComposite;
    }

    /**
     * @param $subject
     * @return mixed
     */
    public function process($subject)
    {
        $processors = Config::staticActivatedProcessor();
        foreach ($processors as $processor) {
            try {
                $subject = $this->processorComposite->get($processor)->process($subject);
            } catch (\Exception $e) {
                Logger::staticCritical($e->getMessage());
            }
        }

        return $subject;
    }
}
