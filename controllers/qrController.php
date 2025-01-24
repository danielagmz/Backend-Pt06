<?php
require_once 'lib/vendor/autoload.php';

use chillerlan\QRCode\{QRCode, QROptions};

class qrController {
    public static function readQr($files)
    {
        if (isset($files['qrImage'])) {
            $uploadedFile = $files['qrImage'];

            // Verifica que no haya errores en la subida
            if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
                $tempPath = $uploadedFile['tmp_name'];

                try {
                    $qrCode = new QRCode();
                    $result = (new QRCode)->readFromFile($tempPath);

                    $content = $result->data;
                    $text = (string)$result;

                    if ($text) {
                        http_response_code(200);
                        echo "El contenido del QR es: <strong>$text</strong>";
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
            'outputType' => QRCode::OUTPUT_IMAGE_PNG
        ]);

        $qrCode = new QRCode($options);
        $pngImage = $qrCode->render($data);

        // Mostrar la imagen en el HTML
        echo '<img src="' . $pngImage . '" alt="QR Code" class="qr__image" />';
    }
}