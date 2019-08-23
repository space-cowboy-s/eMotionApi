<?php
/**
 * Created by PhpStorm.
 * User: Ecole-IPPSI
 * Date: 01/02/2019
 * Time: 10:50
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AdminControllerTest extends WebTestCase
{
    public static function setUpBeforeClass()
    {
        exec('php bin/console hautelook:fixtures:load --purge-with-truncate');

        parent::setUpBeforeClass();
    }

    /**
     * @group SuccesAdmin
     */
    public function testGetApiAdminProfile()
    {
        $client = static::createClient();
        $client->request('GET', '/api/admin/profile', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );
        $response = $client->getResponse();
        $userjson = $response->getContent();
        $user = \json_decode($userjson, true);
        $this->assertArrayHasKey('id', $user);
        $this->assertArrayHasKey('firstname', $user);
        $this->assertArrayHasKey('lastname', $user);
        $this->assertArrayHasKey('email', $user);
        $this->assertArrayHasKey('adress', $user);
        $this->assertArrayHasKey('country', $user);
        $this->assertArrayHasKey('roles', $user);
        $this->assertArrayHasKey('apiKey', $user);
        $this->assertArrayHasKey('Booking', $user);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group SuccesAdmin
     */
    public function testGetApiUserProfile()
    {
        $client = static::createClient();
        $client->request('GET', '/api/admin/users/profile/3', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );

        $response = $client->getResponse();
        $userjson = $response->getContent();

        $user = \json_decode($userjson, true);

        $this->assertArrayHasKey('id', $user);
        $this->assertArrayHasKey('firstname', $user);
        $this->assertArrayHasKey('lastname', $user);
        $this->assertArrayHasKey('email', $user);
        $this->assertArrayHasKey('adress', $user);
        $this->assertArrayHasKey('country', $user);
        $this->assertArrayHasKey('roles', $user);
        $this->assertArrayHasKey('apiKey', $user);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group SuccesAdmin
     */
    public function testGetApiAllUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/api/admin/users', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);

        $arrayContent = \json_decode($content, true);
        $this->assertCount(10, $arrayContent);
    }

    /**
     * @group SuccesAdmin
     */
    public function testPostApiAdminAddUsers()
    {
        $client = static::createClient();
        $client->request('POST', '/api/admin/users/add', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],
            '{
            "firstname": "NewFirstName",
            "lastname": "NewLastName",
            "email": "testPostAdminAddUsers@gmail.com",
            "adress": "NewAdress",
            "country": "NewCountry",
            "Booking": {
		                        "id": 4
	                         }
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * @group SuccesAdmin
     */
    public function testPatchApiAdminProfile()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/profile', [], [],

            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],

            '{
            "firstname": "EditAdminName",
            "lastname": "EditAdminLastName",
            "email": "testPatchApiAdminProfile@gmail.com",
            "adress": "EditAdminAdress",
            "country": "EditAdminCountry",
            "Booking": {
		                        "id": 5
	                         } 
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * @group FailAdmin
     */
    public function testPatchFailApiAdminProfile()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/profile', [], [],

            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],

            '{
            "firstname": "EditAdminName",
            "lastname": "EditAdminLastName",
            "email": "testPatchApiAdminProfile",
            "adress": "EditAdminAdress",
            "country": "EditAdminCountry" 
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * @group SuccesAdmin
     */
    public function testPatchApiAdminUserProfile()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/users/profile/4', [], [],

            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],

            '{
            "firstname": "EditUserNameByAdmin",
            "lastname": "EditUserLastNameByAdmin",
            "email": "testPatchApiAdminUserProfileByAdmin@gmail.com",
            "adress": "EditUserAdressByAdmin",
            "country": "EditUserCountryByAdmin",
            "Booking": {
		                        "id": 3
	                         }
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * @group FailAdmin
     */
    public function testPatchFailApiAdminUserProfile()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/users/profile/4', [], [],

            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],

            '{
            "firstname": "EditUserNameByAdmin",
            "lastname": "EditUserLastNameByAdmin",
            "email": "testPatchApiAdminUserProfileByAdmin",
            "adress": "EditUserAdressByAdmin",
            "country": "EditUserCountryByAdmin" 
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * @group SuccesAdmin
     */
    public function testDeleteApiProfileUsers()
    {
        $client = static::createClient();
        $client->request('Delete', '/api/admin/users/profile/remove/10', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );

        $response = $client->getResponse();
        $this->assertEquals(204, $response->getStatusCode());
    }
}