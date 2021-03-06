<?php

namespace FroshProfiler\Subscriber;

use Enlight\Event\SubscriberInterface;
use Enlight_Event_EventArgs;

/**
 * Class SmartyProfiler
 */
class SmartyProfiler implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginDir;

    /**
     * SmartyProfiler constructor.
     *
     * @param $pluginDir
     */
    public function __construct($pluginDir)
    {
        $this->pluginDir = $pluginDir;
    }

    /**
     * {@inheritdoc]
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Bootstrap_InitResource_template' => 'onInitTemplate',
        ];
    }

    /**
     * @param Enlight_Event_EventArgs $args
     */
    public function onInitTemplate(Enlight_Event_EventArgs $args)
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            if (strpos($_SERVER['REQUEST_URI'], '/backend') === false && strpos($_SERVER['REQUEST_URI'], '/api') === false && strpos($_SERVER['REQUEST_URI'], 'Profiler') === false) {
                /*
                 * Set a custom SYSPLUGINS Path, to disable default smarty autoloading
                 */
                define('SMARTY_SYSPLUGINS_DIR', $this->pluginDir);
            }
        }
    }
}
