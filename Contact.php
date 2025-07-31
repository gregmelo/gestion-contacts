<?php

class Contact {
    // Propriétés privées avec typage nullable
    private ?int $id = null;              // Identifiant unique du contact (peut être null avant insertion en base)
    private ?string $name = null;         // Nom du contact
    private ?string $email = null;        // Adresse email du contact
    private ?string $phone_number = null; // Numéro de téléphone du contact

    // --- Getters : méthodes pour accéder aux propriétés privées ---

    /**
     * Retourne l'identifiant du contact
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * Retourne le nom du contact
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * Retourne l'email du contact
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * Retourne le numéro de téléphone du contact
     * @return string|null
     */
    public function getPhoneNumber(): ?string {
        return $this->phone_number;
    }

    // --- Setters : méthodes pour modifier les propriétés privées ---

    /**
     * Définit l'identifiant du contact
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * Définit le nom du contact
     * @param string|null $name
     */
    public function setName(?string $name): void {
        $this->name = $name;
    }

    /**
     * Définit l'adresse email du contact
     * @param string|null $email
     */
    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    /**
     * Définit le numéro de téléphone du contact
     * @param string|null $phone_number
     */
    public function setPhoneNumber(?string $phone_number): void {
        $this->phone_number = $phone_number;
    }

    // --- Méthode magique __toString pour afficher facilement le contact ---

    /**
     * Convertit l'objet Contact en chaîne de caractères formatée
     * Utile pour l'affichage direct, par exemple dans un echo
     * @return string
     */
    public function __toString(): string {
        return "$this->id, $this->name, $this->email, $this->phone_number";
    }
}
