# Nested Set Model
Basic php api to handle Nested set models

## Setup
This project uses docker and creates 4 containers:
- MariaDB
- Apache
- Composer
- PhpMyAdmin

To build the environment on IOS (not tested on windows): <br>
```
docker compose up -d
```

## Api endpoint
```
/v1/search
```
Accepted Http method: GET<br>
Accepted variables:
- node_id (integer, required)
- language (enum, required, values [italian, english])
- search_keyword (string, optional)
- page_num (integer, optional)
- page_size (integer, optional)

Example url:
```
http://localhost/v1/search?node_id=5&language=english&search_keyword=sa&page_num=0&page_size=100
```