<?php

// we are going to write 'random' chunks of data to the client, based off a seed passed through the url

const BYTES_IN_MB = 1048576;

$seed = (int)($_GET['seed'] ?? 5400);

if ($_GET['size'] === 'empty.json') {
    mt_srand($seed);
    echo "{";
    flush();
    usleep(mt_rand(0, 100000));
    echo "}";
    die();
}

$size = (int)($_GET['size'] ?? 200);
if ($size < 1) {
    $size = 1;
}
if ($size > BYTES_IN_MB) {
    $size = BYTES_IN_MB;
}
$random_data = random_bytes($size);

error_log('creating random data of size ' . $size . ' with seed ' . $seed);

// tell nginx not to buffer the output
header('X-Accel-Buffering: no');

mt_srand($seed);

$sent_bytes = 0;
while ($sent_bytes < $size) {
    $bytes_to_send = mt_rand(1, $size - $sent_bytes);
    echo substr($random_data, $sent_bytes, $bytes_to_send);
    $sent_bytes += $bytes_to_send;
    flush();
    usleep(mt_rand(50000, 100000));
}

// the end
