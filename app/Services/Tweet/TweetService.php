<?php

namespace App\Services\Tweet;

use App\Services\Tweet\Exceptions\NotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TweetService implements TweetServiceInterface
{
    /** @var Client */
    protected $httpClient;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    public function myTweets(int $tweetId)
    {
        try {
            $response = $this->httpClient->request(
                'GET',
                '/tweets/' . $tweetId,
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ],
            );
            $responseStr = trim((string) $response->getBody());
            $data = json_decode($responseStr, true);

            // Transformer
            return array_map(function ($tweet) {
                return [
                    'id' => $tweet['tweet_id'],
                    'body' => $tweet['tweet'],
                    'post_datetime' => $tweet['posted_at'],
                ];
            }, $data);
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                throw new NotFoundException("User not found", 404);
            }

            throw $e;
        }
    }
}
