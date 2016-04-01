<?php

namespace macklus\crawler;

use yii\base\Component;
use Goutte\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\SeekException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use GuzzleHttp\Exception\TransferException;

/*
 * Example:
 * $crawler = new Crawler();
 * $crawler->useUser('jhon')->useUA('chrome')->useProxy('miproxy')->connect('testConn', 'http://testcont');
 * if( $crawler->isConnected('testConn') ) {
 *
 * }
 *
 */

class Crawler extends Component
{

    private $_conectionsPool = [];
    private $_uas = [
        'chrome' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        'firefox' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
        'explorer' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
    ];
    private $_proxys = [];
    private $_users = [];
    private $_useProxy = '';
    private $_useUA = '';
    private $_username = '';
    private $_password = '';

//    public function connect()
//    {
//        $this->connection = new Client([
//            'request.options' => [
//                'exceptions' => false,
//            ],
//        ]);
//        $this->setTimeout(10);
//
//        $this->setUserAgent();
//
//        return true;
//    }
//
//    public function setTimeout($time)
//    {
//        $guzzleClient = new \GuzzleHttp\Client(['curl' => [
//                CURLOPT_TIMEOUT => $time,
//            ],
//        ]);
//        $this->connection->setClient($guzzleClient);
//    }

    public function connect($var)
    {
        $this->$var = 'algo';
    }

    public function __set($name, $value)
    {
        if (!isset($this->{$name})) {
            $this->{$name} = $value;
            return true;
        } else {
            return parent::__set($name, $value);
        }
    }

    public function setUserAgent()
    {
        $this->connection->setHeader('User-Agent', $this->userAgent);
    }

    public function setProxy($name, $string)
    {
        $this->_proxys[$name] = $string;
        return $this;
    }

    public function setProxys($proxys = [])
    {
        foreach ($proxys as $name => $string) {
            $this->setProxy($name, $string);
        }
        return $this;
    }

    public function useProxy($name)
    {
        if (isset($this->_proxys[$name])) {
            $this->_useProxy = $this->_proxys[$name];
        }
        return $this;
    }

    public function setUser($name, $user, $password)
    {
        $this->_users[$name] = ['username' => $user, 'password' => $password];
        return $this;
    }

    public function setUsers($users = [])
    {
        foreach ($users as $name => $data) {
            $this->setUser($name, $data['username'], $data['password']);
        }
        return $this;
    }

    public function useUser($name)
    {
        if (isset($this->_users[$name])) {
            $this->_username = $this->_users[$name]['username'];
            $this->_password = $this->_users[$name]['password'];
        }
        return $this;
    }

    public function setUA($name)
    {
        if (isset($this->_uas[$name])) {
            $this->_useUA = $this->_uas[$name];
        }
        return $this;
    }
}
