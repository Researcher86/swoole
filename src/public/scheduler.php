<?php

// Multiple Coroutine Context Containers at once

$run = new Swoole\Coroutine\Scheduler;

// Context 1
$run->add(function()
{
    Co::sleep(1);
    echo "Context 1 is done.\n";
});

// Context 2
$run->add(function()
{
    Co::sleep(1);
    echo "Context 2 is done.\n";
});

// Context 3
$run->add(function()
{
    echo "Context 3 is done.\n";
});

// Required or context containers won't run
$run->start();

// Or one context at a time

Co\run(function()
{
    Co::sleep(1);
    echo "Co\\run context is done.\n";
});
