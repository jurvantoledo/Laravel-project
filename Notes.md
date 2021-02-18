## Logout

Made the logout route in a form variant to give it cross site request protection.

## Authenticate Middleware

Authenticate Middleware will look if user is signed in else it will use the unauthenticated method which will throw a authentication exception

first way to add middleware: use this: ->middleware('auth') behind your routes

second way: add this:  
public function \_construct()
{
$this->middleware(['auth']);  
 }
To the Controller you want middleware on you can use ->only behind it to specify it.

## Guest middleware

If u use the guest middleware you cant create a new account if you already made an account if you throw the guest middleware on the register route
