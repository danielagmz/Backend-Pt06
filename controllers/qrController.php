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
                    $article = json_decode($cont, true)['article'];

                    if ($article) {
                        // separar el contenido del QR en un array asociativo con las keys title y content y devolver el array asociativo
                        http_response_code(200);
                        $title = $article['title'];
                        $content = $article['content'];
                        $fromQR = true;
                        include_once 'views\principales\insert.php';
                        
                    } else {
                        throw new Exception;
                    }
                } catch (Throwable $e) {
                    http_response_code(400);
                    echo "No se pudo leer el contenido del QR. Asegúrate de que sea válido.";
                }
            } else {
                http_response_code(500);
                echo "Error al subir el archivo. Código de error: " . $uploadedFile['error'];
            }
        } else {
            http_response_code(400);
            echo "Por favor sube una imagen de código QR.";
        }
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
