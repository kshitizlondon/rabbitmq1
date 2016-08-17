<?php

namespace AppBundle\Producer;

use PhpAmqpLib\Message\AMQPMessage;

class RandomIntegerServer
{
    const RANDOM_NUMBER_LABEL = 'Server Random Number: ';

    public function execute(AMQPMessage $args)
    {
        $body = unserialize($args->getBody());
        return static::RANDOM_NUMBER_LABEL . rand($body['min'], $body['max']);
    }
}