<?php

namespace NotificationChannels\Flowroute;

class Flowroute
{
    /** @var string */
    protected $access_key;
    /** @var string */
    protected $secret_key;
    /** @var string */
    protected $from;
    /**
     * Create a new Plivo RestAPI instance.
     *
     * @param array $config
     * @return void
     */
    public function __construct(array $config)
    {
        $this->access_key = $config['access_key'];
        $this->secret_key = $config['secret_key'];
        $this->from = $config['from_number'];
    }
    /**
     * Number SMS is being sent from.
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    public function getAuth()
    {
        return [
            $this->access_key,
            $this->secret_key,
        ];
    }
}