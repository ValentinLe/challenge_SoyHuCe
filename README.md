# challenge_SoyHuCe

Base de donnée utilisée PostgreSQL, prérequis pour faire fonctionner le 
serveur : 
- creation de la base de données et des tables Utilisateur et Favoris
(le fichier .sql pour les créer est database/createTableFavoris.sql),
L'utilisateur avec login=admin et password=admin est rentré lors de la création.
**ATTENTION :** voir si la base de données utilisée n'est pas PostgreSQL le 
fait d'avoir mis "SERIAL" au lieu de "INT AUTO_INCREMENT" pour l'ID de
l'utilisateur ne pose pas problème. 
- modifier le fichier de configuration php/db/config.php pour la connexion 
à la base de données

