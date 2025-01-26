<?php
require_once 'lib/vendor/autoload.php';

use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Data\QRMatrix;

class qrController
{
    public static function readQr($files)
    {
        if (isset($files['qrImage'])) {
            $uploadedFile = $files['qrImage'];

            // Verifica que no haya errores en la subida
            if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
                $tempPath = $uploadedFile['tmp_name'];

                try {
                    $result = (new QRCode)->readFromFile($tempPath);

                    $cont = $result->data;
                    if (!json_decode($cont, true)) {
                        throw new Exception('No hem pogut llegir aquest QR. Asegurat que sigui valid.');
                    }

                    $article = json_decode($cont, true)['article'];

                    if ($article) {
                        http_response_code(200);
                        $title = $article['title'];
                        $content = $article['content'];

                        if (is_empty($title) && is_empty($content)) {
                            throw new Exception('Aquest QR no te contingut');
                        }
                        $fromQR = true;
                        include_once 'views\principales\insert.php';
                        
                    } else {
                        throw new Exception('No hem pogut llegir aquest QR. Asegurat que sigui valid.');
                    }
                } catch (Throwable $e) {
                    http_response_code(400);
                    $QRresponse = "<p>{$e->getMessage()}</p>";
                }
            } else {
                http_response_code(500);
                $QRresponse .= "<p>No hem pogut pujar el QR </p>";
            }
        } else {
            http_response_code(400);
            $QRresponse .= "Por favor sube una imagen de código QR.";
        }
        if (!is_empty($QRresponse)) {
            $QRresponse = '<div class="form-info form-info--error qr__errors">' . $QRresponse . '</div>';
        }
        include_once 'views/principales/insert.php';
    }

    public static function createQr($data)
    {
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        ]);
        $options->drawCircularModules = false;
        $options->moduleValues        = [
            QRMatrix::M_FINDER_DARK    => [81, 69, 158],
            QRMatrix::M_FINDER_DOT     => [81, 69, 158],
            QRMatrix::M_FINDER         => [197, 211, 249], 
            QRMatrix::M_ALIGNMENT_DARK => [81, 69, 158],
            QRMatrix::M_LOGO           => [81, 69, 158],
        ];
    
        

        $qrCode = new QRCode($options);
        $pngImage = $qrCode->render($data);

        // Mostrar la imagen en el HTML
        echo '<img src="' . $pngImage . '" alt="QR Code" class="qr__image" />';
    }
}
