------ Tsara ------
- Création des tables ( table.sql - racine - )

------Leila------
# Création des migrations 

php spark make:migration CreatePrefixeTable
php spark make:migration CreateClientTable
php spark make:migration CreateTypeOperationTable
php spark make:migration CreateBaremeFraisTable
php spark make:migration CreateHistoriqueTable

# Création des seed 
php spark make:seeder PrefixeSeeder
php spark make:seeder TypeOperationSeeder
php spark make:seeder BaremeFraisSeeder
php spark make:seeder DatabaseSeeder

# lancer les migrations rehetra 
php spark migrate

# lancer les seed rehetra 
php spark db:seed DatabaseSeeder

# en cas de problèmes de fafana ny base de manao an'ito 
php spark migrate:refresh
php spark db:seed DatabaseSeeder


-- Tsara -- 
Login côté clients (Routes.php , clients/AuthController/ )