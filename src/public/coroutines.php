<?php

use Swoole\Coroutine as Co;

Co\run(function()
{
    go(function()
    {
        // Runs immediately
        var_dump(file_get_contents("http://www.swoole.co.uk/"));
    });

    go(function()
    {
        // Waits once second before continuing
        Co::sleep(1);
        var_dump(file_get_contents("http://www.google.com/"));
    });
});

echo "Outside any Coroutine Context.\n";