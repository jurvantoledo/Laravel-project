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

onDelete('cascade') means if the user is deleted all the posts the user submitted are also deleted

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

## Pagination

{{ $posts->links() }} This creates the pagination for you

## Factories

use: php artisan tinker in your terminal
then: App\Models\Post::factory()->times(200)->create(['user_id' => 2]);

setup definition in factory

EXAMPLE:
@return array
\*/
public function definition()
{
return [
'body' => $this->faker->sentence(20), // 20 stays for 20 words
];
}
}

So now if we run App\Models\Post::factory()->times(200)->create(['user_id' => 2]); in the terminal that's gonna generate a list of 200 posts assinging the user_id of 2

You can use factories for:

-   generating lot of fake data in once
-   testing

## Liking & Unliking posts

<div class="flex items-center">
  So if the post is liked by a user show the first form else show the second one
  @if (!$post->likedBy(auth()->user()))
    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
      @csrf
      <button type="submit" class="text-blue-500">Like</button>
    </form>
  @else
    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1"> 
    @csrf
    @method('DELETE')
    <button  type="submit" class="text-blue-500">Unlike</button>
  </form>
  @endif

this will count the amount of likes on a post
<span>{{ $post->likes->count() }} {{ Str::plural('like',$post->likes->count()) }}</span>

Str::plural will pluralise the Like to Likes if there is more then 1 Like

</div>

1. You can bind models using $id in the route and finding the right $id

2. by using the Post model in the controller link it through $post and say you want to find the $id. If you choose for the second option dont forget to add in your Like model: protected $fillable = [
   'user_id'
   ];

you need to use the @method('DELETE') in your blade to actually delete something
