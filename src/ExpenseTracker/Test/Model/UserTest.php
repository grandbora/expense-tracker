<?php
namespace ExpenseTracker\Test\Model;

use ExpenseTracker\Model\User;

/**
 *
 * @author Bora Tunca
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    private $api;
    private $user;
    private $accountId;
    private $email;
    private $password;
    private $authToken;

    /**
     *
     */
    protected function setUp()
    {
        $this->api = $this->getMockBuilder('\ExpenseTracker\Model\Api')
                    ->disableOriginalConstructor()
                    ->getMock();

        $this->user = new User($this->api);

        $this->accountId = 12;
        $this->email = 'email';
        $this->password = 'password';
        $this->authToken = 'authToken';

        $this->user->setAccountId($this->accountId);
        $this->user->setEmail($this->email);
        $this->user->setPassword($this->password);
        $this->user->setAuthToken($this->authToken);
    }

    /**
     *
     */
    public function testJsonEncode()
    {
        $expected = sprintf(
            '{"accountId":%d,"email":"%s","password":"%s","authToken":"%s"}',
            $this->accountId,
            $this->email,
            $this->password,
            $this->authToken
        );
        $actual = json_encode($this->user);
        $this->assertEquals($expected, $actual);
    }

    /**
     *
     */
    public function testAuthenticateSucceeds()
    {
        $user = new User($this->api);
        $user->setEmail($this->email);
        $user->setPassword($this->password);

        $mockedResStr = sprintf(
            '{"accountID":%d,"authToken":"%s","email":"%s","httpCode":200,"jsonCode":200}',
            $this->accountId,
            $this->authToken,
            $this->email
        );

        $mockedRes = json_decode($mockedResStr);

        $this->api->expects($this->once())
            ->method('authenticate')
            ->with($this->equalTo($this->email), $this->equalTo($this->password))
            ->will($this->returnValue($mockedRes));

        $actual = $user->authenticate();

        $this->assertTrue($actual);
        $this->assertEquals($this->accountId, $user->getAccountId());
        $this->assertEquals($this->authToken, $user->getAuthToken());
    }

    /**
     *
     */
    public function testAuthenticateFails()
    {
        $user = new User($this->api);
        $user->setEmail($this->email);
        $user->setPassword($this->password);

        $mockedRes = json_decode('{"httpCode":401,"jsonCode":401}');

        $this->api->expects($this->once())
            ->method('authenticate')
            ->with($this->equalTo($this->email), $this->equalTo($this->password))
            ->will($this->returnValue($mockedRes));

        $actual = $user->authenticate();

        $this->assertFalse($actual);
    }
}