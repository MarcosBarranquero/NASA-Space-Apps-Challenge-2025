<?php
function db(): PDO {
    // DB Connection disabled for demo mode
    throw new Exception("Database connection is disabled in demo mode.");
}

