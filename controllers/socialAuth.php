<?php
require_once 'lib/vendor/autoload.php';
require_once 'model/register.php';

//⭐  GOOGLE

/**
 * Inicializa el cliente de Google para el inicio de sesion
 *
 * @return Google_Client
 */
function initialize_google_client()
{
    $client = new Google\Client;
    $client->setClientId(GOOGLE_CLIENT_ID);
    $client->setClientSecret(GOOGLE_CLIENT_SECRET);
    return $client;
}

/**
 * Genera la url para el inicio de sesion de Google
 *
 * @return string
 */
function google_social_login_url()
{
    $client = initialize_google_client();
    $client->setRedirectUri(BASE_URL . 'index.php?action=GoogleAuth');
    $client->addScope("email");
    $client->addScope("profile");

    return $client->createAuthUrl();
}

/**
 * Realiza el redireccionamiento despues de la autenticacion con Google
 *
 * @param string $token El token de autenticacion
 */
function google_redirect($token)
{
    if ($token) {
        $client = initialize_google_client();
        $client->setRedirectUri(BASE_URL . 'index.php?action=GoogleAuth');
        $tokenData = $client->fetchAccessTokenWithAuthCode($token);
        if (!empty($tokenData["access_token"])) {
            $client->setAccessToken($tokenData["access_token"]);

            $oauth = new Google\Service\Oauth2($client);
            $userinfo = $oauth->userinfo->get();
            if (!empty($userinfo->email) && !email_exists($userinfo->email)) {

                $username = generate_unique_username();
                $email = $userinfo->email;
                $hashed_pass = '';
                $id = register_social_user($username, $email, $hashed_pass, 'google');
                if ($id) {
                    $usuari = login_from_id($id);
                    set_user_session($usuari);
                    header('Location: index.php?action=read');
                    exit();
                }
            } else if (email_exists($userinfo->email)) {
                $usuari = username_from_email($userinfo->email);
                $usuari = login_from_username($usuari);
                // Si el usuario no ha iniciado sesion con Google
                if ($usuari['socialProv'] != 'google' && $usuari['socialProv'] != null) {
                    $provider = $usuari['socialProv'];
                    http_response_code(400);
                    $response= sprintf('<div class="form-info form-info--error">No has iniciat sessio amb Google prova amb %s</div>', ucfirst($provider));
                    include_once 'views/principales/login.php';
                    echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
                    exit();
                }else if ($usuari['socialProv'] == null) {
                    // Si el usuario ha iniciado con contraseña
                    http_response_code(400);
                    $response= '<div class="form-info form-info--error">Has iniciat sessio amb usuari i contrasenya</div>';
                    include_once 'views/principales/login.php';
                    echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
                    exit();
                }
                // Si el usuario ha iniciado sesion con Google
                set_user_session($usuari);
                header('Location: index.php?action=read');
                exit();
            }else {
                http_response_code(500);
                $response = '<div class="form-info form-info--error">No hem pogut autenticar-te amb Google</div>';
                include_once 'views/principales/login.php';
                echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
                exit();
            }
        }
    } else {
        http_response_code(500);
        $response = '<div class="form-info form-info--error">No hem pogut autenticar-te amb Google</div>';
        include_once 'views/principales/login.php';
        echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
        exit();
    }
}

//⭐  GITHUB

/**
 * Genera la url para el inicio de sesion de GitHub
 *
 * @return string la url para el inicio de sesion
 */
function github_social_login_url()
{
    return BASE_URL . 'index.php?action=GitHubAuth';
}


/**
 * Funcion para la autenticacion con GitHub
 *
 * Se encarga de autenticar al usuario con GitHub y de
 * crearlo o loguearlo en la aplicacion dependiendo de si
 * ya existe o no.
 *
 */
function github_redirect()
{
    $config = require_once 'lib/hybridauth.php';
    try {
        $hybridauth = new Hybridauth\Hybridauth($config);
        $adapter = $hybridauth->authenticate('GitHub');
        $userProfile = $adapter->getUserProfile();

        if (!empty($userProfile->email) && !email_exists($userProfile->email)) {
            $username = generate_unique_username();
            $email = $userProfile->email;
            $hashed_pass = '';
            $id = register_social_user($username, $email, $hashed_pass, 'github');
            if ($id) {
                $usuari = login_from_id($id);
                set_user_session($usuari);
                header('Location: index.php?action=read');
                exit();
            }
        } else if (email_exists($userProfile->email)) {
            $usuari = username_from_email($userProfile->email);
            $usuari = login_from_username($usuari);
            // si el email existe en la base de datos y no ha iniciado sesion por GitHub 
            if ($usuari['socialProv'] != 'github' && $usuari['socialProv'] != null) {
                $provider = $usuari['socialProv'];
                http_response_code(400);
                $response= sprintf('<div class="form-info form-info--error">No has iniciat sessio amb GitHub prova amb %s</div>', ucfirst($provider));
                include_once 'views/principales/login.php';
                echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
                exit();
            }else if ($usuari['socialProv'] == null) {
                // si el email existe en la base de datos y ha iniciado sesion por contraseña
                http_response_code(400);
                $response= '<div class="form-info form-info--error">Has iniciat sessio amb usuari i contrasenya</div>';
                include_once 'views/principales/login.php';
                echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
                exit();
            }
            // si el email existe en la base de datos y ha iniciado sesion por GitHub
            set_user_session($usuari);
            header('Location: index.php?action=read');
            exit();
        }else {
            http_response_code(500);
            $response = '<div class="form-info form-info--error">No hem pogut autenticar-te amb GitHub</div>';
            include_once 'views/principales/login.php';
            echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
            exit();
        }
    } catch (Exception $e) {
        error_log('Error en GitHub Redirect: ' . $e->getMessage());
        http_response_code(500);
        $response = '<div class="form-info form-info--error">No hem pogut autenticar-te amb GitHub</div>';
        include_once 'views/principales/login.php';
        echo '<script>history.replaceState(null, null, "index.php?action=login");</script>';
        exit();
    }
    
}



