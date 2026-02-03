<?php
// Central security headers include - safe defaults, adjust to your deployment
if (!headers_sent()) {
    // Content Security Policy (relaxed to avoid breaking inline scripts/styles used in this app)
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https:; style-src 'self' 'unsafe-inline' https:; img-src 'self' data: https:; connect-src 'self' https:; font-src 'self' data:; object-src 'none';");
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: no-referrer-when-downgrade');
    header('X-XSS-Protection: 1; mode=block');
    // HSTS only if served over HTTPS
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? 0) == 443) {
        header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
    }
}

// Helper function to add additional CSP sources in code if necessary
function add_csp_sources(array $sources = []) {
    // no-op: placeholder for runtime policy augmentation
}

?>
