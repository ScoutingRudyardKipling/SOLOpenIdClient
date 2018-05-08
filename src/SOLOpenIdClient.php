<?php
/**
 * Created by: Frank Kuipers
 * Date: 3-5-18
 * Time: 21:18
 */

namespace ScoutingRudyardKipling;

/**
 * Class SOLOpenIdClient
 *
 * Please visit the documentation by SNL on their OpenId server for more information;
 * https://www.scouting.nl/downloads/ondersteuning/internet/2778-open-id-handleiding-voor-webmasters/file
 *
 * @package ScoutingRudyardKipling
 */
class SOLOpenIdClient extends \LightOpenID
{

    const THEME_LEAF  = 'TC3_leaf';
    const THEME_EARTH = 'TC3_earth';
    const THEME_WATER = 'TC3_water';

    private $theme = self::THEME_LEAF;

    /**
     * Set the theme of the login page theme
     *
     * @param string $theme
     */
    public function setTheme($theme = self::THEME_LEAF)
    {
        $this->theme = $theme;
    }

    /**
     * Hack to disable discovery and install the correct configuration right away
     *
     * @param string $url
     * @return string
     */
    function discover($url)
    {
        $this->ax       = false;
        $this->sreg     = true;
        $this->version  = 2;
        $this->required = [
            'namePerson',
            'contact/email',
            'birthDate',
            'person/gender',
            'pref/language'
        ];

        return $this->server = "https://login.scouting.nl/provider/";
    }

    /**
     * Hack to get one of the new fancy themes
     *
     * @return array
     */
    protected function sregParams()
    {
        return parent::sregParams() + [
                'openid.ns_theme'    => 'https://login.scouting.nl/ns/theme/1.0',
                'openid.theme_theme' => $this->theme
            ];
    }

}