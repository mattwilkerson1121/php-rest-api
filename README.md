# php-rest-api
Simple RESTful (CRUD) API with PHP and MySQL to manage custom Make It You Swatches. No authentification for this simple example, but does contain custom error handeling.
If you are using this as inspiration for your own project you will need to update the database connection credentials, db/table names, column names, data types, and variables to match your data in the Database.php, ProductController, and ProductGateway php files.

| METHOD       | URL          | ACTION |
|--------------|--------------|--------|
| GET          | /{path}      | list   |
| GET          | /{path}/{id} | show   |
| POST         | /{path}      | create |
| PUT or PATCH | /{path}/{id} | update |
| DELETE       | /{path}/{id} | delete |

JSON Responses

- POST .../{path}/swatches
{
    "message": "Swatch {id} created",
    "rows": 1
}

- GET (single swatch by id) .../{path}/swatches/{id}
{
    "attributes": "attributes|attributes|attributes",
    "cleancode": "X",
    "color": "color",
    "description": "Text paragraph for description",
    "eco_order": 0,
    "fabric": "chenille",
    "id": 74,
    "image": "image-path.jpg",
    "is_available": true,
    "is_eco": "0",
    "name": "Fabric Name",
    "sort_order": 99
}

-GET (swatch list) .../{path}/swatches
[
  ...
  
  {
    "attributes": "Available in select collections and pieces|A smooth, sleek feel|100&#37; Top&#8208;grain Italian Leather|Care Instructions: X. Clean it often using the driest method possible. In most cases, a soft vacuum brush or dry cloth works great! For light stains, grab a soft cloth, dampen it lightly with water, and use it to gently dust the affected area. Tip: Stay away from solvent cleaners.",
        "cleancode": "X",
        "color": "gray",
        "description": "Say hello to top&#8208;tier Italian leather of the highest quality. Incredibly luxurious, breathable and buttery soft.<br><br>Our 100% top&#8208;grain full&#8208;analine leathers come from carefully selected hides&mdash;free of imperfections&mdash;then dyed to enhance natural beauty. Develops character over time with a lived&#8208;in, vintage look. Sustainably sourced and produced without toxic tanning agents and using water&#8208;and energy&#8208;saving methods. ",
        "eco_order": 0,
        "fabric": "Full-Analine Leather",
        "id": 72,
        "image": "https://d13h4k5rfgad5r.cloudfront.net/image/022300374128/image_7eoi2i38953dbfna8r8deao01a/-B540-FJPG%2CQ40",
        "is_available": true,
        "is_eco": "0",
        "name": "Bruno Canyon",
        "sort_order": 86
    },
    {
        "attributes": "attributes|attributes|attributes",
        "cleancode": "X",
        "color": "color",
        "description": "Text paragraph for description",
        "eco_order": 0,
        "fabric": "chenille",
        "id": 74,
        "image": "image-path.jpg",
        "is_available": true,
        "is_eco": "0",
        "name": "Fabric Name",
        "sort_order": 99
    },
  ...
]

- DELETE .../{path}/swatches/{id}
{
    "message": "Swatch {id} deleted",
    "rows": 1
}

