<?php

use App\Models\HubspotContact;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;

if (!function_exists('getContact')) {

    /**
     * Get contact From Hubspot
     *
     */
    function getContact()
    {

        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->getPage(100,true);
            return $apiResponse['results'];
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        }
    }
}

if (!function_exists('createHubspotUser')) {

    /**
     * Create Hubspot Contact when new user created in our app
     *
     */
    function createHubspotUser($data)
    {
        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        $nameParts = explode(" ", $data['name']);
        $firstName = $nameParts[0];
        $lastName = "";
        if(array_key_exists(1,$nameParts)) {
        $lastName = $nameParts[1];
        }
        $properties1 = [
            'email' => $data['email'],
            'firstname' => $firstName,
            'lastname' => $lastName,
        ];
        $simplePublicObjectInputForCreate = new SimplePublicObjectInput([
            'properties' => $properties1,
            'associations' => null,
        ]);
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->create($simplePublicObjectInputForCreate);
            $hubspotContactId = $apiResponse['id'];
            HubspotContact::create(['user_id' => $data['user_id'], 'hubspot_contact_id' => $hubspotContactId]);
            return true;
        } catch (ApiException $e) {
            return false;
        }
        return true;
    }
}

if (!function_exists('updateContact')) {

    /**
     * Update Hubspot user with our database user
     * 
     */
    function updateContact($data)
    {

        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        $nameParts = explode(" ", $data['name']);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1];
        $properties1 = [
            'firstname' => $firstName,
            'lastname' => $lastName,
        ];
        $hubspotContactId = HubspotContact::where('user_id',auth()->user()->id)->pluck('hubspot_contact_id')->first();
        $simplePublicObjectInput = new SimplePublicObjectInput([
            'properties' => $properties1,
        ]);
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->update($hubspotContactId, $simplePublicObjectInput);
            return true;
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->update: ", $e->getMessage();
        }
    }
}

if (!function_exists('deleteContact')) {

    /**
     * Delete Contact From Hubspot as well from database
     *
     */
    function deleteContact($id)
    {

        $client = Factory::createWithAccessToken(env('HUBSPOT_ACCESS_TOKEN'));
        try {
            $client->crm()->contacts()->basicApi()->archive($id);
            return true;
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->update: ", $e->getMessage();
        }
    }
}