<?php
/**
 * Created by PhpStorm.
 * User: Ecole-IPPSI
 * Date: 01/02/2019
 * Time: 10:50
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BookingControllerTest extends WebTestCase
{
    public static function setUpBeforeClass()
    {
        exec('php bin/console hautelook:fixtures:load --purge-with-truncate');

        parent::setUpBeforeClass();
    }

    /*Get All Booking*/
    /**
     * @group SuccesBooking
     */
    public function testGetApiAdminAllBooking()
    {
        $client = static::createClient();
        $client->request('GET', '/api/Bookings', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
            ]
        );
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);

        $arrayContent = \json_decode($content, true);
        $this->assertCount(10, $arrayContent);
    }

    /*Get One Booking*/
    /**
     * @group SuccesBooking
     */
    public function testGetApiAdminOneBooking()
    {
        $client = static::createClient();
        $client->request('GET', '/api/Bookings/3', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
            ]
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $Bookings = \json_decode($content, true);

        $this->assertArrayHasKey('id', $Bookings);
        $this->assertArrayHasKey('name', $Bookings);
        $this->assertArrayHasKey('slogan', $Bookings);
        $this->assertArrayHasKey('url', $Bookings);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /*Add new Booking by admin*/
    /**
     * @group SuccesBooking
     */
    public function testPostApiAdminAddBooking()
    {
        $client = static::createClient();
        $client->request('POST', '/api/admin/Bookings/add', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],
            '{
            "name": "NewBooking",
            "slogan": "MyBooking",
            "url": "BookingUrl"
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJson($content);
    }

    /*Fail and new Booking by admin*/
    /**
     * @group FailBooking
     */
    public function testPostFailApiAdminAddBooking()
    {
        $client = static::createClient();
        $client->request('POST', '/api/admin/Bookings/add', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],
            '{
            "name": "",
            "slogan": ""
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($content);
    }

    /*Edit Booking by admin*/
    /**
     * @group SuccesBooking
     */
    public function testPatchApiAdminAddBooking()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/Bookings/edit/5', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],
            '{
            "name": "NewPatchBooking",
            "slogan": "MyPatchBooking",
            "url": "PatchBookingUrl"
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
    }

    /*Fail Edit Booking by admin. Can't be blank.*/
    /**
     * @group FailBooking
     */
    public function testPatchFailApiAdminAddBooking()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/Bookings/edit/5', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],
            '{
            "name": "",
            "slogan": ""
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($content);
    }

    /*Fail Edit Booking by admin. Valide url.*/
    /**
     * @group FailBooking
     */
    public function testPatchFailUrlApiAdminAddBooking()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/admin/Bookings/edit/5', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ],
            '{
            "url": "notUnUrl",
            }'
        );

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($content);
    }

    /*Remove Booking by admin*/
    /**
     * @group SuccesBooking
     */
    public function testDeleteApiAdminBooking()
    {
        $client = static::createClient();
        $client->request('Delete', '/api/admin/Bookings/remove/7', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );

        $response = $client->getResponse();
        $this->assertEquals(204, $response->getStatusCode());
    }

    /*Fail Remove Booking by admin*/
    /**
     * @group FailBooking
     */
    public function testDeleteFailApiAdminBooking()
    {
        $client = static::createClient();
        $client->request('Delete', '/api/admin/Bookings/remove/4', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => '72312'
            ]
        );

        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }
}