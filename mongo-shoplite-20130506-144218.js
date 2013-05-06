
/** carts indexes **/
db.getCollection("carts").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** products indexes **/
db.getCollection("products").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** sequences indexes **/
db.getCollection("sequences").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** shoppers indexes **/
db.getCollection("shoppers").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** users indexes **/
db.getCollection("users").ensureIndex({
  "_id": NumberInt(1)
},[
  
]);

/** carts records **/

/** products records **/
db.getCollection("products").insert({
  "_id": ObjectId("51839664ccae5b4f07000001"),
  "cache_id": "",
  "cache_obj": "",
  "category": "clothing",
  "createdDate": ISODate("2013-05-03T10:50:12.97Z"),
  "defaultpic": "3",
  "description": "product number one",
  "effectiveFrom": "15-05-2013",
  "effectiveUntil": "31-05-2013",
  "groupId": "",
  "groupName": "",
  "lastUpdate": ISODate("2013-05-06T12:26:43.580Z"),
  "name": "Product One",
  "permalink": "product_one",
  "priceCurrency": "IDR",
  "productcode": "SK023213",
  "productpic": {
    "pic01": {
      "name": "darth-vader-mobile-hd-158300.jpg",
      "type": "image\/jpeg",
      "tmp_name": "\/private\/var\/tmp\/phpIKbyiZ",
      "error": NumberInt(0),
      "size": NumberInt(111615)
    }
  },
  "productsequence": "000000",
  "publishFrom": "01-05-2013",
  "publishStatus": "online",
  "publishUntil": "31-05-2013",
  "retailPrice": "135000",
  "salePrice": "123000",
  "section": "mixmatch",
  "tags": "hip"
});
db.getCollection("products").insert({
  "_id": ObjectId("5183ad30ccae5ba908000000"),
  "cache_id": "",
  "cache_obj": "",
  "category": "asdasd",
  "createdDate": ISODate("2013-05-03T12:27:28.759Z"),
  "defaultpic": "1",
  "description": "asdasda",
  "effectiveFrom": "28-05-2013",
  "effectiveUntil": "31-05-2013",
  "groupId": "",
  "groupName": "",
  "lastUpdate": ISODate("2013-05-03T12:49:30.730Z"),
  "name": "test image resize add",
  "permalink": "saasdfsafsa",
  "priceCurrency": "IDR",
  "productcode": "12435345",
  "productpic": {
    "pic01": {
      "name": "0000225b_medium.jpeg",
      "type": "image\/jpeg",
      "tmp_name": "\/private\/var\/tmp\/phpE3qi8p",
      "error": NumberInt(0),
      "size": NumberInt(61032)
    },
    "pic04": {
      "name": "00002246_medium.jpeg",
      "type": "image\/jpeg",
      "tmp_name": "\/private\/var\/tmp\/phpLSUdNa",
      "error": NumberInt(0),
      "size": NumberInt(78008)
    }
  },
  "productsequence": "000000",
  "publishFrom": "23-05-2013",
  "publishStatus": "online",
  "publishUntil": "31-05-2013",
  "retailPrice": "135000",
  "salePrice": "123000",
  "section": "mixmatch",
  "tags": "asdsad"
});

/** sequences records **/
db.getCollection("sequences").insert({
  "_id": "attendee",
  "seq": NumberLong(62)
});
db.getCollection("sequences").insert({
  "_id": "official",
  "seq": NumberLong(6)
});
db.getCollection("sequences").insert({
  "_id": "visitor",
  "seq": NumberLong(2)
});
db.getCollection("sequences").insert({
  "_id": "golf",
  "seq": NumberLong(11)
});
db.getCollection("sequences").insert({
  "_id": "shopper",
  "seq": NumberLong(3)
});

/** shoppers records **/
db.getCollection("shoppers").insert({
  "_id": ObjectId("5178fcc4ccae5bd505000000"),
  "salutation": "Mrs",
  "firstname": "Joni",
  "lastname": "Karjo",
  "email": "joni@gozal.co.id",
  "pass": "$2a$08$2mM\/V7xO.6o6zeqrFh4cLOEdA\/XJOMKzHljRX7uMmmjJZ2ywvrR22",
  "address_1": "Komp DKI Joglo Blok D No 3 RT 01\/04 Joglo Kembangan",
  "address_2": "",
  "city": "Jakarta",
  "zip": "11640",
  "country": "Indonesia",
  "shippingphone": "021-5841281",
  "mobile": "",
  "fullname": "Andi Karsono",
  "bankname": "BCA",
  "branch": "",
  "cardnumber": "",
  "ccname": "",
  "expiremonth": "",
  "expireyear": "",
  "agreetnc": "",
  "saveinfo": "",
  "createdDate": ISODate("2013-04-25T09:52:04.928Z"),
  "lastUpdate": ISODate("2013-04-25T09:52:04.928Z"),
  "role": "shopper",
  "shopperseq": "0000000000"
});
db.getCollection("shoppers").insert({
  "_id": ObjectId("5178fde4ccae5bdc05000000"),
  "address_1": "Komp DKI Joglo Blok D No 3 RT 001\/004 Kembangan",
  "address_2": "",
  "agreetnc": false,
  "bankname": "BCA",
  "branch": "",
  "cardnumber": "",
  "ccname": "",
  "city": "Jakarta",
  "country": "-",
  "createdDate": ISODate("2013-04-25T09:56:52.95Z"),
  "email": "kuncoro@paramanusa.co.id",
  "expiremonth": "",
  "expireyear": "",
  "firstname": "Kartini",
  "fullname": "Kartono",
  "lastUpdate": ISODate("2013-05-06T05:43:41.938Z"),
  "lastname": "Kartono",
  "mobile": "",
  "pass": "",
  "repass": "",
  "role": "shopper",
  "salutation": "Mrs",
  "saveinfo": true,
  "shippingphone": "",
  "shopperseq": "0000000001",
  "zip": "11640"
});
db.getCollection("shoppers").insert({
  "_id": ObjectId("517a6056ccae5b4703000000"),
  "activeCart": "",
  "address_1": "Komp DKI Joglo Blok D No 3 RT 01\/04 Joglo Kembangan",
  "address_2": "",
  "agreetnc": "",
  "bankname": "",
  "branch": "",
  "cardnumber": "",
  "ccname": "",
  "city": "Jakarta",
  "country": "Indonesia",
  "createdDate": ISODate("2013-04-26T11:09:10.574Z"),
  "email": "andy.awidarto@gmail.com",
  "expiremonth": "",
  "expireyear": "",
  "firstname": "Andi",
  "fullname": "Andi Karsono",
  "lastUpdate": ISODate("2013-04-26T11:09:10.574Z"),
  "lastname": "Karsono",
  "mobile": "",
  "pass": "$2a$08$Q7UxB8TpjY4ZsQ33Dw3nReuTT\/2eG6bn7UY\/LezTUenQeX\/CQaJei",
  "role": "shopper",
  "salutation": "Mr",
  "saveinfo": "",
  "shippingphone": "",
  "shopperseq": "0000000002",
  "zip": "11640"
});

/** users records **/
db.getCollection("users").insert({
  "_id": ObjectId("51198d198dfa195c4c000000"),
  "email": "taufiq.ridha@gmail.com",
  "fullname": "Taufiq ridha",
  "username": "taufiqridha",
  "pass": "$2a$08$kYUz7hWWXwbv.AfNEg81U.GA8vnG5XFPuuUQYldRMm0DQyNIurmmm",
  "employee_jobtitle": "",
  "department": "general",
  "mobile": "",
  "home": "",
  "street": "",
  "city": "",
  "zip": "",
  "role": "root",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "createdDate": ISODate("2013-02-12T00:30:17.503Z"),
  "lastUpdate": ISODate("2013-05-06T04:13:53.530Z"),
  "creatorName": "Andi Karsono Awidarto",
  "creatorId": "50d433404325a24c04000000"
});
db.getCollection("users").insert({
  "_id": ObjectId("511b2ff08dfa19f56d000000"),
  "city": "",
  "createdDate": ISODate("2013-02-13T06:17:20.629Z"),
  "creatorId": "50d433404325a24c04000000",
  "creatorName": "Andi Karsono Awidarto",
  "department": "general",
  "email": "annetriani@gmail.com",
  "employee_jobtitle": "",
  "fullname": "Anne",
  "home": "",
  "lastUpdate": ISODate("2013-02-13T06:17:20.629Z"),
  "mobile": "",
  "pass": "$2a$08$k\/hkCTSJMzbaHKd7fWU4SurlDZK9Kp1aIGAj9h\/IlqCg4NISQAfkW",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "role": "root",
  "street": "",
  "username": "annetriani",
  "zip": ""
});
db.getCollection("users").insert({
  "_id": ObjectId("5121cb3c8dfa193546000002"),
  "email": "luh.ariati@dyandra.com",
  "fullname": "Luh Ariati",
  "username": "Luh Ariati",
  "pass": "$2a$08$ReKIMeDoxB6UjVTEFHJUBuKDQssXXIU9c7FYVKayTrvVvQCIqGJMi",
  "employee_jobtitle": "",
  "department": "general",
  "mobile": "",
  "home": "",
  "street": "",
  "city": "",
  "zip": "",
  "role": "root",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "createdDate": ISODate("2013-02-18T06:33:32.528Z"),
  "lastUpdate": ISODate("2013-05-04T20:31:43.484Z"),
  "creatorName": "Andi Karsono Awidarto",
  "creatorId": "50d433404325a24c04000000"
});
db.getCollection("users").insert({
  "_id": ObjectId("5121cb668dfa193746000005"),
  "email": "Eugene.sabina@gmail.com",
  "fullname": "Eugana Sabina",
  "username": "Eugana Sabina",
  "pass": "$2a$08$9ta.9Smd1fXzNkzOHOqwDuoSXRPfrxiS3BCDb887tG8iCxHiaF.aO",
  "employee_jobtitle": "",
  "department": "general",
  "mobile": "",
  "home": "",
  "street": "",
  "city": "",
  "zip": "",
  "role": "root",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "createdDate": ISODate("2013-02-18T06:34:14.169Z"),
  "lastUpdate": ISODate("2013-02-18T06:34:14.169Z"),
  "creatorName": "Andi Karsono Awidarto",
  "creatorId": "50d433404325a24c04000000"
});
db.getCollection("users").insert({
  "_id": ObjectId("5185643cccae5b6b0f000000"),
  "city": "1213131",
  "createdDate": ISODate("2013-05-04T19:40:44.342Z"),
  "creatorId": "50d433404325a24c04000000",
  "creatorName": "Andi Karsono Awidarto",
  "email": "andy.awidarto@kickstartlab.com",
  "fullname": "Andi Karsono",
  "home": "",
  "lastUpdate": ISODate("2013-05-04T19:43:39.536Z"),
  "mobile": "",
  "pass": "$2a$08$kbVk\/9iZ8kYFpWn2xMFk1uUmCw93klsFYtDZGFP12jDjQ7Xli7lQm",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "role": "super",
  "street": "",
  "zip": ""
});
db.getCollection("users").insert({
  "_id": ObjectId("5166a151ccae5b9e18000000"),
  "city": "",
  "createdDate": ISODate("2013-04-11T11:41:05.887Z"),
  "creatorId": "50d433404325a24c04000000",
  "creatorName": "Andi Karsono Awidarto",
  "email": "cashier@email.com",
  "fullname": "Cashier",
  "home": "",
  "id": "5166a151ccae5b9e18000000",
  "lastUpdate": ISODate("2013-05-04T20:21:13.504Z"),
  "mobile": "",
  "pass": "$2a$08$XQA63GeKT3nsQ3eN3GGB0eXYgkjXasc1Ce9ibw9MrQ1pEAqEAV9Bi",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "role": "cashier",
  "street": "",
  "zip": ""
});
db.getCollection("users").insert({
  "_id": ObjectId("513f53eb0b9b34cb01000000"),
  "city": "",
  "createdDate": ISODate("2013-03-12T16:12:27.169Z"),
  "creatorId": "50d433404325a24c04000000",
  "creatorName": "Andi Karsono Awidarto",
  "email": "onsite@kickstartlab.com",
  "fullname": "Onsite Officer",
  "home": "3213123123",
  "id": "513f53eb0b9b34cb01000000",
  "lastUpdate": ISODate("2013-05-06T03:58:14.86Z"),
  "mobile": "0897867857856",
  "pass": "$2a$08$V5.fxu.dKCzKFxCUZP6yK.Ra9YugU8XJadmKKT8tlc5LiV1VQfjNq",
  "permissions": {
    "general": false,
    "registration": false,
    "content": false,
    "president_director": false,
    "operations_director": false,
    "finance_hr_director": false,
    "clients": false,
    "principal_vendor": false,
    "subcon": false
  },
  "role": "onsite",
  "street": "",
  "zip": ""
});
db.getCollection("users").insert({
  "_id": ObjectId("50d433404325a24c04000000"),
  "bod_set": "1",
  "city": "Jakarta Barat",
  "clients_set": "1",
  "csrf_token": "ncL0961YQ17Z31imzRu5pgZde58jSGn4iPTpu5KP",
  "department": "general",
  "email": "andy.awidarto@gmail.com",
  "employee_department": "RnR",
  "employee_jobtitle": "Dev Manager",
  "finance_pusat_set": "1",
  "fullname": "Andi Karsono Awidarto",
  "general_set": "1",
  "home": "021456789",
  "lastUpdate": ISODate("2013-01-28T17:26:35.103Z"),
  "mobile": "0987654325757578",
  "pass": "$2a$08$31a03MFMOlQZiLUmdwMRBePdQIqjDzBRFAcrlDzPzNXtEDFMxO0ti",
  "permissions": {
    "general": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "outdoor_sales": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "indoor_sales": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "project_control": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "bod": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "president_director": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "operations_director": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "finance_hr_director": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "finance_pusat": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "finance_kemang": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "finance_balikpapan": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "sales_kemang": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "sales_balikpapan": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "tender_balikpapan": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "hr_admin": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "warehouse": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "qc": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "clients": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "principal_vendor": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    },
    "subcon": {
      "read": NumberLong(0),
      "create": NumberLong(0),
      "edit": NumberLong(0),
      "delete": NumberLong(0),
      "approve": NumberLong(0),
      "share": NumberLong(0)
    }
  },
  "repass": "pisangkeju",
  "role": "root",
  "sales_balikpapan_set": "1",
  "street": "Kompleks DKI",
  "username": "masteryoda",
  "zip": "11640"
});
