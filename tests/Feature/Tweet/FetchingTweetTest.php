<?php

namespace Tests\Feature\Tweet;

use App\Services\Tweet\TweetService;
use App\Services\Tweet\TweetServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Tests\TestCase;

class FetchingTweetTest extends TestCase
{
    /** @test */
    public function itCanFetchAllMyTweets()
    {
        $mockResponses = [
            new Response(SymfonyResponse::HTTP_OK, [], json_encode([
                [
                    'tweet_id' => 'twt-1001',
                    'tweet' => 'My first tweet.',
                    'posted_at' => '2021-05-17T15:30:52',
                ],
                [
                    'tweet_id' => 'twt-1002',
                    'tweet' => 'My second tweet.',
                    'posted_at' => '2021-06-02T05:15:00',
                ],
            ])),
        ];

        $this->app->bind(TweetServiceInterface::class, function () use ($mockResponses) {
            $mock = new MockHandler($mockResponses);

            $client = new Client(['handler' => HandlerStack::create($mock)]);

            return new TweetService($client);
        });

        $response = $this->get('/my-tweets');

        $response->assertStatus(SymfonyResponse::HTTP_OK);

        $json = $response->json();
        $this->assertTrue($json['status']);

        $response->assertJson([
            'status' => true,
            'data' => [
                [
                    'id' => 'twt-1001',
                    'body' => 'My first tweet.',
                    'post_datetime' => '2021-05-17T15:30:52',
                ],
                [
                    'id' => 'twt-1002',
                    'body' => 'My second tweet.',
                    'post_datetime' => '2021-06-02T05:15:00',
                ],
            ],
        ]);
    }
}
