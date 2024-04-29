# Reservation Handler API

This API allows users to authenticate and manage reservations.

## POST /api/reservations

Create a new reservation
```
{
    "reservation_code": "asdf-sgsd",
    "customer_name": "asdfsdbsd",
    "customer_email": "chamithlkml@gmail.com",
    "arrival_time": "2024-06-02 00:00:00",
    "departure_time": "2024-05-02 00:00:00",
    "payment_status": "pending"
}
```

## GET /api/reservations

Returns reservations with a pagination

# GET /api/reservations/:id

Returns a single reservation

# PUT /api/reservations/:id

Update an existing reservation
```
{
    "customer_name": "asdfsdbsd",
    "customer_email": "chamithlkml@gmail.com",
    "arrival_time": "2024-06-02 00:00:00",
    "departure_time": "2024-05-02 00:00:00",
    "payment_status": "pending"
}
```