<?php

namespace AddressAutoComplete\Hook;

use AddressAutoComplete\AddressAutoComplete;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ModuleConfig;
use Thelia\Model\ModuleConfigQuery;

class HookManager extends BaseHook
{
    public function onModuleConfigure(HookRenderEvent $event)
    {
        $vars = [ ];

        if (null !== $params = ModuleConfigQuery::create()->findByModuleId(AddressAutoComplete::getModuleId())) {

            /** @var ModuleConfig $param */
            foreach ($params as $param) {
                $vars[ $param->getName() ] = $param->getValue();
            }
        }

        $event->add(
            $this->render(
                'addressautocomplete/module-configuration.html',
                $vars
            )
        );
    }
}
