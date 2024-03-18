<nav class="bg-gray-800 sticky top-0">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="hidden sm:block">
          <div class="flex space-x-4">
            <a href="/" class="@if(Route::currentRouteName() == 'posts') bg-gray-900 @endif hover:bg-gray-700 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">All posts</a>
            @if(Auth::check())
              <a href="/posts/create" class="@if(Route::currentRouteName() == 'create') bg-gray-900 @endif text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Create post</a>
            @endif
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:pr-0">
        <form action="/search" class="flex" method="POST">
          @csrf
          <input value="{{old('search')}}" name="search" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          <button type="submit" class="hover:bg-gray-700 text-white rounded-md px-3 py-2 text-sm font-medium cursor-pointer ml-1">Search</button>
        </form>
        @if(Auth::check())
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Sign Out</a>
        </form>
        @else
          <a href="/login" class="@if(Route::currentRouteName() == 'login') bg-gray-900 @endif text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Sign in / Sign up</a>
        @endif
        </div>
      </div>
    </div>
  </div>

  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <a href="#" class="bg-gray-900 hover:bg-gray-700 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">All posts</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">My posts</a>
      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Create post</a>
    </div>
  </div>
</nav>
