<?php
namespace ExpenseTracker\Test\Model;

use ExpenseTracker\Model\Transaction;

/**
 *
 * @author Bora Tunca
 */
class TransactionTest extends \PHPUnit_Framework_TestCase
{
    private $api;
    private $transaction;
    private $authToken;

    /**
     *
     */
    protected function setUp()
    {
        $this->api = $this->getMockBuilder('\ExpenseTracker\Model\Api')
                    ->disableOriginalConstructor()
                    ->getMock();

        $this->transaction = new Transaction($this->api);

        $this->authToken = 'authToken';
        $this->transaction->setAuthToken($this->authToken);
    }

    /**
     *
     */
    public function testSaveSucceeds()
    {
        $transactionPartStr = '[{"dummy":"dummy"},{"dummy":"dummy2"}]';
        $mockedRes = json_decode('{"transactionList":'.$transactionPartStr.',"httpCode":200,"jsonCode":200}');

        $this->api->expects($this->once())
            ->method('saveTransaction')
            ->with($this->equalTo($this->authToken))
            ->will($this->returnValue($mockedRes));

        $actual = $this->transaction->save();
        $this->assertTrue($actual);

        $actual = json_encode($this->transaction);
        $this->assertEquals($transactionPartStr, $actual);
    }

    /**
     *
     */
    public function testSaveFails()
    {
        $mockedRes = json_decode('{"httpCode":402,"jsonCode":402}');

        $this->api->expects($this->once())
            ->method('saveTransaction')
            ->will($this->returnValue($mockedRes));

        $actual = $this->transaction->save();
        $this->assertFalse($actual);
    }
}
