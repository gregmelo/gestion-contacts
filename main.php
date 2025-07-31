<?php

// Inclusion des classes nécessaires
require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';
require_once 'Command.php';

// Création d'une instance de la classe Command, qui gère les commandes utilisateur
$command = new Command();

// Boucle infinie pour lire les commandes utilisateur jusqu'à ce qu'on quitte
while (true) {
    // Affichage d'une invite de commande personnalisée
    $line = readline("Entrez votre commande (help, lister, détailler, créer, supprimer, modifier, quitter): ");
    echo "Vous avez saisi : $line\n\n";

    // Commande "list" : affiche tous les contacts
    if ($line === "list") {
        $command->list();

    // Commande "detail [id]" : affiche un contact par son ID (ex: detail 2)
    } elseif (preg_match('/^detail\s+(\d+)$/', $line, $matches)){
        $id = (int)$matches[1]; // Récupère l'ID saisi
        $command->detail($id);

    // Commande "create" : demande à l'utilisateur les infos d'un nouveau contact et l'ajoute
    } elseif ($line === "create"){
        $name = readline("Entrez le nom du contact: ");
        $email = readline("Entrez l'email du contact: ");
        $phoneNumber = readline("Entrez le numéro de téléphone du contact: ");
        $command->create($name, $email, $phoneNumber);

    // Commande "delete [id]" : supprime un contact par son ID
    } elseif (preg_match('/^delete\s+(\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $command->delete($id);

    // Commande "modify [id]" : modifie un contact existant
    } elseif (preg_match('/^modify\s+(\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $name = readline("Entrez le nouveau nom du contact: ");
        $email = readline("Entrez le nouvel email du contact: ");
        $phoneNumber = readline("Entrez le nouveau numéro de téléphone du contact: ");
        $command->modify($id, $name, $email, $phoneNumber);

    // Commande "help" : affiche une aide (liste des commandes disponibles)
    } elseif ($line === "help") {
        $command->help();

    // Commande "exit" : quitte le programme
    } elseif ($line === "exit") {
        break;

    // Commande inconnue : message d'erreur
    } else { 
        echo "Commande inconnue: $line\n";
    }
}
