# php-projet-annonces
Projet du module de révision sur PHP

Par Ryane ABBACHE et Ulysse ARNAUD

>
> Le code provient à l'origine du répertoire mexanga/ipssi-projet-docker
>

```bash
php -S localhost:8042 -t .
```

Adresses URL utiles :

- Créer la base de données : `http://localhost:8042/api/create_database`
- Lancer les migrations : `http://localhost:8042/api/run_migrations`;
- Lancer les jeux de données : `http://localhost:8042/api/run_seeders`;
- Supprimer la base de données : `http://localhost:8042/api/drop_database`;

Il manque comme fonctionnalites :
     
- Verification du format du numero de telephone.
- Photo de profil
- Photos de l'annonce
- Relation entre utilisateur et annonce
- Possibilite de modifier le profil depuis la page Mon profil
- Afficher l'adresse mail du createur sur l'annonce
