<?php

/* Generated by neoan3-cli */

namespace Neoan3\Components;

use Neoan3\Core\Unicore;

/**
 * Class blog
 * @package Neoan3\Components
 */

class Blog extends Unicore{
    /**
     * Route: blog
     */
    function init(): void
    {
        $this
            ->uni('RbmPort')
            ->hook('main', 'blog')
            ->output();
    }
}