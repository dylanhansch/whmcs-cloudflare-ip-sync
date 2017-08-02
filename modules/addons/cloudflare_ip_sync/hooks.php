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

use WHMCS\Database\Capsule;

add_hook('PreAutomationTask', 1, function($vars) {
    /*
     * Sync IPs
     */
    $ipv4 = file_get_contents('https://www.cloudflare.com/ips-v4');
    $ipv6 = file_get_contents('https://www.cloudflare.com/ips-v6');

    $ipv4 = explode("\n", trim($ipv4, "\n"));
    $ipv6 = explode("\n", trim($ipv6, "\n"));

    $ips = array();

    foreach ($ipv4 as $ip) {
        $ips[] = array('ip' => $ip, 'note' => 'Cloudflare');
    }

    foreach ($ipv6 as $ip) {
        $ips[] = array('ip' => $ip, 'note' => 'Cloudflare');
    }
    
    $ips = json_encode($ips);
    
    try {
        $query = Capsule::table('tblconfiguration')->where('setting', 'trustedProxyIps')->update(['value' => $ips]);
    } catch (\Exception $e) {
        logActivity($e);
    }
});
