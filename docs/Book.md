### Get books
`GET` `api/books`

##### Response
```json
{
    "data": [
        {
            "id": 1,
            "name": "admin",
            "desc": "DESC",
            "author_id": 1,
            "image": "http://smartdata.test/images/r74vcJ4z6FT510De.jpg"
        }
    ]
}
```
200 OK

### Get book
`GET` `api/books/{book_id}`

##### Response
```json
{
    "data": {
        "id": 1,
        "name": "admin",
        "desc": "DESC",
        "author_id": 1,
        "image": "http://smartdata.test/images/r74vcJ4z6FT510De.jpg"
    }
}
```
200 OK

### Create book
`POST` `api/books`

##### Headers
`Authorization: Bearer {token}`

##### Body
```json
{
    "name": "Book",
    "author_id": 1,
    "desc": "DESC",
    "publication_date": "2020-01-01"
}
```

##### Response
```json
{
    "data": {
        "id": 2,
        "name": "Author",
        "desc": "DESC",
        "author_id": 1,
        "image": null
    }
}
```
201 Created

### Update book
`PATCH` `api/books/{book_id}`

##### Headers
`Authorization: Bearer {token}`

##### Body
```json
{
    "name": "Book",
    "author_id": 1,
    "desc": "DESC123",
    "publication_date": "2020-01-01"
}
```

##### Response
```json
{
    "data": {
        "id": 2,
        "name": "Author",
        "desc": "DESC123",
        "author_id": 1,
        "image": null
    }
}
```
200 OK

### Delete book
`DELETE` `api/books/{book_id}`

##### Headers
`Authorization: Bearer {token}`

##### Response
204 No Content

### Add to favorites
`POST` `api/books/{book_id}/add-to-favorites`

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

### Remove from favorites
`POST` `api/books/{book_id}/remove-from-favorites`

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

### Upload image
`POST` `api/books/{book_id}/upload-image`

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
