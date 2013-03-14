<?php
namespace ExpenseTracker\Model;

/**
 *
 * @author Bora Tunca
 */
class Transaction extends ApiAwareModel 
{
    private $created;
    private $amount;
    private $merchant;

    /**
     *
     * @param string $created
     */
    public function setCreated($created)
    {
       $this->created = $created;
    }

    /**
     *
     * @return string
     */
    public function getCreated()
    {
       return $this->created;
    }

    /**
     *
     * @param string $amount
     */
    public function setAmount($amount)
    {
       $this->amount = $amount;
    }

    /**
     *
     * @return string
     */
    public function getAmount()
    {
       return $this->amount;
    }

    /**
     *
     * @param string $merchant
     */
    public function setMerchant($merchant)
    {
       $this->merchant = $merchant;
    }

    /**
     *
     * @return string
     */
    public function getMerchant()
    {
       return $this->merchant;
    }

    /**
     *
     * @return bool
     */
    public function save() 
    {
        $res = $this->api->saveTransaction(
            $this->getAuthToken(),
            $this->getCreated(),
            $this->getAmount(),
            $this->getMerchant()
        );
        if (false === isset($res->httpCode) || 200 !== $res->httpCode) {
            return false;
        }

        return true;
    }
}
