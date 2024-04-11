# IDK ( *I Don't Know* what to watch !? )

## Les conventions

### HTML

- Toujours déclarer le bloc HTML au début des pages.
  ```html
  <!DOCTYPE html>
  ```
- Les noms de balises et attributs restent toujours en minuscule.
  ```html
  <body>
    <p>Paragraphe</p>
    <a href="https://github.com/gabriochee/IDK">Découvrez notre projet</a>
    <!-- pas de "HREF" -->
  </body>
  ```

- La même régle s'applique pour les noms de fichiers. Ils doivent aussi être en minuscule pour réduire les erreurs de liens.
  ```html
  <img src="esgi.png" alt="Logo d'ESGI" width=200 height=200>
  ```

- Les différents attributs ne doivent pas avoir trop d'espaces afin de rendre le tout plus lisible.
  ```html
  <link rel = "stylesheet" href = "styles.css">
  <!-- Cela va devenir rapidement illisible... -->
  
  <link rel="stylesheet" href="styles.css">
  <!-- C'est mieux -->
  ```

- Pour les attributs `class` et `id`, leurs noms sont tous en minuscule. Le kebab-case peut être utilisé.
  Le kebab-case consiste à séparer chaque mot par un tiret `-`. Cependant [d'autres conventions](#bem) peuvent être utilisées.
  ```html
  <h1 id="mainheading"></h1>
  <p class="importantreminder"></p>
  <!-- ou -->
  <h1 id="main-heading"></h1>
  <p class="important-reminder"></p>
  ```

- Pas de lignes HTML trop longues. Il est assez pénible de devoir scroller a essayer d'aller d'un bout à l'autre d'une ligne alors n'hésitez pas à casser vos lignes.

  Surtout que les éditeurs modernes vous donnent la possibilité de casser les lignes automatiquement afin de vous fournir un affichage optimal.
  ```html
  <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non purus id quam ornare venenatis in ut justo. In hac habitasse platea dictumst. Phasellus at maximus orci. Vivamus efficitur sit amet orci id luctus. Nullam molestie dapibus orci <span style="font-weight : 2em;">sit amet</span> molestie.</h3>
                                                                                                                                                                                                                                                  <!-- Imaginez scroller a chaque fois pour modifier ce span... -->
  ```

- Les balises HTML doivent être clairement positionnées. Essayez de faire en sorte que votre HTML ne soit pas un gros tas de code.

  **Mauvais exemple :**
  ```html
  <body>
  <h1>Les villes populaires</h1>
  <h2>Tokyo</h2><p>Tokyo est la capital du japon, au centre de la zone du Grand Tokyo, et la zone urbaine la plus densémment peuplée au monde.</p>
  <h2>Londres</h2><p>Londres est la capital de l'Angleterre. C'est la ville la plus peuplée du Royaume-Uni.</p>
  <h2>Paris</h2><p>Paris est la capital de la France. La zone parisienne est une des plus peuplée d'Europe.</p>
  </body>
  <!-- Vous arrivez a vous retrouver la dedans ? -->
  ```

  **Bon exemple :**
  ```html
  <body>
  <h1>Les villes populaires</h1>
  
  <h2>Tokyo</h2>
  <p>Tokyo est la capital du japon, au centre de la zone du Grand Tokyo,
   et la zone urbaine la plus densément peuplée au monde.</p>
  
  <h2>Londres</h2>
  <p>Londres est la capital de l'Angleterre. C'est la ville la plus peuplée du Royaume-Uni.</p>
  
  <h2>Paris</h2>
  <p>Paris est la capital de la France. La zone parisienne est une des plus peuplée d'Europe.</p>
  
  </body>
  <!-- On s'y retrouve mieux ! -->
  ```

- Utilisez l'indentation pour rendre le tout plus clair. L'indentation c'est l'espacement entre un élément et la marge.
  L'indentation permet de comprendre plus rapidement la structure du code et de savoir quel élément est imbriqué dans quel autre élément.
  ```html
  <ul>
    <li>Londres</li>
    <li>Paris</li>
    <li>Tokyo</li>
  </ul>
  ```

- Une image doit toujours avoir comme attributs sa largeur, sa hauteur et sa description alternative (rends le site accessible)
  ```html
  <img src="idk.png" alt="logo IDK" style="width:128px;height:128px">
  ```

### CSS

- Un point essentiel, c'est d'importer son CSS et non pas l'écrire directement dans l'HTML au risque de rapidement s'emmêler les pinceaux.
  ```html
  <link rel="stylesheet" href="style.css">
  <!-- Tellement plus simple -->
  ```

- A propos des fichiers CSS, découper tout le style du site sur plusieurs feuilles est plus judicieux
  et permet une meilleure organisation.

<a id="bem"></a>
- Il existe de nombreuses conventions en CSS mais une des plus utilisées est la convention **BEM**.

  BEM pour *Block Element Modifier*.

  Cette convention sert a donner une logique et une rigueur aux différents noms de classes CSS.
  En effet BEM s'organise autour de l'idée que les pages web se découpent en 2 composants :
  
  - Le **bloc** qui est un composant parent contenant un ou plusieurs **éléments**. Il est indépendant.
    Un exemple de bloc peut être un menu ou un pied de page.
    
  - L'**élément** qui fait partie d'un **bloc**, qui est un composant enfant du **bloc**.
    Il peut être le titre d'un bloc ou la page d'un menu.

  Ensuite, BEM introduit la notion de **modificateur**. C'est un comportement qui change en fonction du contexte de la page
  ou d'une action utilisateur.

  Pour mieux comprendre, je propose quelques exemples de `classes` rédigées selon cette notation.
  
  ```html
  <div class="menu">
    <div class="menu__item">Page 1</div>
  </div>
  ```
  Ici, on comprend bien que `menu_item` est un élément de `menu`, c'est plus simple pour s'y retrouver.

  ```html
  <div class="menu">
    <div class="menu__item">Page 1</div>
    <div class="menu__item  menu__item--is-open">Page 2</div>
    <div class="menu__item">Page 3</div>
  </div>
  ```
  ```css
  .menu__item {
    background-color : white;
  }
  .menu__item--is-open{
    background-color : purple;
  }
  ```

  Ici, on comprend tout de suite que `menu__item--is-open` fait reference a un élément du `menu` et que cette classe
  s'applique quand le menu est ouvert d'aprés le modificateur `is-open`.

  La syntaxe générale d'une classe avec BEM est la suivante : **.bloc__element--modificateur**

- Savoir bien écrire le nom des classes est une bonne chose, mais il faut aussi savoir bien les utiliser et bien les déclarer.

  N'oubliez pas que les `class` peuvent être accumulées par un seul élément HTML comme ci-dessous :
  ```html
  <div class="bouton bouton-secondaire">Bouton secondaire</div>
  ```

- Il est préférable d'utiliser le principe **Open/Close** en CSS.

  Ce principe dit que le code CSS doit être **extensible** (**ouvert** à toute extension) mais **non modifiable** (**fermé** à toute modification).

  Pour comprendre cela, reprenons l'exemple du bouton d'au dessus et voyons les classes CSS qui le composent :
  ```css
  .bouton {
    display: block;
    font-size: 12px;
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
  }
  
  .bouton-secondaire {
      display: inline-block;
      font-size: 10px;
      border-width: 0;
      border-style: none;
  }
  ```
  Comme expliqué plus haut, le principe Open/Close priorise l'**extension** et non pas la **modification**. Et si l'on regarde dans le CSS, ma classe `.bouton-secondaire`
  vient modifier les propriétés `display`, `font-size`, `border-width`et `border-style` de ma classe `.bouton`. Il aurait été plus simple de créer ma classe `.bouton-secondaire`
  de façon indépendante en lui retirant les attributs `border-width` et `border-style` et d'attribuer à mon bouton d'au dessus seulement la classe `.bouton-secondaire`.
  
### PHP

- Vos noms de variables, fonctions, classes etc... doivent être **clairs**. Il faut bannir a tout prix les variables à une lettre ou les noms de variables qu'uniquement
  vous pouvez comprendre. Les itérateurs de boucles sont les seules exceptions à cette règle.

  **Mauvais exemple**
  ```php
  function calc_h($c1, $c2){
    return sqrt($c1 * $c1 + $c2 * $c2);
  }
  
  $c1 = 4;
  $c2 = 5;
  $h = calc_h($c1, $c2);
  echo($h);
  // Que fait ce code ? Qu'est-ce que signifie 'h', 'c1' et 'c2' ? Que fait 'calc_h' ? 
  ```
  **Bon exemple**
  ```php
  function calculerHypothenus($cote1, $cote2){
    return sqrt($cote1 * $cote1 + $cote2 * $cote2);
  }
  
  $cote1 = 4;
  $cote2 = 5;
  $hypotenus = calculerHypothenus($cote1, $cote2);
  echo($hypotenus);
  // On comprend mieux le rôle de chaque variable ainsi que ce que fait la fonction.
  ```
- Les conventions de nommage en PHP sont les suivantes :
  - Les **Interfaces** et les **Classes** sont écrites en ***PascalCase***. C'est-à-dire que chaque première lettre de chaque mot est en majuscule.

    Voici des exemples de noms suivants cette syntaxe : `User`, `WebRequest` et `CustomUserBasket`.

  - Les **variables**, **fonctions** et **méthodes** utilisent la syntaxe ***camelCase***. C'est une syntaxe pareille au PascalCase sauf que la première lettre du premier mot **n'est pas**
    en majuscule.

    Voici des exemples de noms de suivant cette syntaxe : `calculateAverage`, `password` et `userId`.

  - Les **constantes** utilisent la syntaxe ***ALL_CAPS***. Cette syntaxe posséde tous ces mots en **majuscule** et ils sont séparés par des **tiret du bas**.

    Voici des exemples de noms suivants cette syntatxe : `PI`, `REQUESTS_LIMIT` et `MAXIMUM_TEXT_LENGTH`.

- La syntaxe standarde des instructions PHP sont définies comme suit :
  - Pour les `if ... else`, il est important de conserver l'espacement entre chaque caractère comme dans l'exemple.
    ```php
    if (condition) {
      //code...
    } elseif (condition2) {
      //encore du code...
    } else {
      //code final...
    }
    ```
  - Pour les boucles `while`.
    ```php
    while (condition) {
      //code...
    }
    ```
  - Pour les boucles `for` et `foreach`.
    ```php
    for ($i = 0; $i < 10; $i++) {
      //code...
    }

    foreach ($array as $value) {
      //code...
    }
    ```
    
