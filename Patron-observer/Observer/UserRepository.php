<?php

// Definimos la interfaz del Observador
interface Observer {
    public function update($message);
}

// Clase Sujeto Observado (Newsletter)
class Newsletter {
    private $subscribers = [];

    // Método para agregar un Observador a la lista
    public function addObserver(Observer $observer) {
        $this->subscribers[] = $observer;
    }

    // Método para eliminar un Observador de la lista
    public function removeObserver(Observer $observer) {
        $key = array_search($observer, $this->subscribers);
        if ($key !== false) {
            unset($this->subscribers[$key]);
        }
    }

    // Método para notificar a todos los Observadores sobre un cambio
    public function notifyObservers($message) {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->update($message);
        }
    }
}

// Clase Observador Concreto (Subscriber)
class Subscriber implements Observer {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    // Método de actualización del Observador Concreto
    public function update($message) {
        echo "Hola {$this->name}, se ha publicado una nueva noticia: '{$message}'\n";
    }
}

$newsletter = new Newsletter();

$suscriber1 = new Subscriber('Ana');
$suscriber2 = new Subscriber('Roberto');

$newsletter->addObserver($suscriber1);
$newsletter->addObserver($suscriber2);

$newsletter->notifyObservers('Nueva Noticia');

$newsletter->removeObserver($suscriber2);

$newsletter->notifyObservers('ESTO ES OTRA NOTICIA');
