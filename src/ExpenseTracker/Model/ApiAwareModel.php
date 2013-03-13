<?php
namespace ExpenseTracker\Model;

use ExpenseTracker\Model\Api;

/**
 *
 * @author Bora Tunca
 */
abstract class ApiAwareModel implements \JsonSerializable 
{
    protected $api;
    private $authToken;

    /**
     *
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
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
}
