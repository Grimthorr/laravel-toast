<?php

if (!function_exists('toast'))
{
    /**
     * Helper function for Toast facade.
     *
     * @param string $message
     * @return \Grimthorr\LaravelToast\Toast
     */
    function toast($message = null, $title = null)
    {
        $instance = app('toast');

        if (!isset($instance)) {
            $instance = app()->make('Grimthorr\LaravelToast\Toast');
        }

        if (!is_null($message)) {
            return $instance->message($message, null, $title);
        }

        return $instance;
    }
}
