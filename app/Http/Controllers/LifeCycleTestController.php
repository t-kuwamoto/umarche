<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    //
    public function showServiceContainerTest()
    {
        app()->bind('lifeCycleTest', function(){
            return 'ライフサイクルテスト';
        });

        $test = app()->make('lifeCycleTest');

        // dd($test);

        //サービスコンテナなしのパターン
        // $message = new Message();
        // $sample = new Sample($message);
        // $sample->run();

        //サービスコンテナapp()ありのパターン
        app()->bind('sample', Sample::class);//sampleクラスをサービスコンテナで使えるようにする
        $sample = app('sample');
        $sample->run();

    }
}

class Sample
{
    public $message;
    public function __construct(Message $message){
        $this->message = $message;
    }

    public function run(){
        $this->message->send();
    }
}


class Message
{
    public function send(){
        echo('メッセージ表示');
    }
}
