Use https://readme.so/editor Editor to edit the MD file

![Logo](https://omarty.net/wp-content/uploads/2023/03/cropped-omarty_logo_80h.png)

# Sign-Language-Translation-API-v3
Webservice to translate text into sign language videos after processing the text , currently it supports Arabic text only


#### **2- Send Chat Message**
Used to Send chat message to a block (Group of users) , or Send chat message to specific user (one to one), he request is sent as JSON, the respons is JSON

Request should include the header parameters

```http
  ws://ws.omarty.net:PortNumber
```
##### **Request Parameters**

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `requesttype`      | `string` | **Required**. Set to "send" |
| `UserID`      | `string` | **Required**. Id of the user |
| `BlockID`      | `string` | **Required**. Current BlockID  |
| `targetUserID`      | `string` | **Required**. for group (BlockID) chat, or another User ID for chats between two users  |
| `UserFName`      | `string` | **Required**. Nick name or user name that will appear in chat |
| `message`      | `string` | **Required**. the message to be sent |

#### targetUserID

- If set to 0 ; it will send the message to of all the users in the BlockID.
- If set to value > 0 , it should be the target user ID , to message from UserID to targetUserID 


#### Example 1
The Request for sending message from the user UserID = 1 to all users in BlockID = 2  

```javascript
{
  "BlockID": 2,
  "UserID": 1,
  "UserFName": "Mo Khalifa",
  "message": "Hello, My neighbours!",
  "requesttype": "send",
  "targetUserID": 0
}
```

#### Example 2
The Request for sending message from the user UserID = 1 to the other user targetUserID = 2 

```javascript
{
  "BlockID": 2,
  "UserID": 1,
  "UserFName": "Mo Khalifa",
  "message": "Hello, John How its going!",
  "requesttype": "send",
  "targetUserID": 2
}
```

#### ERROR Response
The Response is JSON object containing two praramets 
`msg` : is the error/response message from the server
`Obj` : is the error/response JSON object

```javascript
{
    "msg": "Invalid headers, userid and blockid",
    "Obj": {
        "sec-websocket-version": "13",
        "sec-websocket-key": "9MmX3TxQKboEzn013BOr5Q==",
        "connection": "Upgrade",
        "upgrade": "websocket",
        "userid": "3",
        "blockida": "1",
        "sec-websocket-extensions": "permessage-deflate; client_max_window_bits",
        "host": "ws.omarty.net:3008"
    }
}
```

```javascript
{
    "msg": "Invalid parameters",
    "Obj": {
        "BlockID": 1,
        "UserID": 3,
        "UserFName": "Omer Khalifa",
        "message": "Omer Khalifa Hello, everyone!",
        "requesttype": "send",
        **"targetUserID": "s"
    }
```

#### Message sent Response
The Response is JSON object containing the sent message object as follows

```javascript
{
        UserID: UserID,
        BlockID: BlockID,
        UserFName: UserFName,
        ChatMessage: msg,
        TimeStamp: TimeStamp,
        errormsg: '',
        targetUserID: targetUserID,
		SenderID: UserID,
      }
```



