<?php

/**
 * Generate a UUID (version 4).
 *
 * @return string A randomly generated UUID.
 */
function genUuid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),
        // 16 bits for "time_hi_and_version",
        // four most significant bits hold version number 4
        mt_rand(0, 0x0fff) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits hold zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,
        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

/**
 * Get date only from a timestamp.
 *
 * @param string $timestamp A timestamp string.
 * @return string The date in 'Y-m-d' format.
 * @throws Exception If the provided timestamp is not valid.
 */
function get_date_only($timestamp)
{
    // Create a DateTime object from the timestamp
    $dateTime = new DateTime($timestamp);

    // Format the date as YYYY-MM-DD
    $dateOnly = $dateTime->format('Y-m-d');

    return $dateOnly;
}
