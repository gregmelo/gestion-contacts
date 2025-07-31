# Projet Gestion de Contacts en PHP

Ce projet est une application en ligne de commande permettant de gérer une liste de contacts (CRUD : création, lecture, modification, suppression). 

## Fonctionnalités

- Liste des contacts (`list`)
- Détail d’un contact (`detail [id]`)
- Création d’un contact (`create`)
- Modification d’un contact (`modify [id]`)
- Suppression d’un contact (`delete [id]`)
- Affichage de l’aide (`help`)
- Quitter l’application (`exit`)

## Installation

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/gregmelo/gestion-contacts
   cd gestion-contacts
   ```

    Configurer la base de données MySQL et renseigner le fichier .env à la racine :
    ```bash
    DB_HOST="votre hote"
    DB_NAME="le nom de votre table"
    DB_USER="votre identifiant de connexion à la BDD"    
    DB_PASS="votre MDP de connexion à la BDD"
    ```
Lancer le script en ligne de commande :
    ```bash
    php main.php
    ```
Usage

Entrez les commandes dans le terminal, par exemple :

    list — affiche tous les contacts

    detail 3 — affiche le contact avec l’ID 3

    create — crée un nouveau contact (le programme vous demandera les informations)

    modify 2 — modifie le contact avec l’ID 2

    delete 4 — supprime le contact avec l’ID 4

    help — affiche l’aide

    exit — quitte le programme

Structure du projet

    main.php : point d'entrée principal, gestion des commandes utilisateur

    DBConnect.php : connexion à la base de données

    Contact.php : définition de la classe Contact

    ContactManager.php : gestion des opérations en base (CRUD)

    Command.php : logique des commandes en ligne de commande

Prérequis

    PHP >= 7.4 avec PDO MySQL activé

    Serveur MySQL avec base de données configurée

Auteur

Véricel Grégory — [gregoryvericel6@gmail.com]

N’hésite pas à contribuer ou à poser des questions !
