<?php
namespace ExpenseTracker\Model;

use Buzz\Browser;

/**
 *
 * @author Bora Tunca
 */
class Api
{
    const PARTNER_NAME = 'applicant';
    const PARTNER_PASSWORD = 'd7c3119c6cdab02d68d9';

    private $browser;

    /**
     *
     */
    public function __construct(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     *
     * @param string $commandName
     * @param array $additionalData
     */
    private function buildApiQuery($commandName, array $additionalData)
    {
        $queryParams = array_merge(array(
            'command' => $commandName,
            'partnerName' => self::PARTNER_NAME,
        ), $additionalData);

        return 'https://api.expensify.com?' . http_build_query($queryParams);
    }

    /**
     *
     * @param string $email
     * @param string $password
     */
    public function authenticate($email, $password)
    {
        $url = $this->buildApiQuery('Authenticate', array(
            'partnerPassword' => self::PARTNER_PASSWORD,
            'partnerUserID' => $email,
            'partnerUserSecret' => $password,
        ));

        $response = $this->browser->get($url);
        return json_decode($response->getContent());
    }

    /**
     *
     * @param string $authToken
     */
    public function fetchTransactionList($authToken)
    {
        $url = $this->buildApiQuery('Get', array(
            'authToken' => $authToken,
            'returnValueList' => 'transactionList',
        ));

        $response = $this->browser->get($url);
        return json_decode($response->getContent());
    }
}
