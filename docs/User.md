### Registration

`POST` `api/register`

##### Body
```json
{
    "name": "user",
    "email": "user@user.com",
    "password": "password",
    "password_confirmation": "password"
}
```
##### Response
```json
{
    "data": {
        "id": 1
    }
}
```
201 Created

### Login

`POST` `api/login`

##### Body
```json
{
    "email": "user@user.com",
    "password": "password",
    "password_confirmation": "password"
}
```
##### Response
```json
{
    "data": {
        "token": "token"
    }
}
```
200 OK

### Get info

`POST` `api/me`

##### Response
```json
{
    "data": {
        "id": 2,
        "name": "admin",
        "email": "admin1@admin.com"
    }
}
```
200 OK

### Get user's books

`GET` `api/favorite-books`

##### Headers
`Authorization: Bearer {token}`

##### Response
```json
{
    "data": [
        {
            "id": 1,
            "name": "NAME",
            "desc": "DESC",
            "author_id": 1,
            "image": "http://smartdata.test/images/r74vcJ4z6FT510De.jpg"
        }
    ]
}
```
200 OK

### Logout
`POST` `api/logout`

##### Headers
`Authorization: Bearer {token}`

##### Response
```json
{
    "data": {
        "status": "ok"
    }
}
```
200 OK
