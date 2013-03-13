<?php
namespace ExpenseTracker\Model;

/**
 *
 * @author Bora Tunca
 */
class TransactionList extends ApiAwareModel 
{
    private $transactionContainer;

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
     * @return array
     */
    public function jsonSerialize() {
        return $this->transactionContainer;
    }
}
