How to run this project:

1. Composer Update
2. ./vendor/bin/sail up
3. ./vendor/bin/sail artisan jwt:secret
4. ./vendor/bin/sail artisan migrate

Check Coverage Test:

1. ./vendor/bin/sail artisan test --coverage

Diagram: public/diagram
Tools: POSTMAN

API Documentation:

<pre>
Register:
URL: localhost/api/login
Method: POST
Body:
{
"name":"admin"
"email": "admin@gmail.com",
"password": "12345678",
}
</pre>

<pre>
Login:
URL: localhost/api/login
Method: POST
Body:
{
"email": "admin@gmail.com",
"password": "12345678",
}
</pre>

<pre>
Logout:
URL: localhost/api/logout
Method: POST
Header:{
"Authorization":"Bearer Token"
}
Body:
{
"email": "admin@gmail.com",
"password": "12345678",
}
</pre>

<pre>
Verify Document:
URL: localhost/api/verify_document
Method: POST
Header:{
"Authorization":"Bearer Token"
}
Body:
{
"document": File
}
</pre>
