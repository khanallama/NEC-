<?php

/**
 * Logs a message to a file.
 *
 * @param string $message The message to log.
 * @param string $logDir
 */
function logMessage($message, $logDir = '../logs') {

    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    $logFile = $logDir . '/app_' . date('Y-m-d') . '.log';

    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message" . PHP_EOL;

    file_put_contents($logFile, $logMessage, FILE_APPEND);
}