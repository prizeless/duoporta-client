Duoporta PHP client
============================

Steps to using this API Client
----------------------------
1. Get API key from duoporta.co.za
2. Install this api client using composer
3. Open file src/Config/Api
4. Update config with your client id and api key
5. Initialize class 
```!php
$request = new \Duoporta\Controllers\Request();
$result  = $request->getRanges();

```

6. Check the various methods under this class.
7. Sit back and love it :)

TODO
---------------------------
1. Write unit tests
2. Cache responses