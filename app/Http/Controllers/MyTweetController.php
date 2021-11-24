<?php

namespace App\Http\Controllers;

use App\Services\Tweet\TweetServiceInterface;
use Illuminate\Http\Request;

class MyTweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TweetServiceInterface $service)
    {
        $data = $service->myTweets(5);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
