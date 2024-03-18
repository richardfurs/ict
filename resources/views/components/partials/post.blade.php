<div id="current-post-{{$post->id}}" class="mb-8 bg-slate-50 p-8 max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-6">
  @if(Auth::check() && $post->user->id == Auth::id())
    <div class="flex justify-end">
      <a href="/posts/{{$post->id}}/edit" class="cursor-pointer flex max-w-16 justify-center rounded-md bg-green-600 py-1.5 text-sm font-semibold text-white hover:bg-green-800 px-5">Edit</a>
      <button onClick="deletePost({{$post->id}})" class="cursor-pointer flex max-w-16 justify-center rounded-md bg-red-600 py-1.5 text-sm font-semibold text-white hover:bg-red-800 ml-1 px-5">Delete</button>
    </div>
  @endif
  @if(count($post->categories) > 0)
    <div class="text-sm font-semibold mt-1">Categories</div>
    <div>
      @foreach($post->categories as $category)
        <span>
          {{$category->name}}
          @if(!$loop->last), @endif
        </span>
      @endforeach
    </div>
  @endif
  <div class="text-sm font-semibold mt-1">Author: <span class="text-slate-500 font-light">{{$post->user->name}}</span></div>
  <p class="block mt-1 text-lg leading-tight font-medium text-black">{{$post->title}}</p>
  <p class="mt-2 text-slate-500">{{$post->content}}</p>
  <p class="text-slate-300 text-right">{{date('d-m-Y H:i', strtotime($post->created_at))}}</p>

  @if(count($post->comments) > 0)
    <p class="block text-sm font-medium leading-6 text-gray-900">Comments</p>
    <div id="comments-{{$post->id}}">
      @foreach($post->comments as $comment)
        <x-partials.comments :$comment/>
      @endforeach
    </div>
  @endif

  @if(Auth::check())
    <div>
      <div class="flex items-center justify-between">
        <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">Add comment</label>
      </div>
      <div class="mt-2">
        <textarea id="comment-{{$post->id}}" name="comment" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{old('content')}}</textarea>
      </div>
      @error('text')
        <span class="text-red-500 text-xs" role="alert">
            {{ $message }}
        </span>
      @enderror
      <div class="flex justify-end">
        <div class="flex justify-end mt-1">
          <button onClick="addComment({{$post->id}})" id="add-comment-btn" class="cursor-pointer flex max-w-16 justify-center rounded-md bg-blue-600 py-1.5 text-sm font-semibold text-white hover:bg-blue-800 ml-1 px-5">Add</button>
        </div>   
      </div>
    </div>
  @endif
</div>