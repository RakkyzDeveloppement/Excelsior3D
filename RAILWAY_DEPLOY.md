# Deploiement Railway (PHP + MySQL)

## 1) Push GitHub
- Push ce repo sur GitHub.

## 2) Creer le projet Railway
- Railway -> New Project -> Deploy from GitHub Repo.
- Railway detectera `Dockerfile` et build automatiquement.

## 3) Ajouter la base MySQL Railway
- New -> Database -> MySQL.
- Copier les variables MySQL du plugin.

## 4) Variables d'environnement (service web)
Configurer dans Railway Variables:
- DB_HOST
- DB_PORT
- DB_NAME
- DB_USER
- DB_PASS
- APP_FORCE_HTTPS=1
- APP_SHOW_RESET_TOKEN=0
- MAILJET_API_KEY
- MAILJET_API_SECRET
- MAIL_FROM_EMAIL
- MAIL_FROM_NAME

## 5) Import schema
Importer `schema.sql` dans la base Railway:
- Depuis un client MySQL local (DBeaver/TablePlus/MySQL CLI)
- ou via Railway shell si disponible.

Commande locale (adapter host/port/user/db):
`mysql -h <host> -P <port> -u <user> -p <db_name> < schema.sql`

## 6) Verifier en ligne
- Ouvrir l'URL Railway.
- Tester: inscription, connexion, reset password, sauvegarde calcul, historique.

## Notes
- Le serveur est Apache avec document root `public/` (configure dans Dockerfile).
- `storage/` est prepare en ecriture pour les logs mail.
- Ne jamais committer `.env` production.
