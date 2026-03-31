<?php

/**
 * Bloqueio automático integrado com WPS Limit Login
 * - Lê os IPs bloqueados diretamente do WPS Limit Login
 * - Bloqueia IPs manuais adicionais
 * - Loga tentativas suspeitas
 */

// IPs bloqueados manualmente
$manual_blocked_ips = [
    '23.26.94.96', // Tentativa em 31/03/2026
];

// Bloqueia IPs — manual + WPS Limit Login
add_action('init', function() use ($manual_blocked_ips) {
    $visitor_ip = $_SERVER['REMOTE_ADDR'];

    // 1. Verifica lista manual
    if (in_array($visitor_ip, $manual_blocked_ips)) {
        error_log("[SECURITY] IP manual bloqueado: {$visitor_ip}");
        wp_die('Acesso bloqueado por segurança.', 'Acesso Negado', ['response' => 403]);
    }

    // 2. Lê os IPs bloqueados diretamente do WPS Limit Login
    $wps_lockouts = get_option('wps_limit_login_lockouts', []);
    $wps_blocklist = get_option('wps_limit_login_lockouts_total', []);

    // Verifica se o IP está em lockout ativo no WPS
    if (isset($wps_lockouts[$visitor_ip])) {
        $lockout_time = $wps_lockouts[$visitor_ip];

        // Se o lockout ainda está ativo
        if (time() < $lockout_time) {
            $remaining = round(($lockout_time - time()) / 60);
            error_log("[SECURITY] IP bloqueado pelo WPS: {$visitor_ip} | Restam: {$remaining} minutos");
            wp_die(
                "Acesso temporariamente bloqueado. Tente novamente em {$remaining} minutos.",
                'Acesso Negado',
                ['response' => 403]
            );
        }
    }

    // 3. Verifica se o IP tem muitos lockouts acumulados no WPS
    if (isset($wps_blocklist[$visitor_ip])) {
        $total_lockouts = $wps_blocklist[$visitor_ip];

        // Bloqueia permanentemente após 2 lockouts
        if ($total_lockouts >= 2) {
            error_log("[SECURITY] IP bloqueado permanentemente por acúmulo: {$visitor_ip} | Total lockouts: {$total_lockouts}");
            wp_die(
                'Seu acesso foi bloqueado permanentemente por atividade suspeita.',
                'Acesso Negado',
                ['response' => 403]
            );
        }
    }
});

// Bloqueia usernames suspeitos antes de verificar a senha
add_action('authenticate', function($user, $username, $password) {
    $suspicious_users = [
        'admin', 'administrator', 'adminbackup',
        'root', 'test', 'backup', 'wp-admin',
        'demo', 'user', 'guest', 'zpadmin',
        
    ];

    foreach ($suspicious_users as $sus) {
        if (strpos(strtolower($username), $sus) !== false) {
            $visitor_ip = $_SERVER['REMOTE_ADDR'];
            error_log("[SECURITY] Username suspeito bloqueado - IP: {$visitor_ip} | Usuário: {$username}");

            return new WP_Error(
                'suspicious_username',
                'Usuário ou senha incorretos.'
            );
        }
    }
    return $user;
}, 10, 3);

// Loga todas as tentativas de login falhadas com detalhes do WPS
add_action('wp_login_failed', function($username) {
    $visitor_ip    = $_SERVER['REMOTE_ADDR'];
    $wps_retries   = get_option('wps_limit_login_retries', []);
    $attempts      = isset($wps_retries[$visitor_ip]) ? $wps_retries[$visitor_ip] : 1;

    error_log("[SECURITY] Login falhou - IP: {$visitor_ip} | Usuário: {$username} | Tentativas WPS: {$attempts}");
});