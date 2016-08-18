<?php

namespace AppBundle\Controller;

use FOS\OAuthServerBundle\Util\Random;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return string
     */
    public function indexAction()
    {
	   return new Response('url to send message: http://rabbit.dev/send');
    }

    /**
     * @Route("/send", name="send_message_to_que")
     */
    public function sendMessageAction($message = 'Message sent from APP 1')
    {
        $this->get('old_sound_rabbit_mq.hello_rabbitmq1_producer')->publish($message);

        return new Response($message);
    }

    /**
     * @Route("/rpc", name="send_message_using_rpc")
     */
    public function rpcAction()
    {
        $requestId = mt_rand(5,10);
        $client = $this->get('old_sound_rabbit_mq.integer_store_rpc');
        $client->addRequest(serialize(array('min' => 0, 'max' => 10)), 'random_int', $requestId);
        $replies = $client->getReplies();

        if (array_key_exists($requestId, $replies)) {
            return new Response(json_encode($replies));
        }
    }
}
