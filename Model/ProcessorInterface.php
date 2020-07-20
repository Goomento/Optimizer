<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Optimizer
 * @link https://github.com/Goomento/Optimizer
 */

namespace Goomento\Optimizer\Model;

/**
 * Interface ProcessorInterface
 * @package Goomento\Optimizer\Model
 */
interface ProcessorInterface
{
    /**
     * @param $subject
     * @return mixed
     */
    public function process($subject);
}
