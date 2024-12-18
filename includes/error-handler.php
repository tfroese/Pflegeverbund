<?php
/**
 * Custom error handler
 */
function handleError($errno, $errstr, $errfile, $errline) {
    // Log error
    error_log("Error [$errno] $errstr in $errfile on line $errline");
    
    // Only handle fatal errors
    if (in_array($errno, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
        // Clean any output that was already sent
        ob_clean();
        
        // Show 500 error page
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        include __DIR__ . '/../500.php';
        exit(1);
    }
    
    // Don't execute PHP internal error handler
    return true;
}

// Set custom error handler
set_error_handler('handleError');

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');