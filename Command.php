<?php

// Inclusion de la classe ContactManager pour gérer les interactions avec la base de données
require_once 'ContactManager.php';

// Classe Command : centralise toute la logique liée aux commandes utilisateur
class Command {
    // Propriété privée contenant une instance de ContactManager
    private ContactManager $manager;

    // Constructeur : initialise le ContactManager
    public function __construct() {
        $this->manager = new ContactManager();
    }

    // Commande "list" : affiche la liste complète des contacts
    public function list(): void {
        echo "affichage de la liste des contacts :\n\n";
        echo "id, name, email, phone number\n\n";

        // Récupère tous les contacts depuis la base de données
        $contacts = $this->manager->findAll();

        // Affiche chaque contact (utilise __toString() de la classe Contact)
        foreach ($contacts as $contact) {
            echo $contact . "\n\n";
        }
    }

    // Commande "detail" : affiche les détails d’un contact à partir de son ID
    public function detail(int $id): void {
        // Recherche le contact dans la base
        $contact = $this->manager->findById($id);

        if ($contact) {
            echo "affichage des détails du contact :\n\n";
            echo "id, name, email, phone number\n\n";
            echo $contact . "\n\n";
        } else {
            // Si aucun contact n’est trouvé
            echo "Aucun contact trouvé avec l'ID $id.\n\n";
        }
    }

    // Commande "create" : crée un nouveau contact avec les informations saisies
    public function create(string $name, string $email, string $phoneNumber): void {
        // Tente de créer le contact
        $contact = $this->manager->create($name, $email, $phoneNumber);

        if ($contact) {
            echo "Contact créé : $contact\n\n";
        } else {
            echo "Erreur lors de la création du contact.\n\n";
        }
    }

    // Commande "delete" : supprime un contact selon son ID
    public function delete(int $id): void {
        if ($this->manager->delete($id)) {
            echo "Contact avec l'ID $id supprimé.\n\n";
        } else {
            echo "Erreur lors de la suppression du contact avec l'ID $id.\n\n";
        }
    }

    // Commande "modify" : modifie les informations d’un contact existant
    public function modify(int $id, string $name, string $email, string $phoneNumber): void {
        if ($this->manager->modify($id, $name, $email, $phoneNumber)) {
            echo "Contact avec l'ID $id modifié.\n\n";
        } else {
            echo "Erreur lors de la modification du contact avec l'ID $id.\n\n";
        }
    }

    // Commande "help" : affiche la liste des commandes disponibles
    public function help(): void {
        echo "Commandes disponibles :\n\n";
        echo "  - help : Afficher cette aide\n";
        echo "  - list : Afficher la liste des contacts\n";
        echo "  - detail [id] : Afficher les détails d'un contact\n";
        echo "  - create [name], [email], [phone number] : Créer un nouveau contact\n";
        echo "  - delete [id] : Supprimer un contact\n";
        echo "  - modify [id] : Modifier un contact\n";
        echo "  - exit : Quitter le programme\n\n";
    }
}
