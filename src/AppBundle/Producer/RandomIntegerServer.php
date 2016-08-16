<?php

namespace AppBundle\Producer;

use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class RandomIntegerServer implements ProducerInterface
{

    /**
     * Publish a message
     *
     * @param string $msgBody
     * @param string $routingKey
     * @param array  $additionalProperties
     */
    public function publish($msgBody, $routingKey = '', $additionalProperties = array())
    {
        $msgBody = '1';
        $this->publish($msgBody);
    }
}