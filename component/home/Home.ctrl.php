<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;
use Neoan3\Core\Unicore;

/**
 * Class Home
 * @package Neoan3\Components
 */
class Home extends Unicore
{
    public array $final;
    /**
     * Route: home
     */

    function init(): void
    {
        $serviceJson = file_get_contents(path . '/asset/services.json');
        $portJson = file_get_contents(path . '/asset/portfolio.json');
        $services = json_decode($serviceJson, true);
        $portfolio = json_decode($portJson, true);

        $this
            ->uni('RbmPort')
            ->hook('main', 'home', ['cards' => $services['cards'], 'ports' => $portfolio])
            ->addHead('title', 'Red Banner Media, LLC | Web Development Company in Oneonta, NY')
            ->addHead('meta', [
                'name'=>'description',
                'content'=>'Red Banner Media, LLC brings web technologies to your business. We develop websites, web apps
                and tools that help you run your business.'
            ])
            ->output();
    }

}