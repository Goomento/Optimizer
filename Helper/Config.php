<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Optimizer
 * @link https://github.com/Goomento/Optimizer
 */

namespace Goomento\Optimizer\Helper;

use Magento\Framework\App\Helper\Context;

/**
 * Class Config
 * @package Goomento\Optimizer\Helper
 * @method static staticActivatedProcessor() : array
 * @method static staticGetLazyLoadIgnoredUrls() : array
 */
class Config extends \Goomento\Base\Helper\AbstractConfig
{
    /**
     * Config constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context, ['goomento_optimizer', 'general']);
    }

    /**
     * @return array
     */
    public function activatedProcessor()
    {
        $activated = [];
        if (self::staticConfigGetBool('lazy_load/active')) {
            $activated[] = 'lazy_load';
        }

        return $activated;
    }

    /**
     * @return array|false|string[]
     */
    public function getLazyLoadIgnoredUrls()
    {
        $result = [];
        $ignored = $this->configGet('lazy_load/ignore_urls');
        if ($ignored = trim($ignored)) {
            $result = explode(PHP_EOL, $ignored);
        }
        return $result;
    }
}
