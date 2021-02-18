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

## Relationships

You can make a relationship like this:
$table->integer('user_id')->unsigned()->index();

Or:

$table->foreignId('user_id')->constrained()->onDelete('cascade');

onDelete('cascade') means if the user is deleted all the user posts are also deleted

so you can post many posts add this to the User model  
public function posts()
{
return $this->hasMany(Post::class);
}

Then add this to the PostController

    class PostController extends Controller

{
public function index()
{
return view('posts.index');
}

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $request->user()->posts()->create([ <----- This creates the post
            'body'=> $request->body
        ]);

        return back();
    }

    So you get the posts() out of user() and create a new post inside the posts() model
