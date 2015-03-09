<?php

namespace Grimthorr\LaravelToast;


class Toast {

    /**
     * The current toasts
     * 
     * @var array
     */
    protected $toasts = [];

    /**
     * The CSS classes to use.
     * Configured by the developer (see config/config.php for default).
     *
     * @var string
     */
    protected $levels = [];


    /**
     * Construction method to inject the current session.
     *
     * @return void
     */
    function __construct()
    {
        $this->levels = config('laravel-toast.levels');
    }

    /**
     * Call method to enable custom levels specified in config.
     *
     * @param $method
     * @param $args
     * @return void
     */
    function __call($method, $args)
    {
        if (array_key_exists($method, $this->levels)) {
            call_user_func_array([$this, 'message'], $args);
        } else {
            throw new \BadMethodCallException('Toast config file does not contain level "' . $method . '"');
        }
    }


    /**
     * Create an info message.
     *
     * @param string $message
     * @return $this
     */
    public function info($message)
    {
        $this->message($message, $this->levels['info']);

        return $this;
    }

    /**
     * Create a success message.
     *
     * @param string $message
     * @return $this
     */
    public function success($message)
    {
        $this->message($message, $this->levels['success']);

        return $this;
    }

    /**
     * Create an error message.
     *
     * @param string $message
     * @return $this
     */
    public function error($message)
    {
        $this->message($message, $this->levels['error']);

        return $this;
    }

    /**
     * Create a warning message.
     *
     * @param string $message
     * @return $this
     */
    public function warning($message)
    {
        $this->message($message, $this->levels['warning']);

        return $this;
    }

    /**
     * Create a message.
     *
     * @param string $message
     * @param string $level
     * @return $this
     */
    public function message($message, $level = null)
    {
        if (!isset($level)) {
            $level = $this->levels['default'];
        }

        array_push($this->toasts, [
            'message' => $message,
            'level' => $level
        ]);
        session()->flash('toasts', $this->toasts);

        return $this;
    }

}
