==================================================================== VERSION 1
------ Tsara ------
- Création des tables ( table.sql - racine - )
-> v1 

 Créer la base SQLite.
 Créer la table des opérateurs.
 Créer la table des clients.
 Créer la table des préfixes.
 Créer la table des types d'opérations (dépôt, retrait, transfert).
 Créer la table des tranches de frais.
 Créer la table des transactions.
 Préparer le fichier base.sql.

------Leila------
# Création des migrations 

php spark make:migration CreatePrefixeTable
php spark make:migration CreateClientTable
php spark make:migration CreateTypeOperationTable
php spark make:migration CreateBaremeFraisTable
php spark make:migration CreateHistoriqueTable
php spark make:migration CreateOperateurTable

# Création des seed 
php spark make:seeder PrefixeSeeder
php spark make:seeder TypeOperationSeeder
php spark make:seeder BaremeFraisSeeder
php spark make:seeder DatabaseSeeder
php spark make:seeder OperateurSeeder

# lancer les migrations rehetra 
php spark migrate

# lancer les seed rehetra 
php spark db:seed DatabaseSeeder

# en cas de problèmes de fafana ny base de manao an'ito 
php spark migrate:refresh
php spark db:seed DatabaseSeeder


-- Tsara -- 
Login côté clients (Routes.php , clients/AuthController/ )
C. Côté client
1. Connexion
 Créer la page de connexion.
 Saisir uniquement le numéro de téléphone.
 Vérifier que le préfixe est valide.
 Créer automatiquement le client s'il n'existe pas.
 Connecter automatiquement le client.
2. Consulter le solde
 Afficher le solde actuel.
3. Dépôt
 Créer le formulaire de dépôt.
 Ajouter automatiquement le montant au solde.
 Enregistrer l'opération dans l'historique.
4. Retrait
 Créer le formulaire de retrait.
 Calculer automatiquement les frais.
 Vérifier que le solde est suffisant.
 Déduire le montant et les frais.
 Enregistrer l'opération.
5. Transfert
 Créer le formulaire de transfert.
 Vérifier que le destinataire existe ou le créer automatiquement.
 Calculer les frais.
 Débiter l'expéditeur.
 Créditer le destinataire.
 Enregistrer la transaction.
6. Historique
 Afficher toutes les opérations du client.
 Afficher le type d'opération.
 Afficher le montant.
 Afficher les frais.
 Afficher la date.


 ------------- Leila -------------

B. Côté opérateur
1. Authentification
 Créer la page de connexion opérateur.
 Vérifier les identifiants.
 Accéder au tableau de bord opérateur.

 connexion : admin,mdp:admin1234


2. Gestion des préfixes
 Ajouter un préfixe.
 Modifier un préfixe.
 Supprimer un préfixe.
 Lister les préfixes.

3. Gestion des types d'opérations
 Ajouter un type d'opération.
 Modifier un type.
 Supprimer un type.
 Lister les opérations.
Transfert
4. Gestion des frais
Pour chaque type d'opération :
 Ajouter une tranche.
 Définir le montant minimum.
 Définir le montant maximum.
 Définir les frais.
 Modifier une tranche.
 Supprimer une tranche.
 Afficher toutes les tranches.
5. Situation des gains
 Calculer les frais gagnés sur les retraits.
 Calculer les frais gagnés sur les transferts.
 Afficher le total des gains.
6. Situation des comptes clients
 Afficher tous les clients.
 Afficher leur numéro.
 Afficher leur solde.

D. Interface
 Créer une page d'accueil.
 Ajouter un bouton Espace opérateur.
 Ajouter un bouton Espace client.
 Créer les tableaux de bord.
 Utiliser Bootstrap.