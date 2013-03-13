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
     * @param string $email
     * @param string $password
     */
    public function authenticate($email, $password)
    {
        $url = 'https://api.expensify.com?';
        $url .= http_build_query(array(
            'command' => 'Authenticate',
            'partnerName' => self::PARTNER_NAME,
            'partnerPassword' => self::PARTNER_PASSWORD,
            'partnerUserID' => $email,
            'partnerUserSecret' => $password
        ));

        $response = $this->browser->get($url);
        return json_decode($response->getContent());
    }
}