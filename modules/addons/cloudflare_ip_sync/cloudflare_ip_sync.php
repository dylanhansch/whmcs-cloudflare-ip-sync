<?php
/**
 * Cloudflare IP Sync
 *
 * This addon syncs the Cloudflare IPs with WHMCS's trusted
 * proxy list.
 *
 * https://www.cloudflare.com/ips/
 *
 * @version 1.0
 * @author Dylan Hansch <dylan@dylanhansch.net>
 */
 
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly.");
}

function cloudflare_ip_sync_config() {
    return array(
        'name' => 'Cloudflare IP Sync',
        'description' => 'Keep WHMCS trusted proxy IPs in sync with Cloudflare IPs',
        'author' => 'Dylan Hansch',
        'language' => 'english',
        'version' => '1.0',
    );
}
