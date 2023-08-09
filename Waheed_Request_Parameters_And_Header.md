

![Logo](https://omarty.net/wp-content/uploads/2023/03/cropped-omarty_logo_80h.png)


# Omarty Chat Websocket API Documentation

Omarty is an application for Buildings commuinities, it includes a chat module for chating between building users




## API Reference
### **Add Contacts**
we use the following URL to Update Data from the DataBase and to specify the kind of data user want to update enter KEY api values as showed in the documentation.
```http
  https://plateform.omarty.net/omartyapis/Update/
```

### **Request Header**
Each Request to the API should include the following parameters in the header of the request.

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `Accept-Encoding` | `gzip, deflate, br` | **Required**. Accepted encoding types |
| `Content-Type` | `multipart/form-data; boundary=<calculated when request is sent>` | **Required**. Content type|
| `Authorization` | `Bearer` | **Required**. Bearer Token|

------------------------------
### **Requests & Responses**

#### **1- Add Contacts**
to Add secondary contacts for user.

Request should include the header parameters
```http
  https://plateform.omarty.net/omartyapis/Update/
```
##### **Request Parameters**

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api` | `String` | **Required**. End point name|
| `phoneNumber` | `Number` | **Optional**. New Phone Number|
| `email` | `String` | **Optional**. New Email|
| `longitude` | `String` | **Optional**. Device Longitude|
| `latitude` | `String` | **Optional**. Device Latitude|
| `blockId` | `Number` | **Required**. User Block ID|
| `apartmentId` | `Number` | **Required**. User Apartment ID|


#### `api`

- End point that will trigger Adding New Secondary Contacts for user `AddContact`.

#### `phoneNumber`

- New Phone Number User wants to add to his contacts list.

#### `email`

- New Email User wants to add to his contacts list

#### `longitude`

- Device longitude that will be stored in logs table.

#### `latitude`

- Device latitude that will be stored in logs table.

#### `blockId`

- User's block ID.

#### `apartmentId`

- User's apartment ID.


#### Example 1 : Adding Email Only 

```javascript
{
	"api": "AddContact",
	"phoneNumber": ,
	"email" : "Test.Test@Test.com",
	"longitude": '121.12221',
	"latitude" : '20.233',
	"blockId": 1,
	"apartmentId": 1,
}
```

#### Response
The Response is JSON object containing array of objects named `status` and `data` the data object shows the body of the response and status shows response status.

```javascript
{
    "status": 200,
    "data": {
        "1": {
            "id": "1",
            "email": "Test.Test@Test.com"
        }
    }
}
```

#### Example 2 : Adding PhoneNumber Only 

```javascript
{
	"api": "AddContact",
	"phoneNumber": 01122334455,
	"email" : ,
	"longitude": '121.12221',
	"latitude" : '20.233',
	"blockId": 1,
	"apartmentId": 1,
}
```

#### Response
The Response is JSON object containing array of objects named `status` and `data` the data object shows the body of the response Which contains all secondary contacts of this user and status shows response status.

```javascript
{
    "status": 200,
    "data": {
        "1": {
            "id": "1",
            "email": "Test.Test@Test.com"
        },
        "2": {
            "id": "1",
            "phoneNum": "01122334455"
        }
    }
}
```


#### ERROR Response
The Response is JSON object containing array of objects named `status` and `message` the "message" object shows the body of the response and status shows response status.


##### Case 1 : Insert Both Email and PhoneNumber Will return User's Socondary contacts and Error object inside the message object that says No Data Inserted.
```javascript
{
    "status": 200,
    "message": {
        "1": {
            "id": "1",
            "email": "Test.Test@Test.com"
        },
        "2": {
            "id": "1",
            "phoneNum": "01122334455"
        },
        "error": "No Data Inserted."
    }
}
```


##### Case 2 : if left any required key empty.
```javascript
{
    "status": 200,
    "message": "Please enter (key) ID."
}
```

##### Case 3 : Send in api key any other value than AddContact.
```javascript
{
    "status": 404,
    "message": "Method Update::(other value) value() does not exist"
}
```

## Authors

This Code, Trademark, and Application is Copywrite protected by law to [Diginovia](https://diginovia.com/)
- Mohammed Khalifa [@makkcg](https://github.com/makkcg)

## Links

- [Postman](https://omarty.postman.co/workspace/Omarty-Workspace-VPS~7efc4af7-9f9e-48ce-a5b5-d127cfd455b1/overview)

