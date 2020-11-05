---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Authentication


APIs for Authenticating  users
<!-- START_4b77551ffe3e806c992cdd1044012aa7 -->
## api/v1/auth/refresh
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/auth/refresh`


<!-- END_4b77551ffe3e806c992cdd1044012aa7 -->

<!-- START_3157fb6d77831463001829403e201c3e -->
## Allow Users to register for an account

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Micheale Mwangi","email":"mike@gmail.com","phone":"0701828384","Type":"Wholesaler,retailer,customer or rider","County":"Nairobi county","Password":"*******","Password_confirmation":"*******"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Micheale Mwangi",
    "email": "mike@gmail.com",
    "phone": "0701828384",
    "Type": "Wholesaler,retailer,customer or rider",
    "County": "Nairobi county",
    "Password": "*******",
    "Password_confirmation": "*******"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": "success",
    "data": {
        "name": "shem",
        "email": "customer45@gmail.com",
        "phone": "0715511302",
        "county": "uasingishu",
        "role": "customer",
        "longitude": "0.01919191",
        "latitude": "9.08888884",
        "location_name": "eldoret",
        "address": "30100",
        "updated_at": "2020-11-05T08:09:18.000000Z",
        "created_at": "2020-11-05T08:09:18.000000Z",
        "id": 16
    }
}
```

### HTTP Request
`POST api/v1/auth/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | full name of the user .
        `email` | email |  required  | email address of the user .
        `phone` | integar |  required  | phone number for the user .
        `Type` | string |  required  | the account the user intend to reqister .
        `County` | string |  required  | County residence of the user .
        `Password` | Password |  required  | user's password for authentication .
        `Password_confirmation` | Password |  required  | password for authentication .
    
<!-- END_3157fb6d77831463001829403e201c3e -->

<!-- START_2be1f0e022faf424f18f30275e61416e -->
## Allow registered users to login

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"mike@gmail.com","Password":"*******"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "mike@gmail.com",
    "Password": "*******"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/v1/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | email address of the user .
        `Password` | Password |  required  | user's password for authentication .
    
<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_cecc6addd124e6fe5e2ad86b63a75e8f -->
## Create a new Rider&#039;s account

[Insert optional longer description of the API endpoint here.]

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/createRider" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/createRider"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/createRider`


<!-- END_cecc6addd124e6fe5e2ad86b63a75e8f -->

<!-- START_59e7a3dd6cc4cb996202d9fa7fa4462c -->
## Verifying Rider&#039;s account

[Insert optional longer description of the API endpoint here.]

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/verify_phone" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/verify_phone"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/verify_phone`


<!-- END_59e7a3dd6cc4cb996202d9fa7fa4462c -->

<!-- START_24ffe6748e96554e6051bda8032cf066 -->
## Login function of rider

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/loginRider" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"Phone":"0715929293","Password":"********"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/loginRider"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "Phone": "0715929293",
    "Password": "********"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/v1/auth/loginRider`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `Phone` | Phone |  required  | phone of the Rider .
        `Password` | Password |  required  | email address of the user .
    
<!-- END_24ffe6748e96554e6051bda8032cf066 -->

<!-- START_5ae0041739de5cb32000d7488deef7cb -->
## Allows a rider to reset passwod

[Insert optional longer description of the API endpoint here.]

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/resetPasswordRider" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/resetPasswordRider"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/resetPasswordRider`


<!-- END_5ae0041739de5cb32000d7488deef7cb -->

<!-- START_e6a1bcf719922618f322e8c0e5e6caac -->
## api/v1/auth/user
<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/auth/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/auth/user`


<!-- END_e6a1bcf719922618f322e8c0e5e6caac -->

<!-- START_a68ff660ea3d08198e527df659b17963 -->
## Allow authenticated users to log out

[Insert optional longer description of the API endpoint here.]

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->

#Brands


APIs for Managing Brands
<!-- START_00d9b13be2e54c41de666e7a9422c3d6 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/brands`


<!-- END_00d9b13be2e54c41de666e7a9422c3d6 -->

<!-- START_acca30f4e5fa68c12cec3961460ff188 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/brands`


<!-- END_acca30f4e5fa68c12cec3961460ff188 -->

<!-- START_771f9cb61cade8c1013fa3882a1d4190 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/brands/{brand}`


<!-- END_771f9cb61cade8c1013fa3882a1d4190 -->

<!-- START_d4a97c3797feacc0faeaf87f7608781b -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/shopLocal/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/shopLocal/brands/{brand}`

`PATCH api/v1/admin/shopLocal/brands/{brand}`


<!-- END_d4a97c3797feacc0faeaf87f7608781b -->

<!-- START_e8b73d3396a5b004fd6f385059c3cca8 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/brands/{brand}`


<!-- END_e8b73d3396a5b004fd6f385059c3cca8 -->

<!-- START_23454d236c9b5e1a2a31c8abdef23d26 -->
## api/v1/admin/shopLocal/my-brands/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/my-brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/my-brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/my-brands/{id}`


<!-- END_23454d236c9b5e1a2a31c8abdef23d26 -->

<!-- START_ae9b82369acd140f20e32330006013e9 -->
## api/v1/retailer/dashboard/my-brands/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/my-brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/my-brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/my-brands/{id}`


<!-- END_ae9b82369acd140f20e32330006013e9 -->

<!-- START_255d7c8a2861a33dc63165dfd45e6255 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/brands`


<!-- END_255d7c8a2861a33dc63165dfd45e6255 -->

<!-- START_7b1fdcded93bf6d42d5250b96d6aabb3 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/brands`


<!-- END_7b1fdcded93bf6d42d5250b96d6aabb3 -->

<!-- START_2e78534ab5f68213847af070b167877b -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/brands/{brand}`


<!-- END_2e78534ab5f68213847af070b167877b -->

<!-- START_8d8e520d714d8c56871eb48ee6753026 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/retailer/dashboard/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/retailer/dashboard/brands/{brand}`

`PATCH api/v1/retailer/dashboard/brands/{brand}`


<!-- END_8d8e520d714d8c56871eb48ee6753026 -->

<!-- START_977e598d71209f06924115dd96378f94 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/retailer/dashboard/brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/retailer/dashboard/brands/{brand}`


<!-- END_977e598d71209f06924115dd96378f94 -->

#Coupons


APIs for Managing Coupons
<!-- START_e1ff6b5a935fb79d008a7b4f11254e22 -->
## api/v1/shopLocal/apply-coupon
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/apply-coupon" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/apply-coupon"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/apply-coupon`


<!-- END_e1ff6b5a935fb79d008a7b4f11254e22 -->

<!-- START_6bef8303ba43249227a61ec0bf21b636 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/coupon" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/coupon"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/coupon`


<!-- END_6bef8303ba43249227a61ec0bf21b636 -->

<!-- START_bc062957abdcf5838adee53078bad5fc -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/coupon" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/coupon"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/coupon`


<!-- END_bc062957abdcf5838adee53078bad5fc -->

<!-- START_d84ac1533c169693f9190ab8bc94c770 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/coupon/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/coupon/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/coupon/{coupon}`


<!-- END_d84ac1533c169693f9190ab8bc94c770 -->

<!-- START_07e9fa61e5fb557023db57cfad611ffa -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/shopLocal/coupon/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/coupon/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/shopLocal/coupon/{coupon}`

`PATCH api/v1/admin/shopLocal/coupon/{coupon}`


<!-- END_07e9fa61e5fb557023db57cfad611ffa -->

<!-- START_c23d2b0f22214c2329231112685f2f4b -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/coupon/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/coupon/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/coupon/{coupon}`


<!-- END_c23d2b0f22214c2329231112685f2f4b -->

#Customer Profile


APIs for Managing customer Profile
<!-- START_31c78d671b84fe63585101c217667573 -->
## api/v1/customer/profile/account
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/customer/profile/account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/customer/profile/account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/customer/profile/account`


<!-- END_31c78d671b84fe63585101c217667573 -->

<!-- START_a7845fe62f058b2cbdf6897c23d8a2d6 -->
## api/v1/customer/profile/location
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/customer/profile/location" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/customer/profile/location"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/customer/profile/location`


<!-- END_a7845fe62f058b2cbdf6897c23d8a2d6 -->

<!-- START_ebb81cc00e30b13f4234c2d09f92b956 -->
## api/v1/customer/profile/password
> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/customer/profile/password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/customer/profile/password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/customer/profile/password`


<!-- END_ebb81cc00e30b13f4234c2d09f92b956 -->

#Dashboard


APIs for Managing User Dashboard.
<!-- START_f68ee1e9d17777235073a3c3a71f0f56 -->
## api/v1/admin/shopLocal/sales
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/sales" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/sales"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/sales`


<!-- END_f68ee1e9d17777235073a3c3a71f0f56 -->

<!-- START_dd6367a2e8ee209f92b5c559e4ed2113 -->
## api/v1/admin/shopLocal/value
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/value" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/value"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/value`


<!-- END_dd6367a2e8ee209f92b5c559e4ed2113 -->

<!-- START_0bcf7c203a5616e36a2a14502065c744 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/dash" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/dash"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/dash`


<!-- END_0bcf7c203a5616e36a2a14502065c744 -->

<!-- START_f17a0f5fb409d4e7db0bc208e7b97566 -->
## api/v1/admin/shopLocal/visitors
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/visitors" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/visitors"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/visitors`


<!-- END_f17a0f5fb409d4e7db0bc208e7b97566 -->

<!-- START_0421a94bd3a4e200956628dd1f67bc23 -->
## api/v1/retailer/dashboard/Usersales
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/Usersales" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Usersales"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/Usersales`


<!-- END_0421a94bd3a4e200956628dd1f67bc23 -->

<!-- START_fcff48d14bb750ce4a491cc720040cc5 -->
## api/v1/retailer/dashboard/Uservalue
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/Uservalue" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Uservalue"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/Uservalue`


<!-- END_fcff48d14bb750ce4a491cc720040cc5 -->

<!-- START_f088dc95447ff4cf6e22c9812e43d899 -->
## api/v1/retailer/dashboard/Userdash
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/Userdash" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Userdash"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/Userdash`


<!-- END_f088dc95447ff4cf6e22c9812e43d899 -->

<!-- START_23bd6212ab56ad243f871ba9f8e6006e -->
## api/v1/rider/dashboard/UserDelivery
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/UserDelivery" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/UserDelivery"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/UserDelivery`


<!-- END_23bd6212ab56ad243f871ba9f8e6006e -->

<!-- START_d9517c6c359fcd71ae5fe530ea4476a4 -->
## api/v1/rider/dashboard/UserEarning
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/UserEarning" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/UserEarning"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/UserEarning`


<!-- END_d9517c6c359fcd71ae5fe530ea4476a4 -->

<!-- START_daf8b4abdd922d641161b3d89ad066f6 -->
## api/v1/rider/dashboard/Riderdash
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/Riderdash" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/Riderdash"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/Riderdash`


<!-- END_daf8b4abdd922d641161b3d89ad066f6 -->

#Delivery


APIs for Managing Delivery of Items
<!-- START_64eef5315376f30ec561d7cf7ea6e174 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/delivery/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/delivery/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/delivery/{id}`


<!-- END_64eef5315376f30ec561d7cf7ea6e174 -->

<!-- START_5219ad4bc04fb9f7c566162e23205d1c -->
## api/v1/admin/shopLocal/myRider/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/myRider/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/myRider/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/myRider/{id}`


<!-- END_5219ad4bc04fb9f7c566162e23205d1c -->

<!-- START_b8b8d2cea60007ec1c9c3e968ab1cec4 -->
## api/v1/admin/shopLocal/getShop/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/getShop/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/getShop/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/getShop/{id}`


<!-- END_b8b8d2cea60007ec1c9c3e968ab1cec4 -->

<!-- START_9c6bd7b63229e84553394126d83c2757 -->
## api/v1/admin/shopLocal/Rider/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/Rider/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/Rider/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/Rider/{id}`


<!-- END_9c6bd7b63229e84553394126d83c2757 -->

<!-- START_34525812ad6787b54a17b2c7b184365e -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/shipping" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/shipping"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/shipping`


<!-- END_34525812ad6787b54a17b2c7b184365e -->

<!-- START_b8a0f7ccc322f7d274c55e1adf6d73c9 -->
## api/v1/rider/dashboard/showShippingInfo/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/showShippingInfo/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/showShippingInfo/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/showShippingInfo/{id}`


<!-- END_b8a0f7ccc322f7d274c55e1adf6d73c9 -->

#Location Tracking


APIs for Controlling Riders Location
<!-- START_37574c0a4d051d98219095114610e252 -->
## api/v1/new_coordinates
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/new_coordinates" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/new_coordinates"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/new_coordinates`


<!-- END_37574c0a4d051d98219095114610e252 -->

#Logs


APIs for Controlling users Logs
<!-- START_ae5f199a930eaae44f10a94a71bddc0b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/logs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/logs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/logs`


<!-- END_ae5f199a930eaae44f10a94a71bddc0b -->

<!-- START_315cba1e02eea3c7910192742e1f0189 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/logs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/logs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/logs`


<!-- END_315cba1e02eea3c7910192742e1f0189 -->

<!-- START_2a2887235df209809b3bd3d982c27681 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/logs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/logs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/logs/{log}`


<!-- END_2a2887235df209809b3bd3d982c27681 -->

<!-- START_f67ee17d86ea4f9a43212d25baa55af0 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/logs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/logs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/logs/{log}`

`PATCH api/v1/admin/logs/{log}`


<!-- END_f67ee17d86ea4f9a43212d25baa55af0 -->

<!-- START_1e23fc6eb1b4557327881e0ffb255f3c -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/logs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/logs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/logs/{log}`


<!-- END_1e23fc6eb1b4557327881e0ffb255f3c -->

#Newsletter


APIs for Controlling Newsletter
<!-- START_1446b046274e118353eeb417d9cf17ee -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/newsletter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/newsletter"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/newsletter`


<!-- END_1446b046274e118353eeb417d9cf17ee -->

#Orders


APIs for Managing orders
<!-- START_0624b693aa06433eeef7c335df487882 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/order`


<!-- END_0624b693aa06433eeef7c335df487882 -->

<!-- START_7a8e828b872ba63572d30c654725efb9 -->
## api/v1/shopLocal/order
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/shopLocal/order`


<!-- END_7a8e828b872ba63572d30c654725efb9 -->

<!-- START_7e8d56829bbae56d7cd9ac36da2229d6 -->
## api/v1/shopLocal/show-details/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/show-details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/show-details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/shopLocal/show-details/{id}`


<!-- END_7e8d56829bbae56d7cd9ac36da2229d6 -->

<!-- START_09c57f222a7ff2c88fd28dae67b817a7 -->
## api/v1/shopLocal/showshipment/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/showshipment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/showshipment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/shopLocal/showshipment/{id}`


<!-- END_09c57f222a7ff2c88fd28dae67b817a7 -->

<!-- START_88b4bb74a09438bc92bb1b767b3f8a58 -->
## api/v1/shopLocal/comment/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/comment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/comment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/comment/{id}`


<!-- END_88b4bb74a09438bc92bb1b767b3f8a58 -->

<!-- START_c5c4669f8a23841feeb532c5cefea07c -->
## api/v1/shopLocal/getComments/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/getComments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/getComments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/shopLocal/getComments/{id}`


<!-- END_c5c4669f8a23841feeb532c5cefea07c -->

<!-- START_fdd4970e11ac5fa65e829820ef6f1f49 -->
## api/v1/shopLocal/rate/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/rate/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/rate/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/rate/{id}`


<!-- END_fdd4970e11ac5fa65e829820ef6f1f49 -->

<!-- START_f86cd5814bf3cb7b035bf446e1fb1c98 -->
## api/v1/shopLocal/cancel-order/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/shopLocal/cancel-order/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/cancel-order/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/shopLocal/cancel-order/{id}`


<!-- END_f86cd5814bf3cb7b035bf446e1fb1c98 -->

<!-- START_24487fa01a04a24e868a27c88a58d31b -->
## api/v1/shopLocal/pay/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/pay/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/pay/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/pay/{id}`


<!-- END_24487fa01a04a24e868a27c88a58d31b -->

<!-- START_fe8ed9aed3e610f041cafc604de9cb70 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/order`


<!-- END_fe8ed9aed3e610f041cafc604de9cb70 -->

<!-- START_2ebed169d558682d1a69363aa7c64406 -->
## api/v1/admin/shopLocal/show-details/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/show-details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/show-details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/show-details/{id}`


<!-- END_2ebed169d558682d1a69363aa7c64406 -->

<!-- START_570a8796c2af4449655483736190167f -->
## api/v1/admin/shopLocal/shipment/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/shipment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/shipment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/shipment/{id}`


<!-- END_570a8796c2af4449655483736190167f -->

<!-- START_00765fb63b5f11eb3cacb6846a8091bf -->
## api/v1/admin/shopLocal/change-status/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/admin/shopLocal/change-status/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/change-status/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/shopLocal/change-status/{id}`


<!-- END_00765fb63b5f11eb3cacb6846a8091bf -->

<!-- START_847aad67f0622a8b099ba54ca8f63719 -->
## api/v1/retailer/dashboard/myOrders
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/myOrders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/myOrders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/myOrders`


<!-- END_847aad67f0622a8b099ba54ca8f63719 -->

<!-- START_f38412eb48b4bf0bb545292287abdc9b -->
## api/v1/retailer/dashboard/order-details/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/order-details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/order-details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/order-details/{id}`


<!-- END_f38412eb48b4bf0bb545292287abdc9b -->

<!-- START_c38ba04fe9b1dcf782cd1e9d17d39df5 -->
## api/v1/retailer/dashboard/showOrderDetails/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/showOrderDetails/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/showOrderDetails/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/showOrderDetails/{id}`


<!-- END_c38ba04fe9b1dcf782cd1e9d17d39df5 -->

#Password Control


APIs for Managing password reset
<!-- START_41c40ad08033960fe2cc3dcaf77839de -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/password/email`


<!-- END_41c40ad08033960fe2cc3dcaf77839de -->

#Product


APIs for Managing Products
<!-- START_87b2f45b7723bb5ab61ccdaa064d9128 -->
## api/v1/subcat_brands/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/subcat_brands/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/subcat_brands/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "Nike",
        "sub_category_id": 1,
        "description": "Just do it",
        "created_at": "2020-08-06T13:18:36.000000Z",
        "updated_at": "2020-08-06T13:18:36.000000Z"
    },
    {
        "id": 2,
        "name": "Jordan",
        "sub_category_id": 1,
        "description": "life is good",
        "created_at": "2020-08-06T13:18:58.000000Z",
        "updated_at": "2020-08-06T13:18:58.000000Z"
    }
]
```

### HTTP Request
`GET api/v1/subcat_brands/{id}`


<!-- END_87b2f45b7723bb5ab61ccdaa064d9128 -->

<!-- START_981fcb68ef32cc7e015cd59a4641b523 -->
## api/v1/featured-products
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/featured-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/featured-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/featured-products`


<!-- END_981fcb68ef32cc7e015cd59a4641b523 -->

<!-- START_531609072f37fb0ad041ae56badcbe3b -->
## api/v1/visited
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/visited" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/visited"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/visited`


<!-- END_531609072f37fb0ad041ae56badcbe3b -->

<!-- START_0e1861059ea555bebe9b4552ae6e9834 -->
## api/v1/shopLocal/filter-products
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/filter-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/filter-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/filter-products`


<!-- END_0e1861059ea555bebe9b4552ae6e9834 -->

<!-- START_ca1721a52f1c7df697f5668e3c95186a -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/products`


<!-- END_ca1721a52f1c7df697f5668e3c95186a -->

<!-- START_1a08a4fd4c5f251027302b161a3c244c -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/products`


<!-- END_1a08a4fd4c5f251027302b161a3c244c -->

<!-- START_85f5ce043ac2e5ec5b66751786af3476 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/products/{product}`


<!-- END_85f5ce043ac2e5ec5b66751786af3476 -->

<!-- START_a47a9b9aca45e6a41a241f93b905ae4e -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/shopLocal/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/shopLocal/products/{product}`

`PATCH api/v1/admin/shopLocal/products/{product}`


<!-- END_a47a9b9aca45e6a41a241f93b905ae4e -->

<!-- START_3874b336b1d8afa54f530428bef27036 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/products/{product}`


<!-- END_3874b336b1d8afa54f530428bef27036 -->

<!-- START_bd4b3bb2ad674cf2db03d796ca5564b3 -->
## api/v1/admin/shopLocal/shop
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/shop" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/shop"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/shop`


<!-- END_bd4b3bb2ad674cf2db03d796ca5564b3 -->

<!-- START_c8099f2c10ad4f7d3a8534732a4ba331 -->
## api/v1/admin/shopLocal/brand-products/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/brand-products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/brand-products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/brand-products/{id}`


<!-- END_c8099f2c10ad4f7d3a8534732a4ba331 -->

<!-- START_25c9138ab6920bad3b33c47bd39a7b44 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/all-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/all-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/all-products`


<!-- END_25c9138ab6920bad3b33c47bd39a7b44 -->

<!-- START_24a6df21b0ae83c4cb357a3cc85a6d2c -->
## api/v1/admin/shopLocal/update-status/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/admin/shopLocal/update-status/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/update-status/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/shopLocal/update-status/{id}`


<!-- END_24a6df21b0ae83c4cb357a3cc85a6d2c -->

<!-- START_bb5cbb57056e7619913e886d859e62bf -->
## api/v1/admin/shopLocal/delete-image/{id}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/delete-image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/delete-image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/delete-image/{id}`


<!-- END_bb5cbb57056e7619913e886d859e62bf -->

<!-- START_ffd827db668aa5a6ec5cfe55618a28b5 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/delete-product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/delete-product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/delete-product/{id}`


<!-- END_ffd827db668aa5a6ec5cfe55618a28b5 -->

<!-- START_8b83a25b3bd7652b3f252c680bf55e02 -->
## api/v1/admin/shopLocal/activate-product/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/admin/shopLocal/activate-product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/activate-product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/shopLocal/activate-product/{id}`


<!-- END_8b83a25b3bd7652b3f252c680bf55e02 -->

<!-- START_75c02a4a393c43d4f2fc58aff41d248a -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/update-product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/update-product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/update-product/{id}`


<!-- END_75c02a4a393c43d4f2fc58aff41d248a -->

<!-- START_0d66108206225364a0b5263ffa6fd488 -->
## api/v1/retailer/dashboard/products
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/products`


<!-- END_0d66108206225364a0b5263ffa6fd488 -->

<!-- START_8486e44476c01dc0ba79be27c5638a99 -->
## api/v1/retailer/dashboard/all-products
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/all-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/all-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/all-products`


<!-- END_8486e44476c01dc0ba79be27c5638a99 -->

<!-- START_940751d96a7a7f7265eaa660eb0b5339 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/retailer/dashboard/delete-product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/delete-product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/retailer/dashboard/delete-product/{id}`


<!-- END_940751d96a7a7f7265eaa660eb0b5339 -->

<!-- START_f653af5f5ea1938a5d46aa0afe1c6325 -->
## api/v1/retailer/dashboard/delete-image/{id}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/retailer/dashboard/delete-image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/delete-image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/retailer/dashboard/delete-image/{id}`


<!-- END_f653af5f5ea1938a5d46aa0afe1c6325 -->

<!-- START_5b1de6723d94212485adcb53ebdae598 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/update-product/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/update-product/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/update-product/{id}`


<!-- END_5b1de6723d94212485adcb53ebdae598 -->

<!-- START_cc97daef2a3b7cbe2cfea1c45ceee1ae -->
## api/v1/retailer/dashboard/update-status/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/retailer/dashboard/update-status/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/update-status/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/retailer/dashboard/update-status/{id}`


<!-- END_cc97daef2a3b7cbe2cfea1c45ceee1ae -->

#Product Category


APIs for Managing Product Category
<!-- START_c1cb3f3f3d577a3ef5541e11ceaf04c9 -->
## api/v1/featured-category
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/featured-category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/featured-category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/featured-category`


<!-- END_c1cb3f3f3d577a3ef5541e11ceaf04c9 -->

<!-- START_b9cab9402fd3364af4a56874694c3f4a -->
## api/v1/shopLocal/categories_sub_brands
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/categories_sub_brands" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/categories_sub_brands"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 2,
        "name": "Drinks",
        "image": "1596719989.jpeg",
        "created_at": "2020-08-06T13:19:49.000000Z",
        "updated_at": "2020-08-06T13:19:49.000000Z",
        "filePath": "http:\/\/localhost\/storage\/products_category\/1596719989.jpeg",
        "sub_category": [
            {
                "id": 4,
                "name": "Smoothies",
                "product_category_id": 2,
                "created_at": "2020-08-06T13:20:10.000000Z",
                "updated_at": "2020-08-06T13:20:10.000000Z",
                "brands": [
                    {
                        "id": 3,
                        "name": "fruits2go",
                        "sub_category_id": 4,
                        "description": "bursting with natural flavour",
                        "created_at": "2020-08-06T13:21:26.000000Z",
                        "updated_at": "2020-08-06T13:21:26.000000Z"
                    }
                ]
            },
            {
                "id": 5,
                "name": "Juice",
                "product_category_id": 2,
                "created_at": "2020-08-06T13:20:32.000000Z",
                "updated_at": "2020-08-06T13:20:32.000000Z",
                "brands": [
                    {
                        "id": 4,
                        "name": "fruits2go",
                        "sub_category_id": 5,
                        "description": "bursting with natuural flavour",
                        "created_at": "2020-08-06T13:22:05.000000Z",
                        "updated_at": "2020-08-06T13:22:05.000000Z"
                    }
                ]
            }
        ]
    },
    {
        "id": 1,
        "name": "Shoes",
        "image": "1596719839.jpeg",
        "created_at": "2020-08-06T13:17:20.000000Z",
        "updated_at": "2020-08-06T13:17:20.000000Z",
        "filePath": "http:\/\/localhost\/storage\/products_category\/1596719839.jpeg",
        "sub_category": [
            {
                "id": 1,
                "name": "Men",
                "product_category_id": 1,
                "created_at": "2020-08-06T13:17:39.000000Z",
                "updated_at": "2020-08-06T13:17:39.000000Z",
                "brands": [
                    {
                        "id": 1,
                        "name": "Nike",
                        "sub_category_id": 1,
                        "description": "Just do it",
                        "created_at": "2020-08-06T13:18:36.000000Z",
                        "updated_at": "2020-08-06T13:18:36.000000Z"
                    },
                    {
                        "id": 2,
                        "name": "Jordan",
                        "sub_category_id": 1,
                        "description": "life is good",
                        "created_at": "2020-08-06T13:18:58.000000Z",
                        "updated_at": "2020-08-06T13:18:58.000000Z"
                    }
                ]
            },
            {
                "id": 2,
                "name": "women",
                "product_category_id": 1,
                "created_at": "2020-08-06T13:17:57.000000Z",
                "updated_at": "2020-08-06T13:17:57.000000Z",
                "brands": []
            },
            {
                "id": 3,
                "name": "children",
                "product_category_id": 1,
                "created_at": "2020-08-06T13:18:12.000000Z",
                "updated_at": "2020-08-06T13:18:12.000000Z",
                "brands": []
            }
        ]
    }
]
```

### HTTP Request
`GET api/v1/shopLocal/categories_sub_brands`


<!-- END_b9cab9402fd3364af4a56874694c3f4a -->

<!-- START_a3d6c60a80747fef5437edef3ba38a5b -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/category`


<!-- END_a3d6c60a80747fef5437edef3ba38a5b -->

<!-- START_2731c51a16e243dd1fb3f7c56694c404 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/category`


<!-- END_2731c51a16e243dd1fb3f7c56694c404 -->

<!-- START_464171f460a9ae1f35dab87d1667ab71 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/category/{category}`


<!-- END_464171f460a9ae1f35dab87d1667ab71 -->

<!-- START_b6a28c59e0c608312e5ad67b7e239cce -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/shopLocal/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/shopLocal/category/{category}`

`PATCH api/v1/admin/shopLocal/category/{category}`


<!-- END_b6a28c59e0c608312e5ad67b7e239cce -->

<!-- START_b38a4eb51af7faa376ad27c93011efa2 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/category/{category}`


<!-- END_b38a4eb51af7faa376ad27c93011efa2 -->

<!-- START_3b90aa4ea3d9e6c74b961124725647c1 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/category`


<!-- END_3b90aa4ea3d9e6c74b961124725647c1 -->

<!-- START_24b12be9ee2e88aab57a486d501ef3ad -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/category`


<!-- END_24b12be9ee2e88aab57a486d501ef3ad -->

<!-- START_62fd62a3336e816b2713f60cf929d0c5 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/category/{category}`


<!-- END_62fd62a3336e816b2713f60cf929d0c5 -->

<!-- START_0dd38fc739d01adfbcf5254def61e894 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/retailer/dashboard/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/retailer/dashboard/category/{category}`

`PATCH api/v1/retailer/dashboard/category/{category}`


<!-- END_0dd38fc739d01adfbcf5254def61e894 -->

<!-- START_7d592c663f6d36a6e744360f9842d64c -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/retailer/dashboard/category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/retailer/dashboard/category/{category}`


<!-- END_7d592c663f6d36a6e744360f9842d64c -->

#Product Sub_Category


APIs for Managing product Sub category
<!-- START_5ed4efb402f1e1ea14d6ae37a5bc0024 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/Subcategory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/Subcategory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/Subcategory`


<!-- END_5ed4efb402f1e1ea14d6ae37a5bc0024 -->

<!-- START_1e18a1f7b08c7e6f5b0bfeabd197a544 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/Subcategory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/Subcategory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/Subcategory`


<!-- END_1e18a1f7b08c7e6f5b0bfeabd197a544 -->

<!-- START_17853337b0fa3eca17b9101b8ef25b90 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/Subcategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/Subcategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/Subcategory/{Subcategory}`


<!-- END_17853337b0fa3eca17b9101b8ef25b90 -->

<!-- START_a4fdd965c3d22485001c833e445d9f4d -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/shopLocal/Subcategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/Subcategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/shopLocal/Subcategory/{Subcategory}`

`PATCH api/v1/admin/shopLocal/Subcategory/{Subcategory}`


<!-- END_a4fdd965c3d22485001c833e445d9f4d -->

<!-- START_5ac0076873234df1d5b6f158eecc43fb -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/shopLocal/Subcategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/Subcategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/shopLocal/Subcategory/{Subcategory}`


<!-- END_5ac0076873234df1d5b6f158eecc43fb -->

<!-- START_34cb3f36ab7f219654948c07979efbdb -->
## api/v1/admin/shopLocal/sub-category/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/sub-category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/sub-category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/sub-category/{id}`


<!-- END_34cb3f36ab7f219654948c07979efbdb -->

<!-- START_f77af6b6a09e01ecfd97cd8664dd0227 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/Subcategory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Subcategory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/Subcategory`


<!-- END_f77af6b6a09e01ecfd97cd8664dd0227 -->

<!-- START_19a5de414d23c39f189bf4925fa5d4aa -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/Subcategory" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Subcategory"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/Subcategory`


<!-- END_19a5de414d23c39f189bf4925fa5d4aa -->

<!-- START_3444936158f8eab44da740b2261659fe -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/Subcategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Subcategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/Subcategory/{Subcategory}`


<!-- END_3444936158f8eab44da740b2261659fe -->

<!-- START_09fd77e6f4a204cfcd8c00fed3ddf3d6 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/retailer/dashboard/Subcategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Subcategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/retailer/dashboard/Subcategory/{Subcategory}`

`PATCH api/v1/retailer/dashboard/Subcategory/{Subcategory}`


<!-- END_09fd77e6f4a204cfcd8c00fed3ddf3d6 -->

<!-- START_4d3e920dc0c79896ff6b52007d0c60d6 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/retailer/dashboard/Subcategory/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/Subcategory/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/retailer/dashboard/Subcategory/{Subcategory}`


<!-- END_4d3e920dc0c79896ff6b52007d0c60d6 -->

<!-- START_f87341ed7f103c299eb70459ab8203a1 -->
## api/v1/retailer/dashboard/sub-category/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/sub-category/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/sub-category/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/sub-category/{id}`


<!-- END_f87341ed7f103c299eb70459ab8203a1 -->

#Reports


APIs for Managing Reports
<!-- START_986af72451b5dddedd64785e50d465e3 -->
## api/v1/admin/shopLocal/shopping-report
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/shopLocal/shopping-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/shopping-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/shopLocal/shopping-report`


<!-- END_986af72451b5dddedd64785e50d465e3 -->

<!-- START_a3d28248ed842cfb042f8e74b4c5f25b -->
## api/v1/retailer/dashboard/shopping-report
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/shopping-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/shopping-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/shopping-report`


<!-- END_a3d28248ed842cfb042f8e74b4c5f25b -->

#ResetPasswod


APIs for managing Password Reset
<!-- START_a62f1703e9fba891a3e20ff27854aac0 -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/password/reset`


<!-- END_a62f1703e9fba891a3e20ff27854aac0 -->

#Rider


APIs for Managing Riders
<!-- START_ca186134543c266fefe2cea9c3aaa078 -->
## api/v1/rider/dashboard/rider-details/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/rider-details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/rider-details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/rider-details/{id}`


<!-- END_ca186134543c266fefe2cea9c3aaa078 -->

#Shipment


APIs for controlling shipment
<!-- START_5652bda0b6fd21702682126406b579ea -->
## api/v1/clear-shipment
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/clear-shipment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/clear-shipment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/v1/clear-shipment`


<!-- END_5652bda0b6fd21702682126406b579ea -->

<!-- START_626f3d1cafddb96fbf14b14d87db6918 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/available-shipment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/available-shipment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/available-shipment`


<!-- END_626f3d1cafddb96fbf14b14d87db6918 -->

<!-- START_12151ee862634a9f3333a5991dc3d948 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/rider-shipment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/rider-shipment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/rider-shipment/{id}`


<!-- END_12151ee862634a9f3333a5991dc3d948 -->

<!-- START_d58faef53c5d86dac75d585fa5a39faa -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/rider/take-ride/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/take-ride/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/rider/take-ride/{id}`


<!-- END_d58faef53c5d86dac75d585fa5a39faa -->

<!-- START_112941aef20cb4b361bfb6a681599da3 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/my-rides" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/my-rides"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/my-rides`


<!-- END_112941aef20cb4b361bfb6a681599da3 -->

<!-- START_923c494cf81ce4c797996b42d222653e -->
## api/v1/rider/complete-ride/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/complete-ride/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/complete-ride/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/complete-ride/{id}`


<!-- END_923c494cf81ce4c797996b42d222653e -->

<!-- START_2e5f5fb1dbd4093935448ad64218a5fc -->
## api/v1/rider/comment/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/rider/comment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/comment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/rider/comment/{id}`


<!-- END_2e5f5fb1dbd4093935448ad64218a5fc -->

<!-- START_30dfd7a3492cb427ca9b5e24713948a8 -->
## api/v1/rider/comments/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/comments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/comments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/comments/{id}`


<!-- END_30dfd7a3492cb427ca9b5e24713948a8 -->

#Shop


APIs for Managing Shops
<!-- START_80420c095ed96da032c9eb419d7d6e2d -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 2,
        "name": "Drinks",
        "image": "1596719989.jpeg",
        "filePath": "http:\/\/localhost\/storage\/products_category\/1596719989.jpeg"
    },
    {
        "id": 1,
        "name": "Shoes",
        "image": "1596719839.jpeg",
        "filePath": "http:\/\/localhost\/storage\/products_category\/1596719839.jpeg"
    }
]
```

### HTTP Request
`GET api/v1/categories`


<!-- END_80420c095ed96da032c9eb419d7d6e2d -->

<!-- START_a7066c86e6bf1e901af442ec545c227f -->
## api/v1/search-categories
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/search-categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/search-categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/search-categories`


<!-- END_a7066c86e6bf1e901af442ec545c227f -->

<!-- START_0246ebcb9d75970da6bc5f71a4c4b503 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 2,
        "name": "Drinks",
        "image": "1596719989.jpeg",
        "filePath": "http:\/\/localhost\/storage\/products_category\/1596719989.jpeg"
    },
    {
        "id": 1,
        "name": "Shoes",
        "image": "1596719839.jpeg",
        "filePath": "http:\/\/localhost\/storage\/products_category\/1596719839.jpeg"
    }
]
```

### HTTP Request
`GET api/v1/shopLocal/categories`


<!-- END_0246ebcb9d75970da6bc5f71a4c4b503 -->

<!-- START_8cfa0500ee4d91b9a8b783ff4b5670d1 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/products/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/products/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 3,
        "title": "Airforce max II",
        "slug": "airforce-max-ii",
        "category_id": 1,
        "sub_category_id": 1,
        "brand_id": 1,
        "user_id": 2,
        "status": 1,
        "description": "<p>just do it<\/p>",
        "price": "2400.00",
        "visitors": 4,
        "quantity": null,
        "disabled": "enabled",
        "uniqueId": 1596721395,
        "created_at": "2020-08-06T13:43:15.000000Z",
        "updated_at": "2020-08-12T05:24:24.000000Z",
        "brand": {
            "id": 1,
            "name": "Nike",
            "sub_category_id": 1,
            "description": "Just do it",
            "created_at": "2020-08-06T13:18:36.000000Z",
            "updated_at": "2020-08-06T13:18:36.000000Z"
        },
        "files": [
            {
                "id": 5,
                "height": "194.00",
                "product_id": 3,
                "path": "1596721395airfore2.jpg",
                "created_at": "2020-08-06T13:43:15.000000Z",
                "updated_at": "2020-08-06T13:43:15.000000Z",
                "filePath": "http:\/\/localhost\/storage\/uploads\/1596721395airfore2.jpg",
                "largePath": "http:\/\/localhost\/storage\/uploads\/large\/1596721395airfore2.jpg"
            }
        ]
    }
]
```

### HTTP Request
`GET api/v1/shopLocal/products/{id}`


<!-- END_8cfa0500ee4d91b9a8b783ff4b5670d1 -->

<!-- START_cf55a609feba2a756dddc668f1c8a462 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/sub-categories/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/sub-categories/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 3,
        "name": "children",
        "products": []
    },
    {
        "id": 1,
        "name": "Men",
        "products": [
            {
                "id": 3,
                "title": "Airforce max II",
                "slug": "airforce-max-ii",
                "category_id": 1,
                "sub_category_id": 1,
                "brand_id": 1,
                "user_id": 2,
                "status": 1,
                "description": "<p>just do it<\/p>",
                "price": "2400.00",
                "visitors": 4,
                "quantity": null,
                "disabled": "enabled",
                "uniqueId": 1596721395,
                "created_at": "2020-08-06T13:43:15.000000Z",
                "updated_at": "2020-08-12T05:24:24.000000Z",
                "files": [
                    {
                        "id": 5,
                        "height": "194.00",
                        "product_id": 3,
                        "path": "1596721395airfore2.jpg",
                        "created_at": "2020-08-06T13:43:15.000000Z",
                        "updated_at": "2020-08-06T13:43:15.000000Z",
                        "filePath": "http:\/\/localhost\/storage\/uploads\/1596721395airfore2.jpg",
                        "largePath": "http:\/\/localhost\/storage\/uploads\/large\/1596721395airfore2.jpg"
                    }
                ]
            }
        ]
    },
    {
        "id": 2,
        "name": "women",
        "products": []
    }
]
```

### HTTP Request
`GET api/v1/shopLocal/sub-categories/{id}`


<!-- END_cf55a609feba2a756dddc668f1c8a462 -->

<!-- START_95e5736568c3a35f54912aaaeef0794f -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shopLocal/details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Product]."
}
```

### HTTP Request
`GET api/v1/shopLocal/details/{id}`


<!-- END_95e5736568c3a35f54912aaaeef0794f -->

<!-- START_a2dc2222259c0f08f08c3a62a575513a -->
## api/v1/shopLocal/search-products
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/shopLocal/search-products" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shopLocal/search-products"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/shopLocal/search-products`


<!-- END_a2dc2222259c0f08f08c3a62a575513a -->

<!-- START_4db3f812ab87dd48c440ead52e017bf0 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/shopLocal/details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/shopLocal/details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/shopLocal/details/{id}`


<!-- END_4db3f812ab87dd48c440ead52e017bf0 -->

<!-- START_59e41daf2fdb5a4ddba07237a4ab013c -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/details/{id}`


<!-- END_59e41daf2fdb5a4ddba07237a4ab013c -->

<!-- START_5a75d5593ec031d05e41784f56f47857 -->
## api/v1/retailer/dashboard/shop-details/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/shop-details/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/shop-details/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/shop-details/{id}`


<!-- END_5a75d5593ec031d05e41784f56f47857 -->

#Shops


APIs for Managing Shops
<!-- START_4f4e405a5e322af37d709e084b12cfcb -->
## Get wholesaler and retailer shops

[Here we get verified shop with the ID, shop Name, profile image and User_id : you can then use these details to get Wholesaler products.]

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/shops" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/shops"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 2,
        "shop": {
            "id": 1,
            "shop_name": "Hollywood mini supermarket",
            "profile_image": null,
            "user_id": 2,
            "filePath": "http:\/\/localhost\/storage\/uploads"
        }
    },
    {
        "id": 4,
        "shop": {
            "id": 2,
            "shop_name": "Marvick",
            "profile_image": null,
            "user_id": 4,
            "filePath": "http:\/\/localhost\/storage\/uploads"
        }
    }
]
```

### HTTP Request
`GET api/v1/shops`


<!-- END_4f4e405a5e322af37d709e084b12cfcb -->

<!-- START_aa126dc5701cb0d9e594ab2cb83f1029 -->
## Search for a given shop

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/search-shops" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"search":"Nakumart"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/search-shops"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "search": "Nakumart"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/search-shops`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `search` | String |  required  | details of the shop .
    
<!-- END_aa126dc5701cb0d9e594ab2cb83f1029 -->

<!-- START_9b60372ef3b6e71429291d14098e248d -->
## api/v1/sort-shops
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/sort-shops" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/sort-shops"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/sort-shops`


<!-- END_9b60372ef3b6e71429291d14098e248d -->

#Verification


APIs for Managing account verification
<!-- START_9711fdc23a79aad0d482e0ef7bbcc23b -->
## Resend the email verification notification.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/email/resend/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/email/resend/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\User]."
}
```

### HTTP Request
`GET api/v1/email/resend/{email}`


<!-- END_9711fdc23a79aad0d482e0ef7bbcc23b -->

<!-- START_ac71c807b8c6548977673dfcb3d80b79 -->
## Mark the authenticated user&#039;s email address as verified.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/email/verify/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/email/verify/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/email/verify/{id}/{hash}`


<!-- END_ac71c807b8c6548977673dfcb3d80b79 -->

#Wallet


APIs for Managing Wallet transaction
<!-- START_521a7e8d9c9ceb3d645bb4d9760acb91 -->
## api/v1/rider/wallet-balance
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/wallet-balance" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/wallet-balance"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/wallet-balance`


<!-- END_521a7e8d9c9ceb3d645bb4d9760acb91 -->

<!-- START_0a3267a1a55501fb4390322e983cc65e -->
## api/v1/rider/wallet-transactions
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/wallet-transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/wallet-transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/wallet-transactions`


<!-- END_0a3267a1a55501fb4390322e983cc65e -->

<!-- START_e84bd46cd66c9c7cdcf702807fe27680 -->
## api/v1/rider/stats
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/stats" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/stats"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/stats`


<!-- END_e84bd46cd66c9c7cdcf702807fe27680 -->

<!-- START_154ec9f7648aecf8a28d3bb0fb73a04f -->
## api/v1/rider/earning-report
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/earning-report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/earning-report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/earning-report`


<!-- END_154ec9f7648aecf8a28d3bb0fb73a04f -->

#general


<!-- START_db24fa8ceecd2fd884ffca214ad57acc -->
## Authenticate the request for channel access.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/broadcasting/auth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/broadcasting/auth"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Token not provided"
}
```

### HTTP Request
`GET api/v1/broadcasting/auth`

`POST api/v1/broadcasting/auth`


<!-- END_db24fa8ceecd2fd884ffca214ad57acc -->

<!-- START_16de3f15a45edecb890257f5e12b2e49 -->
## api/v1/auth/emailCheck
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/auth/emailCheck" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/emailCheck"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/auth/emailCheck`


<!-- END_16de3f15a45edecb890257f5e12b2e49 -->

<!-- START_25fabd3ee9212e025c50426b657239d2 -->
## api/v1/contact
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/contact" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/contact"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/contact`


<!-- END_25fabd3ee9212e025c50426b657239d2 -->

<!-- START_9cafc90ccf899b3989f83a1a368ffcd5 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/user`


<!-- END_9cafc90ccf899b3989f83a1a368ffcd5 -->

<!-- START_a8f2cd73f7f241bac59f75ba0b3cb4bd -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/user`


<!-- END_a8f2cd73f7f241bac59f75ba0b3cb4bd -->

<!-- START_c426e0a725deb61656254459ea441a53 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/user/{user}`


<!-- END_c426e0a725deb61656254459ea441a53 -->

<!-- START_c71eaa496598da79351787e83c914857 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/v1/admin/user/{user}`

`PATCH api/v1/admin/user/{user}`


<!-- END_c71eaa496598da79351787e83c914857 -->

<!-- START_39030d4123dd93a737e9138267bccff9 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/admin/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/admin/user/{user}`


<!-- END_39030d4123dd93a737e9138267bccff9 -->

<!-- START_e778e75c17c69bbb4a8fe947f0cf056a -->
## api/v1/admin/users/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/users/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/users/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/users/{id}`


<!-- END_e778e75c17c69bbb4a8fe947f0cf056a -->

<!-- START_bdd7d82bfd927d1ed9892ab6acf4b089 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/dashboard`


<!-- END_bdd7d82bfd927d1ed9892ab6acf4b089 -->

<!-- START_22d908d15c9c429ae5d5b1fd986ed024 -->
## api/v1/admin/customer
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/customer" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/customer"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/customer`


<!-- END_22d908d15c9c429ae5d5b1fd986ed024 -->

<!-- START_83ddf0ef59ede9e986119ed99776c909 -->
## api/v1/admin/rider
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/rider" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/rider"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/rider`


<!-- END_83ddf0ef59ede9e986119ed99776c909 -->

<!-- START_704472d7d794592d6a44a3c36aead136 -->
## api/v1/admin/wholesaler
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/wholesaler" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/wholesaler"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/wholesaler`


<!-- END_704472d7d794592d6a44a3c36aead136 -->

<!-- START_1eccf073ca7066f602d8e50de74ead03 -->
## api/v1/admin/retailer
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/retailer" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/retailer"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/retailer`


<!-- END_1eccf073ca7066f602d8e50de74ead03 -->

<!-- START_b867d1a13689b8f77e8453b32ba35368 -->
## api/v1/admin/userDetails/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/userDetails/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/userDetails/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/userDetails/{id}`


<!-- END_b867d1a13689b8f77e8453b32ba35368 -->

<!-- START_155eae2c4ead188cad8f5dc6f4b11674 -->
## api/v1/admin/riderDocuments
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/admin/riderDocuments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/riderDocuments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/admin/riderDocuments`


<!-- END_155eae2c4ead188cad8f5dc6f4b11674 -->

<!-- START_991535bcd849bd7adc4a20da52129837 -->
## api/v1/admin/riderDocs/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/riderDocs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/riderDocs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/riderDocs/{id}`


<!-- END_991535bcd849bd7adc4a20da52129837 -->

<!-- START_f10d80e42ec02e41c93659d0486ea446 -->
## api/v1/admin/deleteDocs/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/deleteDocs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/deleteDocs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/deleteDocs/{id}`


<!-- END_f10d80e42ec02e41c93659d0486ea446 -->

<!-- START_0ad5545f10b124b6b13cc54c85422a65 -->
## api/v1/admin/download/{orderId}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/admin/download/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/download/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Please, attach a Bearer Token to your request",
    "success": false
}
```

### HTTP Request
`GET api/v1/admin/download/{orderId}`


<!-- END_0ad5545f10b124b6b13cc54c85422a65 -->

<!-- START_8ec23aafa480fdceab5d0b6dd261915f -->
## api/v1/admin/changeStatus/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/admin/changeStatus/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/changeStatus/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/changeStatus/{id}`


<!-- END_8ec23aafa480fdceab5d0b6dd261915f -->

<!-- START_292aa19c9ff7e7e6ff481df8c94efced -->
## api/v1/admin/changeVerificationStatus/{id}
> Example request:

```bash
curl -X PATCH \
    "http://localhost/api/v1/admin/changeVerificationStatus/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/admin/changeVerificationStatus/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH api/v1/admin/changeVerificationStatus/{id}`


<!-- END_292aa19c9ff7e7e6ff481df8c94efced -->

<!-- START_7742aaf245561f0cea73372a12ef6873 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/user/{id}`


<!-- END_7742aaf245561f0cea73372a12ef6873 -->

<!-- START_9fe5986e0194c5b32f6f12104912ab54 -->
## api/v1/retailer/dashboard/verified_riders
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/retailer/dashboard/verified_riders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/verified_riders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/retailer/dashboard/verified_riders`


<!-- END_9fe5986e0194c5b32f6f12104912ab54 -->

<!-- START_fc48756dbb7f2687d9b12dbdbd6d60f1 -->
## api/v1/retailer/dashboard/dial_a_rider/{id}
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/retailer/dashboard/dial_a_rider/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/retailer/dashboard/dial_a_rider/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/retailer/dashboard/dial_a_rider/{id}`


<!-- END_fc48756dbb7f2687d9b12dbdbd6d60f1 -->

<!-- START_c2ce30e6ec5d8ff7dfbbc750c930fa8a -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/rider/dashboard/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/rider/dashboard/user/{id}`


<!-- END_c2ce30e6ec5d8ff7dfbbc750c930fa8a -->

<!-- START_3d7c220bdfbe9de130010e4c617007de -->
## api/v1/rider/dashboard/documents
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/rider/dashboard/documents" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/documents"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/rider/dashboard/documents`


<!-- END_3d7c220bdfbe9de130010e4c617007de -->

<!-- START_1187b9bf59f3baf915996dee1d2d790d -->
## api/v1/rider/dashboard/docs/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/rider/dashboard/docs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/docs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/v1/rider/dashboard/docs/{id}`


<!-- END_1187b9bf59f3baf915996dee1d2d790d -->

<!-- START_6104bf990fa539d1e2d3560ca23d56f9 -->
## api/v1/rider/dashboard/deleteDocs/{id}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/rider/dashboard/deleteDocs/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/dashboard/deleteDocs/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/v1/rider/dashboard/deleteDocs/{id}`


<!-- END_6104bf990fa539d1e2d3560ca23d56f9 -->

<!-- START_7ec38a30acd69cd4a021f8aa8d061db5 -->
## api/v1/rider/fcm-token
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/rider/fcm-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/rider/fcm-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/rider/fcm-token`


<!-- END_7ec38a30acd69cd4a021f8aa8d061db5 -->

<!-- START_66e08d3cc8222573018fed49e121e96d -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET login`


<!-- END_66e08d3cc8222573018fed49e121e96d -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_cb859c8e84c35d7133b6a6c8eac253f8 -->
## Show the application dashboard.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/home" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/home"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET home`


<!-- END_cb859c8e84c35d7133b6a6c8eac253f8 -->


