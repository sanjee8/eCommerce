Équipe composée de :
RAMMOHAN Ramsanjeevan
ALBIEVOK Ali
KADIRI Anas




Notes:
* Nous n'avons fait que le strict nécessaire demandé dans l'énoncé du projet. ( Pas de design poussé, simple Bootstrap;
 Pas de page produit; ..)


INSTALLATION :

* Pour faire une installation rapide, vous pouvez vous rendre sur <chemin où est hébergé le site>/install/
(exemple : localhost/eCommerce/install/), nous n'aurez qu'à rentrer les informations demandées. Une fois ceci fait, vous
pouvez supprimer le dossier install.


* Installation manuelle :
- Rendez vous dans le dossier Config pour rentrer les accès de la base de données
- Dans Config/General.php, vous devez spécifier où se situe le dossier Views rapport à votre nom de domaine.
(exemple : si le domaine est localhost/eCommerce, alors le pathView = ROOT . "\\eCommerce\\Views\\" )
- Exécutez le fichier ecommerce.sql qui se trouve dans le dossier install.


ATTENTION:
Vous devez dans tous les CAS modifier le fichier .htaccess ( racine ), la deuxième ligne:
Si votre site est hébergé à la racine :
RewriteBase /
Si dans un dossier "eCommerce" :
RewriteBase /eCommerce/

Comptes :

Vous pouvez créer un compte ou utiliser :
    email : mot de passe
    - test@test.fr : test

Compte admin :
    email : mot de passe
    - admin@test.fr : admin



GitHub :
https://github.com/sanjee8/eCommerce