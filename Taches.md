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

 ==================================================================== VERSION 2
 # Création des seed 
 php spark make:seeder AutreOperateurSeeder
php spark make:seeder CommissionExterneSeeder

# Création des migrations 
 php spark make:migration AddCommissionToHistoriqueTable
 php spark make:migration CreateAutreOperateurTable
 php spark make:migration CreateAutreOperateurPrefixeTable
 php spark make:migration CreateCommissionExterneTable

---- Leila --------
 Côté Opérateur
Gestion des autres opérateurs

Créer une page pour ajouter les préfixes des autres réseaux (ex: Orange 032, Telma 031).
Créer une page pour définir le pourcentage (%) de commission supplémentaire pour chaque réseau externe.
Ajouter les routes dans Routes.php pour accéder à ces pages.
Rapports et Gains

Modifier la page "Situation des gains" : créer deux tableaux séparés (un pour l'opérateur actuel, un pour les autres).
Créer une nouvelle page "À payer aux autres opérateurs" qui liste les montants totaux dus par chaque réseau externe.
Ajouter les routes pour ces nouvelles pages de rapports.

------------Tsara ---------
 Côté Client
Option "Frais inclus"

Ajouter une case à cocher ("Inclure les frais de retrait") sur la page d'envoi d'argent.
Modifier le calcul du montant total à déduire si la case est cochée.
Envoi Multiple

Créer ou modifier la vue d'envoi pour permettre d'ajouter plusieurs numéros de téléphone en même temps.
Faire le calcul automatique qui divise le montant total par le nombre de bénéficiaires (ou permet de définir un montant par personne).
Mettre à jour le contrôleur pour traiter cette liste de numéros en une seule transaction.
Ajouter la route /envoie-frais-client (si ce n'est pas déjà fait) pour accéder à cette fonctionnalité.

 Configuration & Base de données
Base de données

Créer/Modifier les tables pour stocker les préfixes externes et leurs taux de commission.
Vérifier que la table historique peut bien enregistrer plusieurs transactions liées à un même envoi multiple.
Sécurité & Accès


git add .
git commit -m "Mon travail"
git push origin works

git checkout main
git pull origin main
git merge works
git push origin main