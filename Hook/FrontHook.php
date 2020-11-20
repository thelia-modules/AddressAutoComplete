<?php

namespace AddressAutoComplete\Hook;

use AddressAutoComplete\AddressAutoComplete;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class FrontHook extends BaseHook
{
    public function importMapsApi(HookRenderEvent $event)
    {
        $event->add(
            $this->render('addressautocomplete-js.html', ['maps_places_api_key' => AddressAutoComplete::getConfigValue('maps_places_api_key')])
        );
    }
}
