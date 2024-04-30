# Reservation Handler API

This API allows users to authenticate and manage reservations.

## POST /api/auth/register

Creates a new user and returns auth tokens
### Request Header

```
Accept:application/json
```

### Request body

```
{
    "name": "Phillers",
    "email": "usessrseven@gmail.com",
    "password": "1q2w3e4r5t6y78u"
}
```
### Response

```
{
    "id": 3,
    "name": "Phillers",
    "email": "usessrseven@gmail.com",
    "auth_token": "2|RKKQmBPYUsAH1HVpak34xxxxxxxxxxxxxx"
}
```
## POST /api/reservations

Create a new reservation

### Request Headers

```
Accept:application/json
Authorization:Bearer 2|RKKQmBPYUsAH1HVpak34IcJ5gfex5SkH4ldyTYAZ8c368ead
```

### Request body
```
{
    "customer_name": "Ruzzel Peters",
    "customer_email": "ruzzel@gmail.com",
    "arrival_time": "2024-06-02 00:00:00",
    "departure_time": "2024-05-02 00:00:00",
}
```
### Response

```
{
    "customer_name": "Ruzzel Peters",
    "customer_email": "ruzzel@gmail.com",
    "arrival_time": "2024-06-02 00:00:00",
    "departure_time": "2024-05-02 00:00:00",
    "reservation_code": "6630fe907fa7c",
    "payment_status": "pending",
    "updated_at": "2024-04-30T14:22:08.000000Z",
    "created_at": "2024-04-30T14:22:08.000000Z",
    "id": 46
}
```


## GET /api/reservations

Returns reservations with a pagination

### Request Headers

```
Accept:application/json
Authorization:Bearer 2|RKKQmBPYUsAH1HVpak34IcJ5gfex5SkH4ldyTYAZ8c368ead
```

### Response 
```
{
    "current_page": 1,
    "data": [
        {
            "id": 16,
            "reservation_code": "aglks-lskwkgu",
            "customer_name": "asdfsdbsd",
            "customer_email": "chamithlkml@gmail.com",
            "arrival_time": "2024-06-02 00:00:00",
            "departure_time": "2024-05-02 00:00:00",
            "payment_status": "paid",
            "created_at": "2024-04-30T09:09:47.000000Z",
            "updated_at": "2024-04-30T09:09:47.000000Z"
        },
        ...
    "next_page_url": "http://localhost/api/reservations?page=2",
    "path": "http://localhost/api/reservations",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 16    
```

# GET /api/reservations/:id

Returns a single reservation

### Request Headers

```
Accept:application/json
Authorization:Bearer 2|RKKQmBPYUsAH1HVpak34IcJ5gfex5SkH4ldyTYAZ8c368ead
```
### Response

```
{
    "id": 11,
    "reservation_code": "rverv",
    "customer_name": "asdfsdbsd",
    "customer_email": "chamithlkml@gmail.com",
    "arrival_time": "2024-06-02 00:00:00",
    "departure_time": "2024-05-02 00:00:00",
    "payment_status": "paid",
    "created_at": "2024-04-29T13:17:11.000000Z",
    "updated_at": "2024-04-29T13:31:30.000000Z"
}
```

# PUT /api/reservations/:id

Update an existing reservation

### Request Headers
```
Accept:application/json
Authorization:Bearer 2|RKKQmBPYUsAH1HVpak34IcJ5gfex5SkH4ldyTYAZ8c368ead
```


### Request body
```
{
    "payment_status": "paid"
}
```

### Response
```
{
    "id": 31,
    "reservation_code": "6630f8f6e867e",
    "customer_name": "Kanmani",
    "customer_email": "Kanan@gmail.com",
    "arrival_time": "2024-07-02 00:00:00",
    "departure_time": "2024-08-02 00:00:00",
    "payment_status": "paid",
    "created_at": "2024-04-30T13:58:14.000000Z",
    "updated_at": "2024-04-30T13:58:23.000000Z"
}
```

## Run tests

- SSH to Laravel container
- `cd /var/www`
- `php artisan test` 