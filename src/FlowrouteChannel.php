<?php

namespace NotificationChannels\Flowroute;

use GuzzleHttp\Client;
use NotificationChannels\Flowroute\Exceptions\CouldNotSendNotification;
use NotificationChannels\Flowroute\Events\MessageWasSent;
use NotificationChannels\Flowroute\Events\SendingMessage;
use Illuminate\Notifications\Notification;

class FlowrouteChannel
{
    /**
     * @var \NotificationChannels\Flowroute\Flowroute;
     */
    protected $flowroute;

    /**
     * The Guzzle HTTP Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;


    /**
     * The API's URL.
     *
     * @var string
     */
    protected $apiBase = 'https://api.flowroute.com/v2/messages';

    public function __construct(Client $client, Flowroute $flowroute)
    {
        $this->client = $client;
        $this->flowroute = $flowroute;
        $this->from = $this->flowroute->from();
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\Flowroute\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('flowroute')) {
            return;
        }

        $message = $notification->toFlowroute($notifiable);

        if (is_string($message)) {
            $message = new FlowrouteMessage($message);
        }

        $payload = [
            'from'  => $message->from ?: $this->from,
            'to'    => $to,
            'body'  => $message->getBody(),
        ];

        $response = $this->client->post($this->apiBase, [
            'auth' => $this->flowroute->getAuth(),
            'json' => $payload,
        ]);

        if ($response->getStatusCode() != 201 && $response->getStatusCode() != 200) {
             throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }
    }
}
