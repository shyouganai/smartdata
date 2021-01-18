### Get authors
`GET` `api/authors`

##### Response
```json
{
    "data": [
        {
            "id": 1,
            "name": "NAME",
            "bio": "BIO",
            "image": "http://link.to/images/Zfz92sTz5YlS6BOy.jpg",
            "birth_date": "2020-01-01",
            "died_date": "..."
        }
    ]
}
```
200 OK

### Get author
`GET` `api/authors/{author_id}`

##### Response
```json
{
    "data": {
        "id": 1,
        "name": "NAME",
        "bio": "BIO",
        "image": "http://link.to/images/Zfz92sTz5YlS6BOy.jpg",
        "birth_date": "2020-01-01",
        "died_date": "..."
    }
}
```
200 OK

### Get author's books
`GET` `api/authors/{author_id}/books`

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

### Create author
`POST` `api/authors`

##### Headers
`Authorization: Bearer {token}`

##### Body
```json
{
    "name": "Author",
    "bio": "BIO",
    "birth_date": "2020-01-01"
}
```

##### Response
```json
{
    "data": {
        "id": 1,
        "name": "Author",
        "bio": "BIO",
        "image": null,
        "birth_date": "2020-01-01",
        "died_date": "..."
    }
}
```
201 Created

### Update author
`PATCH` `api/authors/{author_id}`

##### Headers
`Authorization: Bearer {token}`

##### Body
```json
{
    "name": "Author",
    "bio": "BIO UPDATED",
    "birth_date": "2020-01-01"
}
```

##### Response
```json
{
    "data": {
        "id": 1,
        "name": "Author",
        "bio": "BIO UPDATED",
        "image": null,
        "birth_date": "2020-01-01",
        "died_date": "..."
    }
}
```
200 OK

### Delete author
`DELETE` `api/authors/{author_id}`

##### Headers
`Authorization: Bearer {token}`

##### Response
204 No Content

### Upload image
`POST` `api/authors/{author_id}/upload-image`

##### Headers
`Authorization: Bearer {token}`

##### Body (multipart/form-data)
`file: File`

##### Response
```json
{
    "data": {
        "image": "http://smartdata.test/images/mNgUfCF8bN9mOkC0.jpg"
    }
}
```
