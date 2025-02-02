<?php 
namespace api\Models\entities;
require_once 'api/models/Usuaris.php';

use Models\Usuari;
use Models\Usuaris;

class Article {
    private $id;
    private $titol;
    private $cos;
    private $data_creacio;
    private $data_modificacio;
    private $autor;

    public function __construct($id, $titol, $cos, $data_creacio, $data_modificacio, $autor=null) {
        $this->id = $id;
        $this->titol = $titol;
        $this->cos = $cos;
        $this->data_creacio = $data_creacio;
        $this->data_modificacio = $data_modificacio;
        $this->autor = $autor;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitol() {
        return $this->titol;
    }

    public function getCos() {
        return $this->cos;
    }

    public function getDataCreacio() {
        return $this->data_creacio;
    }

    public function getDataModificacio() {
        return $this->data_modificacio;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function __toString()
    {
        return sprintf(
            '<article class="article" data-id="%d"> 
                <div class="article__header">
                    <div class="article__icon"></div>
                    <div class="article__title">%s</div>
                </div>
                <p class="article__body">%s...</p>
                <div class="article__footer">
                    <span class="article__created"><i class="fi fi-rr-add-document icon"></i>%s</span>
                    <span class="article__updated"><i class="fi fi-rr-edit icon"></i>%s</span>
                </div>  
            </article>',
            $this->id,
            $this->titol,
            substr($this->cos, 0, 200),
            $this->data_creacio,
            $this->data_modificacio

        );
    }

    public function toGuestString() {
        return sprintf(
            '<article class="article" data-id="%d"> 
                <div class="article__header">
                    <div class="article__icon"></div>
                    <div class="article__title">%s</div>
                </div>
                <p class="article__body">%s...</p>
                <div class="article__footer">
                    <span class="article__created"><i class="fi fi-rr-add-document icon"></i>%s</span>
                    <span class="article__author"><i class="fi fi-rr-user icon"></i>%s</span>
                </div>
            </article>',
            $this->id,
            $this->titol,
            substr($this->cos, 0, 200),
            $this->data_creacio,
            Usuaris::getUser($this->autor)->getUsername()
        );
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'titol' => $this->titol,
            'cos' => $this->cos,
            'data_creacio' => $this->data_creacio,
            'data_modificacio' => $this->data_modificacio,
            'autor' => $this->autor,
            'autor_username' => Usuaris::getUser($this->autor) ? Usuaris::getUser($this->autor)->getUsername() : null,
        ];
    }
}