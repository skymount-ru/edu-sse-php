<?php

date_default_timezone_set('Europe/Moscow');
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");
/**
 * Set maximum time limit.
 * After 50 seconds the script will be killed.
 */
set_time_limit(50);
/**
 * Pre-start. Flush buffer and start again.
 */
@ob_flush();@flush();
/**
 * Set retry to 10 seconds.
 * If the client lost the connection, it will retry the connection after 10 seconds.
 */
echo "retry: 10000\n";
/**
 * Main loop.
 */
do {
    /**
     * Working...
     */
    if (rand(0, 5) > 2) {
        echo "event: ping\n";
    } else {
        echo "event: message\n";
    }

    $curDate = date(DATE_ISO8601);
    echo 'data: ' . json_encode(['time' => $curDate]) . "\n\n";
    /**
     * Collect data and send.
     */
    @ob_end_flush();
    /**
     * Sleep!
     */
    sleep(3);
    /**
     * Exit if the connection is broken.
     */
} while (!connection_aborted());

echo "Stopped\n";
