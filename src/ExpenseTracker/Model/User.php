<?php
namespace ExpenseTracker\Model;

use ExpenseTracker\Model\Api;

/**
 *
 * @author Bora Tunca
 */
class User implements \JsonSerializable 
{

    private $api;
    private $accountId;
    private $email;
    private $password;
    private $authToken;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     *
     */
    public function authenticate()
    {
        $res = $this->api->authenticate($this->getEmail(), $this->getPassword());
        $this->setAccountId($res->accountID);
        $this->setAuthToken($res->authToken);
    }

    /**
     *
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
       $this->accountId = (int)$accountId;
    }

    /**
     *
     * @return int
     */
    public function getAccountId()
    {
       return $this->accountId;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email)
    {
       $this->email = $email;
    }

    /**
     *
     * @return string
     */
    public function getEmail()
    {
       return $this->email;
    }

    /**
     *
     * @param string $password
     */
    public function setPassword($password)
    {
       $this->password = $password;
    }

    /**
     *
     * @return string
     */
    public function getPassword()
    {
       return $this->password;
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
     * @return StdClass
     */
    public function jsonSerialize() {
        $jsonObject = new \StdClass();
        $jsonObject->accountId = $this->getAccountId();
        $jsonObject->email = $this->getEmail();
        $jsonObject->password = $this->getPassword();
        $jsonObject->authToken = $this->getAuthToken();
        return $jsonObject;
    }
}
