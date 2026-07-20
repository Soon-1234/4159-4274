- Création des tables ( table.sql - racine - )

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