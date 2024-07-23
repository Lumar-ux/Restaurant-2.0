# Restaurant 2.0 : Amélioration d'un site web existant

J'ai repris mon projet de site web de restaurant et l'ai amélioré en ajoutant de nouvelles fonctionnalités et en peaufinant le design.

## Objectifs

- **Implémenter un back-office :** Permettre à l'équipe marketing et communication de gérer les messages de contact de manière centralisée.
- **Créer un livre d'or :** Recueillir les avis des clients via un formulaire connecté à une feuille de calcul Google Sheets (ou à une base de données MySQL en alternative).
- **Dynamiser la galerie d'images :** Permettre l'ajout et la visualisation d'images de manière dynamique, sans modifier le code HTML à chaque fois.
- **Déployer le projet :** Mettre le site en ligne sur un hébergeur gratuit compatible avec PHP.

## Fonctionnalités implémentées

- **Back-office :**
    - Affichage des messages de contact avec possibilité de suppression.
- **Livre d'or :**
    - Formulaire de saisie (nom, restaurant visité, date, commentaire).
    - Affichage des commentaires dans le livre d'or.
    - Utilisation de l'API Google Sheets (ou d'une base de données MySQL) pour stocker les données.
- **Galerie d'images :**
    - Page d'upload d'images.
    - Script PHP pour afficher les images dynamiquement sur le site.

## Technologies utilisées

- **PHP :** Pour la logique métier, l'interaction avec la base de données et l'API Google Sheets.
- **HTML :** Pour la structure du site.
- **CSS :** Pour le style et la mise en page.
- **MySQL (optionnel) :** Pour stocker les données du livre d'or.
- **Google Sheets API (optionnel) :** Pour récupérer les données du livre d'or.

## Installation

1. Clonez le dépôt : `git clone https://github.com/<votre_nom_utilisateur>/restaurant2.0.git`
2. Configurez la connexion à la base de données MySQL (si vous l'utilisez) ou à l'API Google Sheets (si vous l'utilisez).
3. Installez les dépendances avec Composer : `composer install`
4. Lancez le serveur local (par exemple, avec PHP intégré ou XAMPP).

## Améliorations possibles

- **Interface utilisateur :** Améliorer l'ergonomie et l'expérience utilisateur du back-office et de la galerie d'images.
- **Sécurité :** Mettre en place des mesures de sécurité pour protéger les données et prévenir les attaques.
- **Optimisation :** Optimiser le code pour améliorer les performances du site.
- **Fonctionnalités supplémentaires :** Ajouter d'autres fonctionnalités selon les besoins du client (système de réservation, carte interactive, etc.).
