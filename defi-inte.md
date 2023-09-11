# Documentation de l'api des défies de l'intégration

## Avoir tout les défies de l'intégration disponible

### Requête

| URL            | Method |
|:---------------| :--- |
| /api/challenge | GET |

### Réponse

#### Succés

- code : **200**
- contenue :
```json
{
    "data": [
        {
            "id": 1,
            "name": "Sticker",
            "points": 2,
            "description": "\ud83c\udf20R\u00e9cup\u00e9rer tous les stickers des listeux BDE de l'ann\u00e9e derni\u00e8re"
        },
        {
            "id": 2,
            "name": "Ecocup 1",
            "points": 2,
            "description": "\ud83e\udd64R\u00e9cup\u00e9rer tous les ecocups des listeux BDE de l'ann\u00e9e derni\u00e8re"
        },
        {
            "id": 3,
            "name": "Dodo",
            "points": 3,
            "description": "\ud83c\udfe0Dormir dans au moins 3 collocations diff\u00e9rentes"
        },
        {
            "id": 4,
            "name": "Poussi\u00e8re",
            "points": 2,
            "description": "\ud83c\udf7aBattre \u00e0 la poussi\u00e8re un membere du club poussi\u00e8res (N'importe quelle liquide)"
        },
        {
            "id": 5,
            "name": "Cantona",
            "points": 1,
            "description": "\ud83c\udfb5Lancer un champ dans le tram de l'ambiance sans invoquer un Eric Cantona"
        },
        {
            "id": 6,
            "name": "Tactique",
            "points": 1,
            "description": "\ud83d\udca4Appara\u00eetre sur la boite tactique"
        },
        {
            "id": 7,
            "name": "D\u00e9guisement",
            "points": 2,
            "description": "\ud83e\udd78Passer une soir\u00e9e avec un d\u00e9guisea du fouaille et le garder pendant le tram de l'ambiance"
        },
        {
            "id": 8,
            "name": "P\u00e2te",
            "points": 2,
            "description": "\ud83c\udf5dManger les p\u00e2tes de 6h du matin durant le WEI"
        },
        {
            "id": 9,
            "name": "Survivant",
            "points": 3,
            "description": "\ud83c\udf89Etre un survivant du WEI"
        },
        {
            "id": 10,
            "name": "Ivrogne",
            "points": 3,
            "description": "\ud83c\udf7bEtre le meilleur consommateur de l'int\u00e9gration"
        },
        {
            "id": 11,
            "name": "Europapark",
            "points": 2,
            "description": "\ud83c\udfa2Faire une photo \u00e0 Europapark pendant un rollercoaster et faire TPS avec ses mains (3 personnes requises)"
        },
        {
            "id": 12,
            "name": "Trader",
            "points": 3,
            "description": "\ud83d\udcc8Etre le plus rentable \u00e0 la soir\u00e9e bourse"
        },
        {
            "id": 13,
            "name": "Ecocup 2",
            "points": 3,
            "description": "\ud83e\udd64Etre le premier \u00e0 r\u00e9cuperer les \u00e9cocups des listeux BDE d'il y a deux ans"
        },
        {
            "id": 14,
            "name": "Artiste",
            "points": 2,
            "description": "\ud83c\udfa4Participer \u00e0 la sc\u00e9ne libre au fouaille pendant une soir\u00e9e oeno"
        },
        {
            "id": 15,
            "name": "Fouzy",
            "points": 1,
            "description": "\ud83d\udc26Prendre un selfie avec fouzy et fouzette"
        },
        {
            "id": 16,
            "name": "Afterwork",
            "points": 1,
            "description": "\ud83c\udfc6Gagner un afterwork"
        },
        {
            "id": 17,
            "name": "Canap\u00e9",
            "points": 1,
            "description": "\ud83d\udecbEtre assis sur le petit canap\u00e9 noir \u00e0 18h48 le 29\/09"
        },
        {
            "id": 18,
            "name": "After",
            "points": 3,
            "description": "\ud83e\udea9Aller en after fouaille au rallye des collocs"
        },
        {
            "id": 19,
            "name": "Soir\u00e9e TPS",
            "points": 1,
            "description": "\ud83c\udf8aAppara\u00eetre sur moi en soir\u00e9e \u00e0 TPS"
        },
        {
            "id": 20,
            "name": "Couple TPS",
            "points": 1,
            "description": "\ud83d\udc8bAppara\u00eetre sur moi et les couples \u00e0 TPS\/BS"
        },
        {
            "id": 21,
            "name": "Lan",
            "points": 2,
            "description": "\ud83c\udfaeGagner un tournoi \u00e0 la LAN d'ITS"
        },
        {
            "id": 22,
            "name": "Schnaps",
            "points": 1,
            "description": "\ud83e\udd7eAller \u00e0 la rando schnaps apr\u00e8s la PF"
        }
    ]
}
```

#### Erreurs

- code : **404**
- contenu : 
```json
{
    "message": "No challenges found"
}
```

## Avoir les informations d'un challenge en particulier

### Requête

| URL                 | Method |
|:--------------------| :--- |
| /api/challenge/{id} | GET |

- **id** : id du challenge

### Réponse

#### Succès

- code : **200**
- contenu : 
```json
{
    "id": 1,
    "name": "Ecocup",
    "points": 1,
    "description": "\ud83e\udd64R\u00e9cup\u00e9rer une \u00e9cocup"
}
```

#### Erreurs

- code : **404**
- contenu : 
```json
{
    "message": "No challenge found"
}
```

## Avoir le détails des challenges réalisés par un utilisateur

### Requête

| URL                        | Method |
|:---------------------------| :--- |
| /api/challenge/member/{id} | GET |

- **id** : id de l'utilisateur

### Réponse

#### Succès

- code : **200**
- contenu : 
```json
{
    "data": {
        "challenges": [
            {
                "id": 13,
                "name": "Ecocup 2",
                "description": "\ud83e\udd64Etre le premier \u00e0 r\u00e9cuperer les \u00e9cocups des listeux BDE d'il y a deux ans",
                "points": 3,
                "realized_at": "2023-08-08 21:14:26"
            },
            {
                "id": 19,
                "name": "Soir\u00e9e TPS",
                "description": "\ud83c\udf8aAppara\u00eetre sur moi en soir\u00e9e \u00e0 TPS",
                "points": 1,
                "realized_at": "2023-08-08 21:14:26"
            },
            {
                "id": 13,
                "name": "Ecocup 2",
                "description": "\ud83e\udd64Etre le premier \u00e0 r\u00e9cuperer les \u00e9cocups des listeux BDE d'il y a deux ans",
                "points": 3,
                "realized_at": "2023-08-08 21:14:26"
            },
            {
                "id": 16,
                "name": "Afterwork",
                "description": "\ud83c\udfc6Gagner un afterwork",
                "points": 1,
                "realized_at": "2023-08-08 21:14:26"
            }
        ],
        "total_points": "8"
    }
}
```

#### Erreurs

- code : **404**
- contenu : 
```json
{
    "message": "Member not found"
}
```

## Avoir le classement des utilisateurs

### Requête

| URL                        | Method |
|:---------------------------| :--- |
| /api/challenge/leaderboard | GET |

### Réponse

#### Succès

- code : **200**
- contenu : 
```json
{
    "data": [
        {
            "id": 51,
            "name": "Claude Barre",
            "points": "11"
        },
        {
            "id": 65,
            "name": "\u00c9lise Lacroix",
            "points": "11"
        },
        {
            "id": 87,
            "name": "Guy Levy",
            "points": "11"
        },
        {
            "id": 10,
            "name": "Arthur Meunier",
            "points": "10"
        },
        {
            "id": 12,
            "name": "Christophe Moulin",
            "points": "10"
        },
        {
            "id": 15,
            "name": "Isaac Buisson",
            "points": "10"
        },
        {
            "id": 18,
            "name": "Isabelle Schmitt",
            "points": "10"
        },
        {
            "id": 30,
            "name": "Christophe David",
            "points": "10"
        },
        {
            "id": 34,
            "name": "Zacharie Philippe",
            "points": "10"
        },
        {
            "id": 47,
            "name": "Eug\u00e8ne Benard",
            "points": "10"
        },
        {
            "id": 59,
            "name": "Arthur Fontaine",
            "points": "10"
        },
        {
            "id": 91,
            "name": "Gabriel Launay",
            "points": "10"
        },
        {
            "id": 94,
            "name": "Henri Baudry",
            "points": "10"
        },
        {
            "id": 97,
            "name": "Marcelle Girard",
            "points": "10"
        },
        {
            "id": 11,
            "name": "Michelle Dupre",
            "points": "9"
        },
        {
            "id": 16,
            "name": "Alfred Hoareau",
            "points": "9"
        },
        {
            "id": 27,
            "name": "Christine Dias",
            "points": "9"
        },
        {
            "id": 31,
            "name": "Isaac Chretien",
            "points": "9"
        },
        {
            "id": 33,
            "name": "Mich\u00e8le Boutin",
            "points": "9"
        },
        {
            "id": 43,
            "name": "Andr\u00e9e Pasquier",
            "points": "9"
        },
        {
            "id": 44,
            "name": "Valentine Gimenez",
            "points": "9"
        },
        {
            "id": 46,
            "name": "Louis Faivre",
            "points": "9"
        },
        {
            "id": 58,
            "name": "Jacques Peltier",
            "points": "9"
        },
        {
            "id": 60,
            "name": "Guy Baron",
            "points": "9"
        },
        {
            "id": 61,
            "name": "Alix Mahe",
            "points": "9"
        },
        {
            "id": 68,
            "name": "Gabrielle Becker",
            "points": "9"
        },
        {
            "id": 71,
            "name": "Joseph Vidal",
            "points": "9"
        },
        {
            "id": 86,
            "name": "Antoine Guibert",
            "points": "9"
        },
        {
            "id": 90,
            "name": "\u00c9mile Rodriguez",
            "points": "9"
        },
        {
            "id": 99,
            "name": "Susanne Thibault",
            "points": "9"
        },
        {
            "id": 1,
            "name": "Raymond Berger",
            "points": "8"
        },
        {
            "id": 49,
            "name": "\u00c9milie Launay",
            "points": "8"
        },
        {
            "id": 50,
            "name": "Roland Gomez",
            "points": "8"
        },
        {
            "id": 62,
            "name": "Beno\u00eet Diallo",
            "points": "8"
        },
        {
            "id": 63,
            "name": "Beno\u00eet Peltier",
            "points": "8"
        },
        {
            "id": 66,
            "name": "Margaud Roger",
            "points": "8"
        },
        {
            "id": 67,
            "name": "Marguerite Briand",
            "points": "8"
        },
        {
            "id": 69,
            "name": "Ren\u00e9 Bonneau",
            "points": "8"
        },
        {
            "id": 72,
            "name": "In\u00e8s Girard",
            "points": "8"
        },
        {
            "id": 82,
            "name": "Mathilde Delaunay",
            "points": "8"
        },
        {
            "id": 13,
            "name": "Philippine Fernandes",
            "points": "7"
        },
        {
            "id": 28,
            "name": "Charlotte Vincent",
            "points": "7"
        },
        {
            "id": 29,
            "name": "Christelle Martineau",
            "points": "7"
        },
        {
            "id": 37,
            "name": "Tristan Thomas",
            "points": "7"
        },
        {
            "id": 40,
            "name": "Gilbert Bigot",
            "points": "7"
        },
        {
            "id": 70,
            "name": "No\u00e9mi Jacquot",
            "points": "7"
        },
        {
            "id": 73,
            "name": "Juliette Rey",
            "points": "7"
        },
        {
            "id": 78,
            "name": "Michelle Leroux",
            "points": "7"
        },
        {
            "id": 80,
            "name": "Aurore Moreau",
            "points": "7"
        },
        {
            "id": 88,
            "name": "Adrien Gauthier",
            "points": "7"
        },
        {
            "id": 92,
            "name": "Adrien Maillard",
            "points": "7"
        },
        {
            "id": 100,
            "name": "David Maillot",
            "points": "7"
        },
        {
            "id": 5,
            "name": "Claude Loiseau",
            "points": "6"
        },
        {
            "id": 8,
            "name": "Mathilde Weber",
            "points": "6"
        },
        {
            "id": 20,
            "name": "S\u00e9bastien Legros",
            "points": "6"
        },
        {
            "id": 32,
            "name": "Claude Lelievre",
            "points": "6"
        },
        {
            "id": 41,
            "name": "Guillaume Courtois",
            "points": "6"
        },
        {
            "id": 42,
            "name": "Alexandre Roux",
            "points": "6"
        },
        {
            "id": 53,
            "name": "Adrien Jacquot",
            "points": "6"
        },
        {
            "id": 64,
            "name": "Timoth\u00e9e Valentin",
            "points": "6"
        },
        {
            "id": 74,
            "name": "Pierre Dijoux",
            "points": "6"
        },
        {
            "id": 84,
            "name": "Christine Charrier",
            "points": "6"
        },
        {
            "id": 98,
            "name": "Fr\u00e9d\u00e9rique Allain",
            "points": "6"
        },
        {
            "id": 2,
            "name": "David Daniel",
            "points": "5"
        },
        {
            "id": 4,
            "name": "Patricia Chauvin",
            "points": "5"
        },
        {
            "id": 36,
            "name": "\u00c9l\u00e9onore Leduc",
            "points": "5"
        },
        {
            "id": 38,
            "name": "P\u00e9n\u00e9lope Gay",
            "points": "5"
        },
        {
            "id": 25,
            "name": "Alfred Olivier",
            "points": "4"
        },
        {
            "id": 81,
            "name": "Joseph Albert",
            "points": "4"
        },
        {
            "id": 85,
            "name": "Nicolas Petitjean",
            "points": "4"
        },
        {
            "id": 3,
            "name": "Anne Besson",
            "points": 0
        },
        {
            "id": 6,
            "name": "Gilles Dupre",
            "points": 0
        },
        {
            "id": 7,
            "name": "Henri Perez",
            "points": 0
        }
    ]
}
```

#### Erreur

- code : 404
- contenu : 
```json
{
    "message": "No members found"
}
```

## Avoir le top 3 des utilisateurs

### Requête

| URL                | Method |
|:-------------------| :--- |
| /api/challenge/top | GET |

### Réponse

#### Succès

- code : **200**
- contenu :
```json
{
    "data": [
        {
            "id": 216,
            "name": "Ad\u00e9la\u00efde Gautier",
            "points": "11"
        },
        {
            "id": 264,
            "name": "Lorraine Fournier",
            "points": "11"
        },
        {
            "id": 22,
            "name": "Philippe Pages",
            "points": "10"
        }
    ]
}
```

#### Erreur

- code : 404
- contenu :
```json
{
    "message": "No members found"
}
```
