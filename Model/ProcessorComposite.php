<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Optimizer
 * @link https://github.com/Goomento/Optimizer
 */

namespace Goomento\Optimizer\Model;


use Magento\Framework\ObjectManager\TMapFactory;

/**
 * Class ProcessorComposite
 * @package Goomento\Optimizer\Model
 */
class ProcessorComposite extends \Goomento\Base\Model\BuilderComposite
{
    /**
     * ProcessorComposite constructor.
     * @param TMapFactory $tmapFactory
     * @param array $processors
     */
    public function __construct(TMapFactory $tmapFactory, array $processors = [])
    {
        $this->builders = $tmapFactory->create(
            [
                'array' => $processors,
                'type' => ProcessorInterface::class
            ]
        );
    }
}
