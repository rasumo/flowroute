<?php

namespace NotificationChannels\Flowroute;

use NotificationChannels\Flowroute\Exceptions\CouldNotSendNotification;
use NotificationChannels\Flowroute\Events\MessageWasSent;
use NotificationChannels\Flowroute\Events\SendingMessage;
use Illuminate\Notifications\Notification;

class FlowrouteChannel
{
    public function __construct()
    {
        // Initialisation code here
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
        //$response = [a call to the api of your notification send]

//        if ($response->error) { // replace this by the code need to check for errors
//            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
//        }
    }
}
