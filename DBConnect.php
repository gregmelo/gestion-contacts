<?php

// Charge automatiquement toutes les classes définies via Composer (dont Dotenv)
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

class DBConnect {
    // Propriétés privées pour stocker les informations de connexion
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $pdo = null; // L'instance PDO sera stockée ici

    public function __construct() {
        // Initialise Dotenv pour lire le fichier .env à la racine du projet
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load(); // Charge les variables d’environnement dans $_ENV

        // Récupère les informations de connexion à partir des variables d’environnement
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->dbName = $_ENV['DB_NAME'] ?? 'exerciceP5';
        $this->username = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['DB_PASS'] ?? '';
    }

    // Méthode pour obtenir une instance PDO
    public function getPDO() {
        // Vérifie si une connexion existe déjà
        if ($this->pdo === null) {
            try {
                // Construit le Data Source Name (DSN) pour MySQL
                $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=utf8";

                // Crée une nouvelle instance PDO avec les informations récupérées
                $this->pdo = new PDO($dsn, $this->username, $this->password);

                // Configure PDO pour lever une exception en cas d’erreur
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En cas d'erreur de connexion, affiche un message et arrête le script
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }

        // Retourne l'instance PDO (créée ou déjà existante)
        return $this->pdo;
    }
}
