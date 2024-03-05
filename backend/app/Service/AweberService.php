<?php


namespace App\Service;


use App\Model\Settings;
use GuzzleHttp\Client;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;

class AweberService
{
    const BASE_URL = 'https://api.aweber.com/1.0/';
    const OAUTH_URL = 'https://auth.aweber.com/oauth2/';
    const TOKEN_URL = 'https://auth.aweber.com/oauth2/token';

    public $client;
    public $credentials = [];

    /**
     * AweberService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        // Create a Guzzle client
        $this->client = new Client();
        $aweberSettings = Settings::where('key', 'aweber')->first();
        if ($aweberSettings) {
            $this->credentials = json_decode($aweberSettings->value, true);
            if ($this->refreshCredentials()) {
                $this->credentials['accessToken'];
            }
        }
    }

    public function getCollection(string $url): array
    {
        $collection = [];
        while (isset($url)) {
            $request = $this->client->get(
                $url,
                ['headers' => ['Authorization' => 'Bearer ' . $this->credentials['accessToken']]]
            );
            $body = $request->getBody();

            $page = json_decode($body, true);
            if (isset($page['entries'])) {
                $collection = array_merge($page['entries'], $collection);
            }
            $url = isset($page['next_collection_link']) ? $page['next_collection_link'] : null;
        }

        return $collection;
    }

    public function subscribe(string $email, array $tags = [], array $customFields = []): array
    {
        $accounts = $this->getCollection(self::BASE_URL . 'accounts');

        $listsUrl = $accounts[0]['lists_collection_link'] ?? null;
        $lists = $this->getCollection($listsUrl);

        $subsUrl = $lists[0]['subscribers_collection_link'] ?? null;
        $foundSubscribers = $this->getCollection(
            $subsUrl . '?' . http_build_query(
                array(
                    'ws.op' => 'find',
                    'email' => $email
                )
            )
        );

        return isset($foundSubscribers[0]['self_link']) ?
            $this->updateSubscriber($foundSubscribers, $tags, $customFields) :
            $this->createSubscriber($email, $subsUrl, $tags, $customFields);
    }

    /**
     * @param string $formName
     * @param string $email
     * @return array|null
     */
    public function formSubscribe(string $formName, string $email): ?array
    {
        if (!in_array($formName, [
            'blog-page'
        ])) {
            return null;
        }

        return $this->subscribe($email, [
            'registered',
            $formName
        ],
        [
            'role' => 'user',
            'username' => $email,
        ]);
    }

    public function updateSubscriber(array $foundSubscribers, array $tags = [], array $customFields = []): array
    {
        $data = array(
            'custom_fields' => $customFields, // TODO: add custom fields
            'tags' => ['add' => $tags],
            'update_existing' => 'true',
            'last_followup_message_number_sent' => 0
        );
        $subscriberUrl = $foundSubscribers[0]['self_link'] ?? null;
        $subscriberResponse = $this->client->patch(
            $subscriberUrl,
            [
                'json' => $data,
                'headers' => ['Authorization' => 'Bearer ' . $this->credentials['accessToken']]
            ]
        )->getBody();

        return json_decode($subscriberResponse, true);
    }

    public function createSubscriber(string $email, string $subsUrl, array $tags = [], array $customFields = []): array
    {
        $body = $this->client->post(
            $subsUrl,
            [
                'json' => [
                    'email' => $email,
                    'custom_fields' => $customFields,
                    'tags' => $tags,
                    'update_existing' => 'true',
                    'last_followup_message_number_sent' => 0
                ],
                'headers' => ['Authorization' => 'Bearer ' . $this->credentials['accessToken']]
            ]
        );

        // get the subscriber entry using the Location header from the post request
        $subscriberUrl = $body->getHeader('Location')[0];
        $subscriberResponse = $this->client->get(
            $subscriberUrl,
            ['headers' => ['Authorization' => 'Bearer ' . $this->credentials['accessToken']]]
        )->getBody();
        return json_decode($subscriberResponse, true);
    }

    public function createCredentials()
    {
        $scopes = array(
            'account.read',
            'list.read',
            'list.write',
            'subscriber.read',
            'subscriber.write',
            'email.read',
            'email.write',
            'subscriber.read-extended'
        );

        // Create a OAuth2 client configured to use OAuth for authentication
        $provider = new GenericProvider(
            [
                'clientId' => getenv('AWEBER_CLIENT_ID'),
                'clientSecret' => getenv('AWEBER_CLIENT_SECRET'),
                'redirectUri' => getenv('AWEBER_REDIRECT_URL'),
                'scopes' => $scopes,
                'scopeSeparator' => ' ',
                'urlAuthorize' => self::OAUTH_URL . 'authorize',
                'urlAccessToken' => self::OAUTH_URL . 'token',
                'urlResourceOwnerDetails' => self::BASE_URL . 'accounts'
            ]
        );

        $authorizationUrl = $provider->getAuthorizationUrl();

        echo "Go to this url: " . $authorizationUrl . "\n";
        echo "Log in and paste the returned URL here: ";
        $authorizationResponse = rtrim(fgets(STDIN), PHP_EOL);
        $parsedUrl = parse_url($authorizationResponse, PHP_URL_QUERY);
        parse_str($parsedUrl, $parsedArray);

        try {
            $token = $provider->getAccessToken(
                'authorization_code',
                [
                    'code' => $parsedArray['code']
                ]
            );
            $this->credentials['accessToken'] = $token->getToken();
            $this->credentials['refreshToken'] = $token->getRefreshToken();

            return $this->saveAweberSettings();
        } catch (IdentityProviderException $e) {
            var_dump($e->getMessage());
            return false;
        }
    }

    public function saveAweberSettings()
    {
        $settings = Settings::where('key', 'aweber')->first();
        if (!$settings) {
            $settings = new Settings();
        }
        $settings->key = 'aweber';
        $settings->value = json_encode($this->credentials);

        return $settings->save();
    }

    public function refreshCredentials()
    {
        $client = new Client();
        $response = $client->post(
            self::TOKEN_URL,
            [
                'auth' => [
                    getenv('AWEBER_CLIENT_ID'),
                    getenv('AWEBER_CLIENT_SECRET')
                ],
                'json' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->credentials['refreshToken']
                ]
            ]
        );
        $body = $response->getBody();
        $newCreds = json_decode($body, true);
        $this->credentials['accessToken'] = $newCreds['access_token'];
        $this->credentials['refreshToken'] = $newCreds['refresh_token'];

        return $this->saveAweberSettings();
    }
}
