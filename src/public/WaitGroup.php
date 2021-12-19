<?php

use Swoole\Coroutine\WaitGroup;

Co\run(function() {
    $wg = new WaitGroup();

    $results = [];
    go(function () use ($wg, &$results) {
        $wg->add();
        co::sleep(5);
        $results[] = 'a';
        $wg->done();
    });

    go(function () use ($wg, &$results) {
        $wg->add();
        co::sleep(10);
        $results[] = 'b';
        $wg->done();
    });

    $wg->wait();
    var_dump($results);
});