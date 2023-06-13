# Before using ``php artisan serve`` after first usage

1. Execute ``composer install``
2. Clear cache ``php artisan cache:clear`` and config ``php artisan config:clear``
3. Rename ``.env.example`` to ``.env``, configure db access
4. Generate Laravel API Key with ``php artisan key:generate``

## Api documentation

### product
- GET `/api/product` - get all products
```{
    "data": [
        {
            "id": 3,
            "product_type": "CharcutFromage",
            "products": [
                {
                    "id": 6,
                    "name": "charcuterie",
                    "title": "charcuterie",
                    "price": "4.40",
                    "color": "#e1a7a2"
                },
                {
                    "id": 7,
                    "name": "fromage",
                    "title": "fromage",
                    "price": "3.00",
                    "color": "#1516f9"
                }
            ]
        },
        {
            "id": 1,
            "product_type": "Midi",
            "products": [
                {
                    "id": 4,
                    "name": "pizza",
                    "title": "pizza",
                    "price": "2.60",
                    "color": "#31b252"
                },
                {
                    "id": 5,
                    "name": "sandwich",
                    "title": "sandwich",
                    "price": "2.00",
                    "color": "#fc4665"
                }
            ]
        },
        {
            "id": 4,
            "product_type": "Oeno",
            "products": [
                {
                    "id": 8,
                    "name": "bordeaux",
                    "title": "bordeaux",
                    "price": "1.60",
                    "color": "#0c55ef"
                }
            ]
        },
        {
            "id": 5,
            "product_type": "Shots",
            "products": [
                {
                    "id": 10,
                    "name": "metre",
                    "title": "metre",
                    "price": "1.20",
                    "color": "#463fbf"
                }
            ]
        },
        {
            "id": 2,
            "product_type": "Soir\u00e9e",
            "products": [
                {
                    "id": 1,
                    "name": "cocktail12",
                    "title": "cocktail12",
                    "price": "1.20",
                    "color": "#ba70c9"
                },
                {
                    "id": 2,
                    "name": "cocktail16",
                    "title": "cocktail16",
                    "price": "1.60",
                    "color": "#b9def2"
                },
            ]
        }
    ]
}
```
## productType
- GET `/api/productType` - get all product types
```
{
    "data": [
        {
            "id": 1,
            "product_type": "Midi"
        },
        {
            "id": 2,
            "product_type": "Soir\u00e9e"
        },
        {
            "id": 3,
            "product_type": "CharcutFromage"
        },
        {
            "id": 4,
            "product_type": "Oeno"
        },
        {
            "id": 5,
            "product_type": "Shots"
        }
    ]
}
```
## Organization 
- GET `api/organization` - get all organizations order by club 
or association with not all the data 
```
{
    "data": {
        "associations": [
            {
                "id": 1,
                "acronym": "dicta",
                "name": "Poirier",
                "logo_link": "http:\/\/fernandez.fr\/voluptatibus-vitae-voluptate-ex-nemo-et.html"
            },
            {
                "id": 4,
                "acronym": "voluptatem",
                "name": "Rossi Laporte S.A.S.",
                "logo_link": "https:\/\/www.blin.fr\/nulla-dolorum-est-harum-et-quasi-vel"
            },
            {
                "id": 5,
                "acronym": "aperiam",
                "name": "Lefort et Fils",
                "logo_link": "http:\/\/www.legros.fr\/sit-sed-quae-unde-soluta-rerum"
            },
            {
                "id": 7,
                "acronym": "excepturi",
                "name": "Da Silva",
                "logo_link": "http:\/\/vincent.fr\/et-non-error-natus-cupiditate-aut.html"
            },
            {
                "id": 9,
                "acronym": "modi",
                "name": "Blanchard",
                "logo_link": "http:\/\/deoliveira.com\/pariatur-unde-qui-deleniti-aut-sunt-totam"
            },
            {
                "id": 10,
                "acronym": "consequatur",
                "name": "Mallet Morel et Fils",
                "logo_link": "http:\/\/www.morin.fr\/"
            }
        ],
        "clubs": [
            {
                "id": 2,
                "acronym": "minima",
                "name": "Bodin S.A.R.L.",
                "logo_link": "https:\/\/www.alves.fr\/recusandae-aliquam-ut-nam-culpa"
            },
            {
                "id": 3,
                "acronym": "quae",
                "name": "Pasquier",
                "logo_link": "http:\/\/marin.net\/velit-assumenda-praesentium-et-soluta-ut-eius.html"
            },
            {
                "id": 6,
                "acronym": "voluptas",
                "name": "Laporte Leroux SAS",
                "logo_link": "http:\/\/www.klein.fr\/"
            },
            {
                "id": 8,
                "acronym": "nihil",
                "name": "De Sousa Chretien S.A.",
                "logo_link": "http:\/\/albert.fr\/soluta-optio-dolores-eum-mollitia"
            }
        ]
    }
}
```

- GET `api/organization/{id}` - get all data of an organization by his id

```
{
    "data": {
        "id": 1,
        "acronym": "dicta",
        "name": "Poirier",
        "description": "Officiis sequi et adipisci dignissimos mollitia quidem voluptatem vero. Repellat nulla aut error in repudiandae perferendis reiciendis ea.",
        "website_link": "http:\/\/dasilva.fr\/",
        "facebook_link": "http:\/\/dossantos.fr\/qui-praesentium-aut-corrupti-occaecati-veritatis-ex-vitae",
        "twitter_link": "http:\/\/gomes.fr\/",
        "instagram_link": "http:\/\/www.moreno.com\/veritatis-consequuntur-illo-ut-suscipit-nesciunt-quam",
        "discord_link": "https:\/\/www.regnier.fr\/qui-alias-velit-repellendus-nobis-rerum",
        "logo_link": "http:\/\/fernandez.fr\/voluptatibus-vitae-voluptate-ex-nemo-et.html",
        "email": "leon22@example.net",
        "association": 1
    }
}
```

## fouaille

- GET api/fouaille/{id}` - get all data of a fouaille acount by 
the member id
>There is also a pagination system with the parameter `page` and `per_page` to define the number of data per page
>and the page number
```
{
    "data": {
        "balance": "85.25",
        "first_name": "Michel",
        "last_name": "Chartier",
        "nickname": "pruvost.claudine",
        "orders": [
            {
                "date": "2023-06-13 04:09:04",
                "total_price": "-3.20",
                "amount": 2,
                "product": {
                    "name": "cocktail16",
                    "title": null,
                    "unit_price": "-1.6",
                    "color": "#b9def2"
                }
            },
            {
                "date": "2023-06-12 07:31:08",
                "total_price": "-3.20",
                "amount": 2,
                "product": {
                    "name": "cocktail16",
                    "title": null,
                    "unit_price": "-1.6",
                    "color": "#b9def2"
                }
            },
            {
                "date": "2023-06-09 17:29:22",
                "total_price": "-2.60",
                "amount": 1,
                "product": {
                    "name": "pizza",
                    "title": null,
                    "unit_price": "-2.6",
                    "color": "#31b252"
                }
            },
            {
                "date": "2023-06-09 05:46:49",
                "total_price": "-13.00",
                "amount": 5,
                "product": {
                    "name": "pizza",
                    "title": null,
                    "unit_price": "-2.6",
                    "color": "#31b252"
                }
            },
            {
                "date": "2023-06-08 07:59:44",
                "total_price": "-4.80",
                "amount": 3,
                "product": {
                    "name": "cocktail16",
                    "title": null,
                    "unit_price": "-1.6",
                    "color": "#b9def2"
                }
            },
            {
                "date": "2023-06-08 02:59:36",
                "total_price": "-22.00",
                "amount": 5,
                "product": {
                    "name": "charcuterie",
                    "title": null,
                    "unit_price": "-4.4",
                    "color": "#e1a7a2"
                }
            },
            {
                "date": "2023-06-07 23:02:33",
                "total_price": "-4.80",
                "amount": 4,
                "product": {
                    "name": "meteor",
                    "title": null,
                    "unit_price": "-1.2",
                    "color": "#ad1cf5"
                }
            },
            {
                "date": "2023-06-05 16:09:11",
                "total_price": "-8.00",
                "amount": 5,
                "product": {
                    "name": "bordeaux",
                    "title": null,
                    "unit_price": "-1.6",
                    "color": "#0c55ef"
                }
            },
            {
                "date": "2023-06-04 03:07:52",
                "total_price": "-10.00",
                "amount": 5,
                "product": {
                    "name": "sandwich",
                    "title": null,
                    "unit_price": "-2",
                    "color": "#fc4665"
                }
            }
        ],
        "meta": {
            "total": 9,
            "per_page": 10,
            "current_page": 1,
            "last_page": 1,
            "first_page_url": "https:\/\/bde-pprd.its-tps.fr\/api\/fouaille\/1?page=1",
            "last_page_url": "https:\/\/bde-pprd.its-tps.fr\/api\/fouaille\/1?page=1",
            "next_page_url": null,
            "prev_page_url": null,
            "path": "https:\/\/bde-pprd.its-tps.fr\/api\/fouaille\/1",
            "from": 1,
            "to": 9
        }
    }
}
```
## database structure
The database is composed of 6 tables :
- `members` store all informations about the members
- `orders` store all orders made by the members
- `products` store all products available
- `product_types` store all types of products available
- `organizations` store all organizations 
- `organization_members` store all members of an organization

#### Members
```sql
create table members
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    last_name VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    nickname VARCHAR(50),
    card_number BIGINT UNIQUE,
    email VARCHAR(50) UNIQUE NOT NULL,
    phone_number VARCHAR(50) UNIQUE,
    balance DECIMAL(10,2),
    admin INT DEFAULT 0 NOT NULL,
    contributor INT DEFAULT 1 NOT NULL,
    created_at DATETIME DEFAULT NOW() NOT NULL,
    class INT,
    
    CONSTRAINT CHECK_BOOL_ADMIN CHECK (admin IN (0, 1)),
    CONSTRAINT CHECK_BOOL_CONTRIBUTOR CHECK (admin IN (0, 1))	           
)engine = innodb;
```
|id|last_name|first_name|nickname|card_number|email|phone_number|balance|admin|contributor|created_at|class|
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
|int(11)|varchar(50)|varchar(50)|varchar(50)|bigint(20)|varchar(50)|varchar(50)|decimal(10,2)|tinyint(1)|tinyint(1)|datetime|smallint(6)|

#### Orders
```sql
create table orders
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    member_id INT,
    price DECIMAL(10,2),
    amount INT,
    date DATETIME DEFAULT NOW() NOT NULL,
    
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL,
    FOREIGN KEY (membre_id) REFERENCES members(id) ON DELETE SET NULL
)engine = innodb;
```

|id| product_id | membre_id |price|amount|date|
|:---:|:----------:|:---------:|:---:|:---:|:---:|
|int(11)|  int(11)   |  int(11)  |decimal(10,2)|int(11)|datetime|

#### Products
```sql
create table products
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL,
    title VARCHAR(25) UNIQUE NOT NULL,
    price DECIMAL(10,2) DEFAULT 0,
    product_type_id INT,
    color VARCHAR(7),
    
    FOREIGN KEY (product_type_id) REFERENCES product_types(id) ON DELETE SET NULL
)engine = innodb;
```

|id|name|    title    |price|id_product_type|color|
|:---:|:---:|:-----------:|:---:|:---:|:---:|
|int(11)|varchar(50)| varchar(25) |decimal(10,2)|int(11)|varchar(7)|

#### Product types
```sql
create table product_types
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    type VARCHAR(50) UNIQUE NOT NULL      
)engine = innodb;
```

|id|type|
|:---:|:---:|
|int(11)|varchar(50)|

#### Organizations
```sql
create table organizations
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    acronym VARCHAR(50) UNIQUE,
    name VARCHAR(50) UNIQUE NOT NULL,
    description VARCHAR(50),
    website_link VARCHAR(50),
    facebook_link VARCHAR(50),
    twitter_link VARCHAR(50),
    instagram_link VARCHAR(50),
    discord_link VARCHAR(50),
    logo_link VARCHAR(50),
    email VARCHAR(50),
    association INT DEFAULT 0 NOT NULL,
    
    CONSTRAINT CHECK_BOOL_ASSOCIATION CHECK (association IN (0, 1))	  
)engine = innodb;
```

|id|acronym|name|description|website_link|facebook_link|twitter_link|instagram_link|discord_link|logo_link|email|association|
|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|:---:|
|int(11)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|varchar(50)|tinyint(1)|

#### Organization members
```sql
create table organization_members
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    role VARCHAR(50),
    member_id INT,
    organization_id INT,

    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE,
    FOREIGN KEY (organization_id) REFERENCES organizations(id) ON DELETE CASCADE
)engine = innodb;
```

|id|role|member_id|organization_id| 
|:---:|:---:|:---:|:---:|
|int(11)|varchar(50)|int(11)|int(11)|

