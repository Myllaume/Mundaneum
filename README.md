# Mundaneum
Application web immersive dans le monde des bibliothèques et de la connaissance mondiale.

## Ecrire un article 

Un logiciel comme [Notepad++](https://notepad-plus-plus.org/downloads/v7.8.5/) convient pour réaliser les fichiers requis.

Créer un dossier correspondant au titre de l'article et dont le nom ne contient pas d'accents et des tirets "``-``" à la place des espaces. Ce dossier contient trois fichiers :
- ``main.md`` contenu principal de l'article
- ``lateral.md`` contenu additionnel, de second plan, de l'article
- ``metadata.json``
- éventuelles images

Les fichiers en ``.md`` sont rédigés en balisage léger **markdown**. Un [tutoriel complet est disponible sur cette page](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet) pour utiliser les éléments spéciaux.

## Écrire avec markdown

### Liens internes

```markdown
Debut de la phrase avec en son sein [un lien dont voici le texte](/Mundaneum/publications/page).
```

### Liens externes

```markdown
Debut de la phrase avec en son sein [un lien dont voici le texte](https://github.com/).
```

### Listes

```markdown
 - premier élément liste à puce
 - deuxième élément liste à puce

 1. premier élément liste numérotée
 2. deuxième élément liste numérotée
```

### Images

```markdown
![texte de remplacement](/Mundaneum/images/titre_image.jpg "Titre de l'image")
```

### Tableau

```markdown
| Colonne 1 | Colonne2  | 
| --------- |-----------|
| content   | content   | 
| content   | content   | 
| content   | content   |
```

## Écrire avec JSON

Reprendre le modèle suivant dans un fichier ``metadata.json`` :

```json
{
    "titre": "Page d'essaie",
    "id": "essaie",
    "date":"2020-03-17",
    "keywords": "essaie, premier jet, première page, hypertexte"
}
```