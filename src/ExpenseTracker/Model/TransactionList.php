<?php
namespace ExpenseTracker\Model;

use ExpenseTracker\Model\Api;

/**
 *
 * @author Bora Tunca
 */
class TransactionList implements \JsonSerializable 
{

    private $api;
    private $authToken;
    private $transactionContainer;

    /**
     *
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     *
     * @return bool
     */
    public function fetch()
    {
       $res = $this->api->fetchTransactionList($this->getAuthToken());
       if (false === isset($res->httpCode) || 200 !== $res->httpCode) {
            return false;
        }

        $this->transactionContainer = $res->transactionList;
        return true;
    }

    /**
     *
     * @param string $authToken
     */
    public function setAuthToken($authToken)
    {
       $this->authToken = $authToken;
    }

    /**
     *
     * @return string
     */
    public function getAuthToken()
    {
       return $this->authToken;
    }

    /**
     *
     * @return array
     */
    public function jsonSerialize() {
        return $this->transactionContainer;
    }
}
