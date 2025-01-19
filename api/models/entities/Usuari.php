<?php 
namespace Models;
use Models\core\Database;
class Usuari {
    private static $conn = null;
    private $id;
    private $username;
    private $email;
    private $password;
    private $bio;
    private $avatar;
    private $banner;
    private $admin;
    private $socialProv;
    private $created_at;
    private $updated_at;

    public function __construct($id, $username, $email, $password, $bio=null, $avatar=null, $banner=null, $admin=false, $socialProv=null, $created_at, $updated_at) {
        self::$conn = Database::getConnection();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->bio = $bio;
        $this->avatar = $avatar;
        $this->banner = $banner;
        $this->admin = $admin;
        $this->socialProv = $socialProv;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getBanner() {
        return $this->banner;
    }

    public function getRol() {
        return $this->admin;
    }

    public function getSocialProv() {
        return $this->socialProv;
    }

    public function getCreationDate() {
        return $this->created_at;
    }

    public function getUpdateDate() {
        return $this->updated_at;
    }
}