<?php
// Inclusion de la classe Contact (le modèle de données)
require_once 'Contact.php';

class ContactManager {
    private $pdo; // Stocke l'instance PDO pour communiquer avec la base de données

    public function __construct() {
        // Initialise la connexion à la base via DBConnect
        $dbConnect = new DBConnect();
        $this->pdo = $dbConnect->getPDO();
    }

    /**
     * Récupère tous les contacts depuis la base de données
     * @return array Liste d'objets Contact
     */
    public function findAll(): array {
        $sql = "SELECT * FROM contact";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contacts = [];
        // Transformation de chaque ligne SQL en objet Contact
        foreach ($rows as $contactData) {
            $contact = new Contact();
            $contact->setId((int)$contactData['id']);
            $contact->setName($contactData['name']);
            $contact->setEmail($contactData['email']);
            $contact->setPhoneNumber($contactData['phone_number']);
            $contacts[] = $contact;
        }

        return $contacts;
    }

    /**
     * Recherche un contact par son identifiant
     * @param int $id L'identifiant du contact
     * @return Contact|null Le contact trouvé ou null si inexistant
     */
    public function findById(int $id): ?Contact {
        $sql = "SELECT * FROM contact WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $contactData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($contactData) {
            $contact = new Contact();
            $contact->setId((int)$contactData['id']);
            $contact->setName($contactData['name']);
            $contact->setEmail($contactData['email']);
            $contact->setPhoneNumber($contactData['phone_number']);
            return $contact;
        }

        return null;
    }

    /**
     * Crée un nouveau contact en base
     * @param string $name Le nom
     * @param string $email L'adresse email
     * @param string $phoneNumber Le numéro de téléphone
     * @return Contact|null Le contact créé ou null si erreur
     */
    public function create(string $name, string $email, string $phoneNumber): ?Contact {
        $sql = "INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phoneNumber);
        $stmt->execute();

        // Récupère l'ID auto-incrémenté pour charger le nouveau contact
        $id = $this->pdo->lastInsertId();
        return $this->findById($id);
    }

    /**
     * Supprime un contact par son ID
     * @param int $id
     * @return bool true si la suppression a réussi
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM contact WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute(); // true si suppression effectuée
    }

    /**
     * Met à jour un contact existant
     * @param int $id Identifiant du contact
     * @param string $name Nouveau nom
     * @param string $email Nouvel email
     * @param string $phoneNumber Nouveau numéro de téléphone
     * @return Contact|null Le contact modifié, ou null si non trouvé
     */
    public function modify(int $id, string $name, string $email, string $phoneNumber): ?Contact {
        $sql = "UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phoneNumber);
        $stmt->execute();

        // Retourne le contact mis à jour
        return $this->findById($id);
    }
}
