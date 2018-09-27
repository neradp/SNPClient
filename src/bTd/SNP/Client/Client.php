<?php
/**
 * Project: SNPClient
 *
 * @author    Peter Nerád <nerad.peter@gmail.com>
 * @copyright 2018 Peter Nerád
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace bTd\SNP\Client;

use bTd\SNP\Protocol\Message\Request;
use bTd\SNP\Protocol\Message\Request\ForwardRequest;
use bTd\SNP\Protocol\Message\Request\NotifyRequest;
use bTd\SNP\Protocol\Message\Request\RegisterRequest;
use bTd\SNP\Protocol\Message\Response;


/**
 * Class Client
 *
 * @package bTd\SNP\Client
 */
class Client
{
    /**
     * @var int Port of server
     */
    private $port = 9731;
    /**
     * @var null|resource
     */
    private $socket = null;
    /**
     * @var string IP address of server
     */
    private $host;
    /**
     * @var null|string Password used to verify messages against server
     */
    private $password = null;
    /**
     * @var null Application registration identification
     */
    private $appID = null;


    /**
     * Client constructor.
     *
     * @param string      $host     Server IP address.
     * @param int         $port     Server port.
     * @param string|null $password Password to verify.
     *
     * @throws \RuntimeException
     */
    public function __construct(string $host, int $port=9731, string $password=null)
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->password = $password;
        // Create socket.
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or $this->error();
        $this->connect();

    }//end __construct()


    /**
     * Compose RuntimeException from socket error and throws it.
     *
     * @return void
     * @throws \RuntimeException
     */
    private function error(): void
    {
        $code = socket_last_error($this->socket);
        $msg  = socket_strerror($code);
        throw new \RuntimeException($msg, $code);

    }//end error()


    /**
     * Connect socket  to server.
     *
     * @return void
     * @throws \RuntimeException
     */
    private function connect():void
    {

        socket_connect($this->socket, $this->host, $this->port) or $this->error();

    }//end connect()


    /**
     * Send raw data to socket.
     *
     * @param string $data Data to send to opened socket.
     *
     * @return void
     * @throws \RuntimeException
     */
    private function send(string $data):void
    {

        socket_write($this->socket, $data, strlen($data)) or $this->error();

    }//end send()


    /**
     * Read raw data from opened socket.
     *
     * @return string
     */
    private function get(): string
    {

        return socket_read($this->socket, 10000);

    }//end get()


    /**
     * Send SNP Request message to server.
     *
     * @param Request $request
     *
     * @return Response
     * @throws \bTd\SNP\Protocol\Message\Response\ErrorResponseException|\Exception
     */
    protected function sendRequest(Request $request): Response
    {
        // Set password authentication for request.
        if ($this->password !== null) {
            $request->authenticate($this->password);
        }

        $this->send((string) $request);
        $response = new Response($this->get());
        return $response;

    }//end sendRequest()


    /**
     * Send SNP Notify Request message to server.
     *
     * @param NotifyRequest $notification
     *
     * @return Response
     * @throws \bTd\SNP\Protocol\Message\Response\ErrorResponseException
     */
    public function notify(NotifyRequest $notification): Response
    {
        if ($this->appID !== null) {
            $notification->setApplicationIdentification($this->appID);
        }

        $response = $this->sendRequest($notification);
        return $response;

    }//end notify()


    /**
     * Send SNP Register Request message to server.
     *
     * @param RegisterRequest $application
     *
     * @return Response
     * @throws \bTd\SNP\Protocol\Message\Response\ErrorResponseException
     */
    public function register(RegisterRequest $application): Response
    {

        $response    = $this->sendRequest($application);
        $this->appID = $application->getApplicationIdentification();
        return $response;

    }//end register()


    /**
     *  Send SNP Forward Request message to server.
     *
     * @param ForwardRequest $forward
     *
     * @return Response
     * @throws \bTd\SNP\Protocol\Message\Response\ErrorResponseException
     */
    public function forward(ForwardRequest $forward): Response
    {
        $response = $this->sendRequest($forward);
        return $response;

    }//end forward()


    /**
     * Destructor - close opened socket
     */
    public function __destruct()
    {
        if (is_resource($this->socket) === true) {
            socket_close($this->socket);
        }

    }//end __destruct()


}//end class
