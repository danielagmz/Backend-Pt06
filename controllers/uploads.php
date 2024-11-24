<?php
require_once 'model/update_info.php';
function upload_avatar($avatar)
{
    $id = $_SESSION['id'];
    $fileTmpPath = $avatar['tmp_name'];
    $fileName = $avatar['name'];
    $fileSize = $avatar['size'];
    $fileType = $avatar['type'];

    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedFileTypes)) {
        echo '<div class="form-info form-info--error">Els formats acceptats són JPG, PNG i GIF</div>';
        return;
    }

    if ($fileSize > 2 * 1024 * 1024) {
        echo '<div class="form-info form-info--error">La imatge es massa gran. Máxim permitit: 2MB</div>';
        return;
    }

    $uploadFolder = 'uploads/';
    $newFileName = uniqid() . '-' . $fileName;
    $destination = $uploadFolder . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $destination)) {
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
        return;
    }

    if (getOldImagespath($id) != '') {
                $oldavatar = getOldImagespath($id)['avatar'];
                //eliminar la imagen de la carpeta uploads
                if (file_exists($oldavatar)) {
                    unlink($oldavatar);
                }
    }
    if (update_avatar($id, $destination)) {
        
        echo '<div class="form-info form-info--success profile-info">L\'imatge s\'ha carregat correctament</div>';
        $_SESSION['avatar'] = $destination;
    } else {
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
    }
}

function upload_banner($banner)
{   
    if ($banner['size'] == 0) {
        echo '<div class="form-info form-info--error">No s\'ha carregat cap imatge</div>';
        return;
    }
    $id = $_SESSION['id'];
    $fileSize = $banner['size'];
    $fileType = $banner['type'];
    
    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedFileTypes)) {
        echo '<div class="form-info form-info--error">Els formats acceptats són JPG, PNG i GIF</div>';
        return;
    }
    
    if ($fileSize > 2 * 1024 * 1024) {
        echo '<div class="form-info form-info--error">La imatge es massa gran. Máxim permitit: 2MB</div>';
        return;
    }

    $fileTmpPath = $banner['tmp_name'];
    $fileName = $banner['name'];

    $uploadFolder = 'uploads/';
    $newFileName = uniqid() . '-' . $fileName;
    $destination = $uploadFolder . $newFileName;

    if (!move_uploaded_file($fileTmpPath, $destination)) {
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
        return;
    }

    if (getOldImagespath($id) != '') {
        $oldBanner = getOldImagespath($id)['banner'];
        //eliminar la imagen de la carpeta uploads
        unlink($oldBanner);
    }
    if (update_banner($id, $destination)) {
        echo '<div class="form-info form-info--success profile-info">L\'imatge s\'ha carregat correctament</div>';
        $_SESSION['banner'] = $destination;
    } else {
        echo '<div class="form-info form-info--error">Error al carregar l\'imatge</div>';
    }
}
