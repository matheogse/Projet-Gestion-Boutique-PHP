<?php
//////////////////////////////////////////////
// PROJET : GESTION DE STOCK D'UNE BOUTIQUE //
//////////////////////////////////////////////

/////////////////////////////////////////////////
//Affichages de Base
////////////////////////////////////////////////
echo "------------------------------------------------------------------------------------------------------\n|                             \033[41mPROJET : GESTION DE STOCK D'UNE BOUTIQUE\033[0m                              |\n------------------------------------------------------------------------------------------------------\n";
echo "\n====== \033[44mQue souhaitez-vous effectuer ?\033[0m======\n\n";
echo "ATTENTION : A l'éxécution de ce programme la boutique ne contient aucun produits ni quantité c'est à vous de les renseigner !\n\n";
echo "  I.    \033[42mInitialisation du stock\033[0m  🏗️ \n";
echo "=> TAPEZ 1 : Créez un tableau indexé 📊 pour modéliser les articles de la boutique. \n\n";

echo "  II.   \033[42mLa Gestion des Stocks\033[0m  📦\n";
echo "=> TAPEZ 2 : Associer un stock à un ou plusieurs articles\n\n";

echo "  III.  \033[42mRéalisation de vente\033[0m  🛍️\n";
echo "=> TAPEZ 3 : Simulez une vente dans la boutique d'un article et retirer sa quantité\n\n";

echo "  IV.   \033[42mRéapprovisionnement du stock\033[0m  🔄\n";
echo "=> TAPEZ 4 : Simulez le réapprovisionnement d'un article d'un ou plusieurs articles\n\n";

echo "  V.    \033[42mSynthèse et Affichage du Stock\033[0m 📊\n";
echo "=> TAPEZ 5 : Affichez une synthèse de l'état actuel du stock de la boutique \n\n";

echo "  VI.   \033[42mSuivi de Ventes Totales par Article\033[0m 📈\n";
echo "=> TAPEZ 6 : Suivre le nombre de ventes pour chaque article \n\n";

echo "  VII.   \033[42mSuppression d'un Article\033[0m ❌\n";
echo "=> TAPEZ 7 : Supprimer un article de votre boutique \n\n";


$produitsArticles = [];
$quantiteArticles = [];
$choixActionUtilisateur = null;
// CONSIGNE 6.1 : Créez un tableau indexé 📊 pour stocker le nombre total de ventes pour chaque article.
$ventesTotalParArticle = [];
/////////////////////////////////////////////////
//Choix de l'utilisateur
/////////////////////////////////////////////////
while (true) {
    $choixActionUtilisateur = readline("Parmis les propositions ci dessus entrez un numéro associé à l'action pour effectué celle-ci (Pour arreter la totalité du programme tapez STOP) : ");
    if ($choixActionUtilisateur == "STOP") {
        break;
    }
    if ($choixActionUtilisateur < 1 || $choixActionUtilisateur > 7) {
        echo "Veuillez entrer une valeur conforme parmi celles proposées (1, 2, 3, 4, 5, 6, 7).\n";
        continue;
    }
    ////////////////////////////////////////////////////////////////////////////////////
    // CHOIX 1 : Créez un tableau indexé 📊 pour modéliser les articles de la boutique.
    ////////////////////////////////////////////////////////////////////////////////////
    if ($choixActionUtilisateur == 1) {
        // CONSIGNE 1.1 : Créez un tableau indexé 📊 à une dimension
        $produitAjoutInitial = readline("Quel est le nom du produit que vous souhaitez ajouter à votre boutique (Pour arrêter l'approvisionnement ne rien entrez) : ");
        while (true) {
            if ($produitAjoutInitial == null) {
                break;
            }
            $quantitéAssociéProd = readline("Quelle est la quantité associé au produit $produitAjoutInitial : ");
            // CONSIGNE 2.1 : Le tableau des quantités doit avoir le même nombre d'éléments que celui des articles. Par exemple : 10, 5, 8, 3, 12 (qui représentent les quantités en stock des articles correspondants).
            if ($quantitéAssociéProd == "") {
                echo PHP_EOL;
                echo "Vous devez OBLIGATOIREMENT entrer une valeur de quantité au produit $produitAjoutInitial !";
                echo PHP_EOL;
                while ($quantitéAssociéProd == "") {
                    $quantitéAssociéProd = readline("Quelle est la quantité associé au produit $produitAjoutInitial : ");
                }
            }
            array_push($produitsArticles, $produitAjoutInitial);
            array_push($quantiteArticles, $quantitéAssociéProd);
            array_push($ventesTotalParArticle, 0);
            $produitAjoutInitial = readline("Quel est le nom du produit que vous souhaitez ajouter à votre boutique (Pour arrêter l'approvisionnement ne rien entrez) : ");
        }
        // CONSIGNE 1.2 : Affichez la liste des articles disponibles 📃 en utilisant une boucle for
        echo "Vous venez d'initialiser les produits suivants :\n";
        for ($i = 0; $i < count($produitsArticles); $i++) {
            echo $produitsArticles[$i];
            echo PHP_EOL;
        }
        // CONSIGNE 1.3 : Affichez la liste des articles disponibles 📃 en utilisant une boucle foreach
        echo "Vous venez d'initialiser les produits suivants :\n";
        foreach ($produitsArticles as $prod) {
            echo $prod;
            echo PHP_EOL;
        }

        echo "Vous venez d'initialiser les produits et les quantités associés";
        echo PHP_EOL;
        echo "===========================\nPRODUIT ----- QUANTITE\n===========================";
        echo PHP_EOL;

        // CONSIGNE 2.2 : Affichez la liste des articles avec leur quantité en stock en utilisant une boucle for.
        for ($i = 0; $i < (count($produitsArticles)); $i++) {
            echo $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
            echo PHP_EOL;
        }


        //////////////////////////////////////////////////////////
        // CHOIX 2 : Associer un stock à un ou plusieurs articles
        //////////////////////////////////////////////////////////
    } elseif ($choixActionUtilisateur == 2) {
        echo "Ci dessous la liste des articles présents dans votre boutique :\n";
        for ($i = 0; $i < (count($produitsArticles)); $i++) {
            echo $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
            echo PHP_EOL;
        }
        $compteur = 0;
        while (true) {
            $compteur++;
            $article = readline("Entrez le nom de l'article n°$compteur auquel vous souhaitez associer une quantité : ");
            for ($j = 0; $j < count($produitsArticles); $j++) {
                if ($produitsArticles[$j] == $article) {
                    $quantitéAAssocier = readline("Quelle quantité souhaitez-vous desormais attribuer à '$article' : ");
                    $quantiteArticles[$j] = $quantitéAAssocier;
                    echo "Très bien les modifications ont été effectuées. Voici le résultat : \n";
                    echo "===========================\nPRODUIT ----- QUANTITE\n===========================";
                    echo PHP_EOL;
                    for ($i = 0; $i < (count($produitsArticles)); $i++) {
                        echo $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
                        echo PHP_EOL;
                    }
                    break;
                }
                if ($j == (count($produitsArticles) - 1) && $produitsArticles[$j] != $article) {
                    echo "Il semblerait que votre article n'ai pas été trouvé dans la listes des produits de la boutique";
                }
            }
            echo PHP_EOL;
            $autreProduit = readline("Souhaitez-vous effectuer une autre association (O/N) : ");

            while ($autreProduit != "O" && $autreProduit != "N") {
                echo "Veuillez entrer une des deux valeurs suivantes : O/N\n";
                $autreProduit = readline("Souhaitez-vous effectuer une autre association (O/N) : ");
            }

            if ($autreProduit == "N") {
                break;
            }
        }

        ///////////////////////////////////////////////////////////////////////////////////
        // CHOIX 3 : Simulez une vente dans la boutique d'un article et retirer sa quantité
        ///////////////////////////////////////////////////////////////////////////////////
    } elseif ($choixActionUtilisateur == 3) {
        echo "Ci dessous la liste des articles présents dans votre boutique :\n";
        echo "===========================\nPRODUIT ----- QUANTITE\n===========================";
        echo PHP_EOL;
        for ($i = 0; $i < (count($produitsArticles)); $i++) {
            echo $i . " : " . $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
            echo PHP_EOL;
        }
        while (true) {
            // CONSIGNE 3.1 : Demandez à l'utilisateur de choisir un article (par son index dans le tableau) et de spécifier la quantité vendue.
            $prodVendre = readline("Quel est l'index du produit que vous souhaitez vendre : ");
            $compteurVente = -1;
            foreach ($produitsArticles as $prod) {
                $compteurVente++;
                // CONSIGNE 3.2 : Modifiez la quantité en stock en conséquence (vérifiez que le stock est suffisant avant d'effectuer la vente).
                if ($prod == $produitsArticles[$prodVendre]) {
                    $quantiteVendreProd = readline("Quelle quantité du produit $prodVendre souhaitez-vous vendre : ");
                    if ($quantiteVendreProd > $quantiteArticles[$compteurVente]) {
                        echo "Vous ne pouvez pas vendre au delà de ce que vous posséder. Vous devez saisir une quantité comprise entre 1 et " . $quantiteArticles[$compteurVente] . " inclus";
                        echo PHP_EOL;
                        while ($quantiteVendreProd > $quantiteArticles[$compteurVente]) {
                            $quantiteVendreProd = readline("Quelle quantité du produit $prodVendre souhaitez-vous vendre : ");
                        }
                    } else {
                        $quantiteArticles[$compteurVente] -= $quantiteVendreProd;
                        // CONSIGNE 6.2 : À chaque vente, mettez à jour ce tableau en ajoutant la quantité vendue.
                        $ventesTotalParArticle[$compteurVente] += $quantiteVendreProd;
                    }
                    // CONSIGNE 3.3 : Affichez un message confirmant la vente ✅ ou indiquant que le stock est insuffisant ❌.
                    echo "Très bien les modifications ont été effectuées. Voici le résultat : \n";
                    for ($i = 0; $i < (count($produitsArticles)); $i++) {
                        echo $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
                        echo PHP_EOL;
                    }
                    break;
                } elseif (($compteurVente == count($produitsArticles) - 1) && ($prodVendre != $prod)) {
                    echo "Le produit $prodVendre n'as pas été trouvé dans la boutique.\n";
                    break;
                }
            }
            echo PHP_EOL;
            $autreProduit = readline("Souhaitez-vous effectuer une autre vente (O/N) : ");
            while ($autreProduit != "O" && $autreProduit != "N") {
                echo "Veuillez entrer une des deux valeurs suivantes : O/N\n";
                $autreProduit = readline("Souhaitez-vous effectuer une autre vente (O/N) : ");
            }

            if ($autreProduit == "N") {
                break;
            }
        }


        ///////////////////////////////////////////////////////////////////////////////////
        // CHOIX 4 : Simulez le réapprovisionnement d'un article d'un ou plusieurs articles
        ///////////////////////////////////////////////////////////////////////////////////
    } elseif ($choixActionUtilisateur == 4) {
        echo "Ci dessous la liste des articles présents dans votre boutique :\n";
        echo "===========================\nPRODUIT ----- QUANTITE\n===========================";
        echo PHP_EOL;
        for ($i = 0; $i < (count($produitsArticles)); $i++) {
            echo $i . " : " . $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
            echo PHP_EOL;
        }
        while (true) {
            // CONSIGNE 4.1 : Demandez à l'utilisateur de choisir un article à réapprovisionner (par son index) et de spécifier la quantité à ajouter ➕.
            $prodApprovisionnement = readline("Quel est l'index du produit que vous souhaitez réapprovisionner : ");
            for ($k = 0; $k < count($produitsArticles); $k++) {
                if ($k == $prodApprovisionnement) {
                    // CONSIGNE 4.2 : Modifiez la quantité en stock en ajoutant la quantité spécifiée.
                    $quantiteApprovisionner = readline("Quelle quantité souhaitez-vous ajouter au produit d'index $prodApprovisionnement : ");
                    $quantiteArticles[$prodApprovisionnement] += $quantiteApprovisionner;
                    // CONSIGNE 4.3 : Affichez la nouvelle quantité en stock de l'article.
                    echo "Très bien les modifications ont été effectuées. Voici le résultat : \n";
                    for ($i = 0; $i < (count($produitsArticles)); $i++) {
                        echo $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
                        echo PHP_EOL;
                    }
                    break;
                } elseif ($prodApprovisionnement >= count($produitsArticles)) {
                    echo "Le produit $prodApprovisionnement n'as pas été trouvé dans la boutique.\n";
                    break;
                }
            }

            echo PHP_EOL;
            $autreProduit = readline("Souhaitez-vous effectuez un autre approvisionnement (O/N): ");
            if ($autreProduit == "N") {
                break;
            } elseif ($autreProduit != "O") {
                echo "Veuillez entrer une des 2 valeurs suivantes : O/N\n ";
                while ($autreProduit != "O" && $autreProduit != "N") {
                    $autreProduit = readline("Souhaitez-vous effectuez un autre approvisionnement (O/N): ");
                }
            }
        }

        ///////////////////////////////////////////////////////////////////////////
        // CHOIX 5 : Affichez une synthèse de l'état actuel du stock de la boutique
        ///////////////////////////////////////////////////////////////////////////
    } elseif ($choixActionUtilisateur == 5) {
        for ($a = 0; $a < count($produitsArticles); $a++) {
            if ($quantiteArticles[$a] == 0) {
                // CONSIGNE 5.2 : Indiquez les articles qui sont en rupture de stock (quantité égale à 0) 🚫
                echo "\033[31m" . $produitsArticles[$a] . " ------> " . $quantiteArticles[$a] . "  PRODUIT EN RUPTURE DE STOCK\033[0m";
                echo PHP_EOL;
            } else {
                // CONSIGNE 5.1 : Affichez chaque article avec la quantité restante en stock 📉.
                echo $produitsArticles[$a] . " ------> " . $quantiteArticles[$a];
                echo PHP_EOL;
            }
        }

        ///////////////////////////////////////////////////////////////////////////
        // CHOIX 6 : Suivi des Ventes Totales par Article
        ///////////////////////////////////////////////////////////////////////////
    } elseif ($choixActionUtilisateur == 6) {
        for ($s = 0; $s < count($produitsArticles); $s++) {
            // CONSIGNE 6.3 : Affichez la liste des articles avec le nombre total de ventes 📈.
            echo $ventesTotalParArticle[$s] . " " . $produitsArticles[$s] . " ont été vendues (depuis l'execution de ce programme).\n";
        }

        ///////////////////////////////////////////////////////////////////////////
        // CHOIX 7 : Retirer un article de la boutique 
        ///////////////////////////////////////////////////////////////////////////
    } elseif ($choixActionUtilisateur == 7) {
        echo "Ci dessous la liste des articles présents dans votre boutique :\n";
        echo "===========================\nPRODUIT ----- QUANTITE\n===========================";
        echo PHP_EOL;
        for ($i = 0; $i < (count($produitsArticles)); $i++) {
            echo $i . " : " . $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
            echo PHP_EOL;
        }
        while (true) {
            $articleEtQuantiteSup = readline("Quelle est l'index de l'article que vous souhaitez supprimer : ");
            if ($articleEtQuantiteSup < count($produitsArticles) && $articleEtQuantiteSup >= 0) {
                unset($produitsArticles[$articleEtQuantiteSup]);
                unset($quantiteArticles[$articleEtQuantiteSup]);
                unset($ventesTotalParArticle[$articleEtQuantiteSup]);
                echo "Ci dessous la liste des articles présents dans votre boutique :\n";
                echo "===========================\nPRODUIT ----- QUANTITE\n===========================";
                echo PHP_EOL;
                for ($i = 0; $i < (count($produitsArticles)); $i++) {
                    echo $i . " : " . $produitsArticles[$i] . " =====> " . $quantiteArticles[$i];
                    echo PHP_EOL;
                }
                break;
            } else {
                echo "L'article d'index $articleEtQuantiteSup n'as pas été trouvé. Veuillez entrer une valeur comprise entre 0 et " . (count($produitsArticles) - 1);
                echo PHP_EOL;
            }
        }
    }
}
