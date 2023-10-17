
# Projet site de timbre V3 | PW2-TP3

Thomas Aucoin-Lo  
e2395387

> ### index
> * [Mises à jour](#mises-à-jour)
> * [Notes](#notes)
> * [Liens](#liens)
> * [Résumé](#résumé)
> * [Connexions](#connexions)
> * [Diagramme](#sur-le-diagramme-entité-relationel)
> * [Base de données](#sur-la-base-de-données)
> * [Niveaux d'accès](#sur-les-niveaux-daccès)
> * [Architecture](#sur-larchitecture-du-projet)
> * [Script php](#sur-le-script-php)


## Mises à jour 

> ### TP3 | 10/16/2023
> * nouvelle structure de DB (voir diagram ou presentation)
> * implémenter une journal de bord
> * implémenter archivage des étampes
> * implémenter importation image
> * changer structure de niveau d'accès

## Notes

> #### À fixer
> * Les images importées ne sont pas supprimer du fichier source lors de la suprresion d'une étampe
> * Le champs *nas* ne présente aucune protection

>3 niveaux d'accès sont possibles, soit 1->super-admin, 2->admin, 3->customer. Ils ont chacuns leurs propres accès, il est donc nécéssaire de se connecter au trois niveaux pour voir tout le projet.  
**voir niveaux d'accès pour plus de détails*

## Liens  

**webdev**: https://e2395387.webdev.cmaisonneuve.qc.ca/PW2-TP3/  

**git-hub**: https://github.com/thomasIRA/PW2-TP3.git


## Résumé  

Un site où les utilisateurs peuvent se connecter et ajouter des timbres categorisés, les échanger(à venir), et autres fonctionnalitées comme un journal de bord et un journal d'archive de timbres, des images à importées et autres.

## Connexions

**voir niveaux d'accès pour plus de détails*  

### Sur webdev:   

> #### super-admin:
> * user email: root@root.com
> * password: ***voir presentation.pdf***

> #### admin:
> * user email: billy@billy.com
> * password: ***voir presentation.pdf***

> #### customer:
> * user email: john@john.com
> * password: 12345678  
> **ou créez votre propre utilisateur*  

### Sur votre serveur:

> * désactiver le **CheckSession::sessionAuth()** dans le constructeur du fichier *ControllerStaff*.
> * dans l'url, inscrire après la racine: *staff/create*.
> * créer un employé ayant le privilège *super-admin*
> * réactiver la protection dans *ControllerStaff*
> * à partir d'un profil super-admin, vous pouvez peupler la DB comme vous voulez.

## Sur le diagramme entité relationel

**voir diagram.png ou presentation.pdf* 

Le projet consiste de 10 tables, dont une où la clé est composée et deux où la clé est étrangère et primaire.  

* User -> contient les infos d'un utilisateur, passe son ID soit à Staff ou Customer

* Customer -> contient les mêmes infos que User mais passe son ID à la table Stamp

* Staff -> contient les mêmes infos que User + un champ pour *nas*  
*(Ce champ sert d'exemple et n'offre aucune protection)

* Privilege -> contient les 3 niveaux d'accès, passe son Id à la table User

* Aspect -> contient les aspects

* Category -> contient les catégories, passe son ID à la table Stamp_has_category

* Stamp -> contient les infos d'un timbres, passe son ID à la table Stamp_has_category

* Stamp_has_category -> contient les liens entre Stamp et Category

* Log -> contient les infos d'un accès à une page

* Archive -> contient un clone d'une entrée de la table Stamp  
*(Est créée lors de la suppression d'un timbre)

## Sur la base de données   

**voir diagram.png ou presentation.pdf*   
**voir stampDB.sql*

Les tables de la DB sont relativement lousses où la majorité des clés étrangères sont non-obligatoires.   
Plusieurs tables ont été rajoutées pour amèliorer la gestion d'accès et l'archivage

## Sur les niveaux d'accès  

### super-admin:
* accès à la page *panel*  
* peut modifier, créer et supprimer toutes les tables  
**attention:** Supprimer une entrée donnant des clés étrangères obligatoires supprimera aussi les entrées correspondantes.

### admin:
* accès à la page *panel*  
* peut modifier, créer et supprimer toutes les tables SAUF la table STAFF

### customer:
* accès à la page *profile*  
* peut modifier, créer et supprimer les tables suivantes où le **id** visé correspont au sien:
    * user
    * stamp

## Sur l'architecture du projet  

Le projet actuel est construit suivant un modèle MVC et emploi l'API externe TWIG pour la gestion des rendus.

## Sur le script php  

Le script permet de mettre en place la majorité des fonctionnalités du projet.   
**voir models et controllers*

> ### Sur la classe CRUD et les méthodes non vues en classes
> * *readKeys()*: permet de lire une/des entrées d'une table à deux clés composées.
>* *readWhere()*: permet de lire une/des entrées d'une table en spécifiant la cible et la valeur.  
>* *deleteStampCat()*: ***spécifique*** permet de supprimer une/des entrées de la table Stamp_Category en spécifiant une ou deux valeurs cibles.

> ### Sur les controllers
> Les controllers partagent plusieurs méthodes et utilisent des concepts vus en classes. Parcontre, certaines méthodes implementent plusieurs fonctions afin de concorder à la DB.  
***I.e***: Supprimer un utilisateur comporte 3 étapes: 
> * trouver le *user* et le supprimer
> * trouver ses *stamps* et les supprimer
> * trouver leurs *stamp_categories* et les supprimer

> #### commentaires:
>Seules les méthodes et fonctions complexes ou non-vues
sont explicitement commentées dans le script.


## Sur la validation et la gestion d'erreurs  

Une validation et gestion d'erreur et est en place sur les niveaux d'accès et sur l'url.   
Une validation et gestion d'erreur est implémentée sur les champs uniques.  

