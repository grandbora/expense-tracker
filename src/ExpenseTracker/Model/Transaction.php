<?php
namespace ExpenseTracker\Model;

/**
 *
 * @author Bora Tunca
 */
class Transaction extends ApiAwareModel 
{
    private $transactionContainer;

    /**
     *
     * @return bool
     */
    public function save() 
    {

        $res = $this->api->saveTransaction($this->getAuthToken());
        if (false === isset($res->httpCode) || 200 !== $res->httpCode) {
            return false;
        }

        $this->transactionContainer = $res->transactionList;
        return true;
    }

    /**
     *
     * @return array
     */
    public function jsonSerialize() 
    {
        return $this->transactionContainer;
    }
}
