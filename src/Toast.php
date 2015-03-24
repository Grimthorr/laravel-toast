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
     * Construction method.
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
     * @param string $title
     * @return $this
     */
    public function info($message, $title = null)
    {
        $this->message($message, $this->levels['info'], $title);

        return $this;
    }

    /**
     * Create a success message.
     *
     * @param string $message
     * @param string $title
     * @return $this
     */
    public function success($message, $title = null)
    {
        $this->message($message, $this->levels['success'], $title);

        return $this;
    }

    /**
     * Create an error message.
     *
     * @param string $message
     * @param string $title
     * @return $this
     */
    public function error($message, $title = null)
    {
        $this->message($message, $this->levels['error'], $title);

        return $this;
    }

    /**
     * Create a warning message.
     *
     * @param string $message
     * @param string $title
     * @return $this
     */
    public function warning($message, $title = null)
    {
        $this->message($message, $this->levels['warning'], $title);

        return $this;
    }

    /**
     * Create a message.
     *
     * @param string $message
     * @param string $level
     * @param string $title
     * @return $this
     */
    public function message($message, $level = null, $title = null)
    {
        if (!isset($level)) {
            $level = $this->levels['default'];
        }

        array_push($this->toasts, [
            'message' => $message,
            'level' => $level,
            'title' => $title,
        ]);
        session()->flash('toasts', $this->toasts);

        return $this;
    }

}
