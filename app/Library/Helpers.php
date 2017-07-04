<?php

if (!function_exists('admin_asset')) {
    /**
     * Get admin asset url.
     *
     * @param string $url
     * @param bool   $secure
     *
     * @return string
     */
    function admin_asset($url, $secure = false)
    {
        return asset('packages/admin/'.$url, $secure);
    }
}