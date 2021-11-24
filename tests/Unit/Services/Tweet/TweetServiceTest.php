<?php

namespace Tests\Unit\Services\Tweet;

use App\Services\Tweet\Exceptions\NotFoundException;
use App\Services\Tweet\TweetService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use PHPUnit\Framework\TestCase;

class TweetServiceTest extends TestCase
{
    public function testItCanListMyTweets()
    {
        $service = $this->getTweetService([
            new Response(SymfonyResponse::HTTP_OK, [], json_encode([
                [
                    'tweet_id' => 'twt-101',
                    'tweet' => 'My Tweet One',
                    'posted_at' => '2021-11-24T10:30:00',
                ],
                [
                    'tweet_id' => 'twt-102',
                    'tweet' => 'My Tweet Two',
                    'posted_at' => '2021-11-24T10:35:00',
                ],
            ]))
        ]);

        $data = $service->myTweets(1);

        $this->assertIsArray($data);

        $this->assertEquals([
            [
                'id' => 'twt-101',
                'body' => 'My Tweet One',
                'post_datetime' => '2021-11-24T10:30:00',
            ],
            [
                'id' => 'twt-102',
                'body' => 'My Tweet Two',
                'post_datetime' => '2021-11-24T10:35:00',
            ],
        ], $data);
    }

    public function testItThrowsExceptionWhenUserNotFound()
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('User not found');

        $service = $this->getTweetService([
            new Response(SymfonyResponse::HTTP_NOT_FOUND, [], ''),
        ]);

        $service->myTweets(2);
    }

    private function getTweetService($responses)
    {
        $mock = new MockHandler($responses);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        return new TweetService($client);
    }
}
