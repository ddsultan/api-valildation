<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends TestCase implements Context
{
    private $response = null;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am a anonymous user
     */
    public function iAmAAnonymousUser()
    {
       return true;
    }

    /**
     * @When I search for :repo
     */
    public function iSearchFor($repo)
    {
        $client = new Client(['base_uri' => 'https://api.github.com']);
        $this->response = $client->get('/search/repositories?q=' . $repo);
    }

    /**
     * @Then I get a result
     */
    public function iGetAResult()
    {
        $statusCode = $this->response->getStatusCode();
        $data = json_decode($this->response->getBody(), true);
        
        $this->assertEquals($statusCode, 200);
        $this->assertTrue($data['total_count'] > 0);
    }
}
