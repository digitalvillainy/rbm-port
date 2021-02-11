<?php
/**
 * Created by neoan3-cli.
 */

namespace Neoan3\Frame;

use Neoan3\Apps\Hcapture;
use Neoan3\Core\Serve;

/**
 * Class RbmPort
 * @package Neoan3\Frame
 */
class RbmPort extends Serve
{
    protected array $credentials = [];

    /**
     * RbmPort constructor.
     */
    function __construct()
    {
        parent::__construct();
        try {
            $this->credentials = getCredentials();
        } catch (\Exception $e) {
            print('SETUP: No credentials found. Please check README for instructions and/or change ' . __FILE__ . ' starting at line ' . (__LINE__ - 4) . ' ');
            die();
        }

        Hcapture::setEnvironment([
            'siteKey' => $this->credentials['rbm_hcaptcha']['sitekey'],
            'secret' => $this->credentials['rbm_hcaptcha']['secret'],
            'apiKey' => $this->credentials['rbm_hcaptcha']['apiKey']
        ]);
        $this->hook('header', 'header');
        $this->hook('footer', 'footer');
    }

    /**
     * Overwriting Serve's constants()
     * @return array
     */
    function constants()
    {
        return [
            'base' => [base],
            'link' => [
                [
                    'sizes' => '32x32',
                    'type' => 'image/png',
                    'rel' => 'icon',
                    'href' => base . '/asset/RedBannerMedia_Favicon.png',
                ]
            ],
            'stylesheet' => [
                '' . base . '/frame/rbmPort/style.css',
                'href' => 'https://fonts.googleapis.com/css2?family=Kanit:wght@800&display=swap'
            ],
            'js' => [
                ['src' => 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'],
                ['src' => 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js'],
                ['src' => 'https://hcaptcha.com/1/api.js', 'attr' => 'async'],
                ['src' => base . 'frame/rbmPort/axios-wrapper.js', 'data' => ['base' => base]]
            ]
        ];
    }
}