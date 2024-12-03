<?php 
require_once 'controllers/env.php';
return [
    'callback' => BASE_URL . 'index.php?action=GitHubAuth', // URL de callback
    'providers' => [
        'GitHub' => [
            'enabled' => true,
            'keys' => [
                'id' => GITHUB_CLIENT_ID,
                'secret' => GITHUB_CLIENT_SECRET,
            ],
            'scope' => 'user:email',
        ],
    ],
];
?>
