<?php

namespace App\Libraries;

use Request;
use Route;

class ActiveRoute
{
	 /**
     * Format the given path to be relative if it's absolute.
     *
     * @param  string  $path
     * @return string
     */
    private static function filter($path, $args = array())
    {
        if(Route::has($path)) $path = empty($args) ? route($path) : route($path, $args);

        $url = config('app.url');
        $isAbsolute = substr($path, 0, strlen($url)) === $url;
 
        if ($isAbsolute) $path = substr($path, strlen($url));
 
        if (substr($path, 0, 1) === '/') $path = substr($path, 1);
 
        if (empty($path)) $path = '/';
 
        return $path;
    }
 
    /**
     * Return the given CSS class (default 'active')
     * when the current URI matches the given path.
     *
     * @param  string  $path
     * @param  string  $class
     * @return string
     */
    public static function is($path, $class = 'active')
    {
        $path = ActiveRoute::filter($path);
 
        return Request::is($path) ? $class : '';
    }
 
    /**
     * Return the given CSS class (default 'active')
     * when the current URI starts with the given path.
     *
     * @param  string  $path
     * @param  string  $class
     * @return string
     */
    public static function startsWith($path, $class = 'active')
    {
        $path = ActiveRoute::filter($path);
 
        return Request::is($path) || Request::is("$path/*") ? $class : '';
    }
 
    /**
     * Return the given CSS class (default 'active')
     * when the current URI ends with the given path.
     *
     * @param  string  $path
     * @param  string  $class
     * @return string
     */
    public static function endsWith($path, $class = 'active')
    {
        $path = ActiveRoute::filter($path);
 
        return Request::is($path) || Request::is("*/$path") ? $class : '';
    }

    /**
     * Return the given CSS class (default 'active') when the current URI starts with any of the given path group
     * 
     * @param  array  $paths 
     * @param  string $class [description]
     * @return string
     */
    public static function startsWithAny($paths, $class = 'active') 
    {
        foreach($paths as $key => $path) {

            if(is_numeric($key)) {
                $path = ActiveRoute::filter($path);
            } else {
                $path = ActiveRoute::filter($key, $path);
            }

            if(Request::is($path) || Request::is("$path/*")) return $class;
        }

        return '';
    }
}