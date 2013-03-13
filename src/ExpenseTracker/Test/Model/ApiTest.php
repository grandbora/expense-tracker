<?php
namespace ExpenseTracker\Test\Model;

use ExpenseTracker\Model\Api;
use Buzz\Message\Response;

/**
 *
 * @author Bora Tunca
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    private $api;
    private $browser;

    /**
     *
     */
    protected function setUp()
    {
        $this->browser = $this->getMockBuilder('\Buzz\Browser')
            ->disableOriginalConstructor()
            ->getMock();
        $this->api = new Api($this->browser);
    }

    /**
     *
     */
    public function testAuthenticate()
    {
        $email = 'email';
        $password = 'password';
        $accountId = 1234;
        $authToken = '1234ASAD';

        $url = "https://api.expensify.com?";
        $url .= "command=Authenticate";
        $url .= "&partnerName=" . Api::PARTNER_NAME;
        $url .= "&partnerPassword=". Api::PARTNER_PASSWORD;
        $url .= "&partnerUserID=$email";
        $url .= "&partnerUserSecret=$password";

        $jsonStr = sprintf(
            '{"accountID":%d,"authToken":"%s","email":"%s","httpCode":200,"jsonCode":200}',
            $accountId,
            $authToken,
            $email
        );
        $response = new Response();
        $response->setContent($jsonStr);

        $this->browser->expects($this->once())
            ->method('get')
            ->with($this->equalTo($url))
            ->will($this->returnValue($response));

        $actual = $this->api->authenticate('email', 'password');
        $expected = json_decode($jsonStr);

        $this->assertEquals($expected, $actual);
    }
}