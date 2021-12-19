<?php

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Coroutine\System;

Swoole\Runtime::enableCoroutine(true, SWOOLE_HOOK_ALL);
Co::set(['hook_flags'=> SWOOLE_HOOK_ALL]);

$http = new Server('0.0.0.0', 9501);
$http->set([
    'worker_num' => 4,
    'task_worker_num' => 4,
    'document_root' => '/app/src/public/web/',
    'enable_static_handler' => true,
//    'static_handler_locations' => ['/static', '/app/images'],
]);

$http->on('start', function (Server $server) {
    echo "Swoole http server is started at http://0.0.0.0:9501\n";
});

$http->on('request', function (Request $request, Response $response) use ($http) {
    $response->header('Content-Type', 'text/html; charset=utf-8');
    $http->task('Hello World', 0);
//    $response->sendfile('/app/src/public/web/index.html');

////    Co\run(function()
////    {
//        go(function()
//        {
//            sleep(5);
////            Co::sleep(5);
//            echo "Done 1\n";
//        });
//
//        go(function()
//        {
//            sleep(10);
////            Co::sleep(10);
//            echo "Done 2\n";
//        });
////    });

    $response->end('<h1>Hello World!</h1>');
});

$http->on('task', function (Swoole\Server $server, $task_id, $reactorId, $data) {
    var_dump($data);
});

$process = new Swoole\Process(function () {
    while (true) {
        sleep(1);
        var_dump('Background Task 1');
    }
});

$process2 = new Swoole\Process(function () {
    while (true) {
        sleep(2);
        var_dump('Background Task 2');
    }
});

$http->addProcess($process);
$http->addProcess($process2);

$http->start();