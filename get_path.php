<?php
echo "<h2>Server Information for .htaccess Configuration</h2>";
echo "<p>Full path to this directory: " . dirname(__FILE__) . "</p>";
echo "<p>Suggested .htpasswd location (one level above document root): " . dirname($_SERVER['DOCUMENT_ROOT']) . "/.htpasswd</p>";
echo "<p>Your .htaccess should contain:</p>";
echo "<pre>";
echo "AuthType Basic\n";
echo "AuthName \"Admin Area\"\n";
echo "AuthUserFile " . dirname($_SERVER['DOCUMENT_ROOT']) . "/.htpasswd\n";
echo "Require valid-user";
echo "</pre>";
?> 