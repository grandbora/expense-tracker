<?php
namespace ExpenseTracker\Test\Model;

use ExpenseTracker\Model\TransactionList;

/**
 *
 * @author Bora Tunca
 */
class TransactionListTest extends \PHPUnit_Framework_TestCase
{
    private $api;
    private $transactionList;
    private $authToken;

    /**
     *
     */
    protected function setUp()
    {
        $this->api = $this->getMockBuilder('\ExpenseTracker\Model\Api')
                    ->disableOriginalConstructor()
                    ->getMock();

        $this->transactionList = new TransactionList($this->api);

        $this->authToken = 'authToken';
        $this->transactionList->setAuthToken($this->authToken);
    }

    /**
     *
     */
    public function testFetchSucceeds()
    {
        $transactionPartStr = '[{"dummy":"dummy"},{"dummy":"dummy2"}]';
        $mockedRes = json_decode('{"transactionList":'.$transactionPartStr.',"httpCode":200,"jsonCode":200}');

        $this->api->expects($this->once())
            ->method('fetchTransactionList')
            ->with($this->equalTo($this->authToken))
            ->will($this->returnValue($mockedRes));

        $actual = $this->transactionList->fetch();
        $this->assertTrue($actual);

        $actual = json_encode($this->transactionList);
        $this->assertEquals($transactionPartStr, $actual);
    }

    /**
     *
     */
    public function testFetchFails()
    {
        $mockedRes = json_decode('{"httpCode":404,"jsonCode":404}');

        $this->api->expects($this->once())
            ->method('fetchTransactionList')
            ->with($this->equalTo($this->authToken))
            ->will($this->returnValue($mockedRes));

        $actual = $this->transactionList->fetch();
        $this->assertFalse($actual);
    }
}
