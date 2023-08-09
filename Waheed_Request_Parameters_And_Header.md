

![Logo](https://drive.google.com/file/d/1z_xTBMAlD-3KRg0wOlr_peJlrD81J1d4/view?usp=sharing)


# Sign-Language-Translation-API-v3

Webservice to translate text into sign language videos after processing the text , currently it supports Arabic text only




## API Reference
### **Translate Text**
We Use the following api to translate text into sign language.

### **Request Header**
Each Request to the API should include the following parameters in the header of the request.

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `Accept-Encoding` | `gzip, deflate, br` | **Required**. Accepted encoding types |
| `Content-Type` | `multipart/form-data; boundary=<calculated when request is sent>` | **Required**. Content type|
| `Authorization` | `Bearer` | **Required**. Bearer Token|

------------------------------
### **Requests & Responses**

#### **1- Translate Text**
to translate arabic language text to sign language.

Request should include the header parameters
```http
  Link
```
##### **Request Parameters**

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `text` | `String` | **Required**. Text user wants to translate|
| `translatorId` | `Number` | **Optional**. Translator ID|
| `languageId` | `Number` | **Optional**. Language ID|
| `countryId` | `Number` | **Optional**. Country ID of the user|
| `slangId` | `Number` | **Optional**. Users' slang ID|
| `vocalize` | `Number` | **Optional**. Flag to vocalize the text|
| `vedioFormatID` | `Number` | **Optional**. Vedio format that should be compatible with user device|
| `osId` | `Number` | **Optional**. Users' Operating system|
| `transParagraph` | `Number` | **Optional**. Flag to Translate the whole paragraph at once|
| `stream` | `Number` | **Optional**. Flag to stream translation or to view it as vedio links|
| `arabicGrammar` | `Number` | **Optional**. Flag to Activate arabic grammar to translate efficiently|
| `responseType` | `String` | **Optional**. Response Type|


#### `text`

- Text which user wants to translate to sign language.

#### `translatorId`

- Translator ID to view him translating.

#### `languageId`

- Language Of text, default is Arabic.

#### `countryId`

- Users' Country ID.

#### `slangId`

- If this key is not empty then this slang words will be added to the words translated not only pure Arabic.

#### `vocalize`

- if user didn't pass text vocalized and this flag is set greater than 0 then text will be vocalized by Arabic grammar.

#### `vedioFormatID`

- Vedio format of the translated text that should be compatible with user device.

#### `osId`

- Users' Operating System (Android / ios / Windows / ...).

#### `transParagraph`

- Flag to translate the whole paragraph by not cutting it into small sentences then translate.

#### `stream`

- stream translation or return vedio links.

#### `arabicGrammar`

- to translate sign language and show pronouns, tenses, plural and singular. 

#### `responseType`

- Response type (JSON / XML).



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
	"vocalizedSentence": "",
	"unVocalizedSentence": "",
	"numberOfWords": 32,
        "vocalizedWords": [
			"word": "",
			"wordAlphabet": [
				"alphabet":[
					"text":" ٌب",
					"link": "",
					]
				]
			],
	"unVocalizedWord": [
			"word": ""
			"wordAlphabet": [
				"alphabet":[
					"text":"ب",
					"link": "",
					]
				]
			],
	"vedioLinks":[
		"word1": [
			"text": "يلعب",
			"wordType": "فعل",
			"vedioLink": ""
			],

		"word2": [
			"text": "الولد",
			"wordType": "اسم",
			"vedioLink": ""
			],
		]
    }
}
```



#### ERROR Response
The Response is JSON object containing array of objects named `status` and `message` the "message" object shows the body of the response and status shows response status.


##### Case 1 :
```javascript
{
    "status": 200,
    "message": {
       "Error Message."
    }
}
```



## Authors

This Code, Trademark, and Application is Copywrite protected by law to [Diginovia](https://diginovia.com/)
- Mohammed Khalifa [@makkcg](https://github.com/makkcg)
- Mohammed Waheed [@MuhammadWaheed](https://github.com/MuhammadWaheed73780)

## Links

- [Postman](https://omarty.postman.co/workspace/Omarty-Workspace-VPS~7efc4af7-9f9e-48ce-a5b5-d127cfd455b1/overview)

