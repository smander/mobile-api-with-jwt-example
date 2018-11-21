# mobile-api-with-jwt-example
Mobile Api with test data - Getting From Github Users and Email them


Steps to install

1) composer install
2) php artisan migrate install and php artisan migrate
3) configure .env with mail credits





REST Methods

**REGISTER User**
----
  Returns json data about a single user.

* **URL**

  /api/register

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `email=[string]`
   `password=[string]`
   `avatar=[mime type]'

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ token : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjYsImlzcyI6Imh0dHA6Ly9sb2NhbC50cmFmZmljc3dpdGNoZXIuY29tL2FwaS9sb2dpbiIsImlhdCI6MTUzMzc5OTczMiwiZXhwIjoxNTMzODAzMzMyLCJuYmYiOjE1MzM3OTk3MzIsImp0aSI6Img1RFBvcjV0QlgxeDNLYXQifQ.0KjTj0SFBZtp0kiNAFUdGlJFsTvduiyd8abcIulG5YA , avatar 'user.jpg}`
 
* **Error Response:**

  * **Code:** 500 Failed <br />
    **Content:** `{ error : "failed to authorize and generate token" }`

  OR

  * **Code:** 401 UNAUTHORIZED <br />
  
  
  
  **LOGIN User**

* **URL**

  /api/login

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `email=[string]`
   `password=[string]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ token : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjYsImlzcyI6Imh0dHA6Ly9sb2NhbC50cmFmZmljc3dpdGNoZXIuY29tL2FwaS9sb2dpbiIsImlhdCI6MTUzMzc5OTczMiwiZXhwIjoxNTMzODAzMzMyLCJuYmYiOjE1MzM3OTk3MzIsImp0aSI6Img1RFBvcjV0QlgxeDNLYXQifQ.0KjTj0SFBZtp0kiNAFUdGlJFsTvduiyd8abcIulG5YA , avatar 'user.jpg'}`
 
* **Error Response:**

  * **Code:** 500 Failed <br />
    **Content:** `{ error : "Failed to login, please try again." }`

  OR

  * **Code:** 401 UNAUTHORIZED <br />
  
  
  
**SEND EMAIL GITHUB Users**

* **URL**

  /api/github/email

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
   `username_list[]=[string]` (can accept more than 1 element)
   `message=[string]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{ {"success":true,"data":[{"user_location":"France","user_email":"hello@knplabs.com"},{"user_location":"France","user_email":"hello@knplabs.com"}]}}`
 
* **Error Response:**

  * **Code:** 500 Failed <br />
    **Content:** `{ error : "Failed to login, please try again." }`

  OR

  * **Code:** 401 UNAUTHORIZED <br />
  
  
  
  
  
