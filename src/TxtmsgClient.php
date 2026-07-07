<?php

namespace Txtmsg\PhpSdk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class TxtmsgClient
{
    private string $apiKey;

    private string $baseUrl;

    private GuzzleClient $http;

    public function __construct(
        string $apiKey,
        ?string $baseUrl = null,
        ?GuzzleClient $http = null,
    ) {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl ?? 'https://sms.txtmsg.lk/api/v3', '/');
        $this->http = $http ?? new GuzzleClient();
    }

    private function request(string $method, string $endpoint, array $params = []): array
    {
        $urlParams = [];
        foreach ($params as $key => $value) {
            if (str_contains($endpoint, '{' . $key . '}')) {
                $endpoint = str_replace('{' . $key . '}', (string) $value, $endpoint);
                $urlParams[] = $key;
            }
        }

        foreach ($urlParams as $key) {
            unset($params[$key]);
        }

        $url = $this->baseUrl . $endpoint;
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ];

        $method = strtoupper($method);

        if ($method === 'GET') {
            $options['query'] = $params;
        } elseif (!empty($params)) {
            $options['json'] = $params;
        }

        try {
            $response = $this->http->request($method, $url, $options);

            return $this->decodeResponse($response);
        } catch (GuzzleException $e) {
            if ($e->hasResponse()) {
                $body = $this->decodeResponse($e->getResponse());
                throw new TxtmsgException(
                    $body['message'] ?? $e->getMessage(),
                    $e->getResponse()->getStatusCode(),
                );
            }

            throw new TxtmsgException($e->getMessage(), 0, $e);
        }
    }

    private function decodeResponse(ResponseInterface $response): array
    {
        return json_decode((string) $response->getBody(), true) ?? [];
    }

    public function viewAllContactGroups(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    public function createContactGroup(array $params = []): array
    {
        return $this->request('POST', '/contacts', $params);
    }

    public function viewContactGroup(string $groupId, array $params = []): array
    {
        $params['group_id'] = $groupId;

        return $this->request('POST', '/contacts/{group_id}/show', $params);
    }

    public function updateContactGroup(string $groupId, array $params = []): array
    {
        $params['group_id'] = $groupId;

        return $this->request('PATCH', '/contacts/{group_id}', $params);
    }

    public function deleteContactGroup(string $groupId, array $params = []): array
    {
        $params['group_id'] = $groupId;

        return $this->request('DELETE', '/contacts/{group_id}', $params);
    }

    public function createContact(string $groupId, array $params = []): array
    {
        $params['group_id'] = $groupId;

        return $this->request('POST', '/contacts/{group_id}/store', $params);
    }

    public function viewContact(string $groupId, string $uid, array $params = []): array
    {
        $params['group_id'] = $groupId;
        $params['uid'] = $uid;

        return $this->request('POST', '/contacts/{group_id}/search/{uid}', $params);
    }

    public function updateContact(string $groupId, string $uid, array $params = []): array
    {
        $params['group_id'] = $groupId;
        $params['uid'] = $uid;

        return $this->request('PATCH', '/contacts/{group_id}/update/{uid}', $params);
    }

    public function deleteContact(string $groupId, string $uid, array $params = []): array
    {
        $params['group_id'] = $groupId;
        $params['uid'] = $uid;

        return $this->request('DELETE', '/contacts/{group_id}/delete/{uid}', $params);
    }

    public function viewAllContactsInGroup(string $groupId, array $params = []): array
    {
        $params['group_id'] = $groupId;

        return $this->request('POST', '/contacts/{group_id}/all', $params);
    }

    public function sendSMS(array $params = []): array
    {
        return $this->request('POST', '/sms/send', $params);
    }

    public function sendSMSViaGet(array $params = []): array
    {
        return $this->request('GET', '/http/sms/send', $params);
    }

    public function sendCampaign(array $params = []): array
    {
        return $this->request('POST', '/sms/campaign', $params);
    }

    public function viewSMS(string $uid, array $params = []): array
    {
        $params['uid'] = $uid;

        return $this->request('GET', '/sms/{uid}', $params);
    }

    public function viewAllMessages(array $params = []): array
    {
        return $this->request('GET', '/sms', $params);
    }

    public function viewCampaign(string $uid, array $params = []): array
    {
        $params['uid'] = $uid;

        return $this->request('GET', '/campaign/{uid}/view', $params);
    }

    public function viewBalance(array $params = []): array
    {
        return $this->request('GET', '/balance', $params);
    }

    public function viewProfile(array $params = []): array
    {
        return $this->request('GET', '/me', $params);
    }
}
