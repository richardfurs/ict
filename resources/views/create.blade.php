<x-layouts.base>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create post</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/posts" method="POST">
        @csrf
        <div>
          <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
          <div class="mt-2">
            @foreach($categories as $category)
              <input class="mr-1" name="categories[]" type="checkbox" value="{{$category->id}}">{{$category->name}}</input>
            @endforeach
          </div>
        </div>
        <div>
          <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
          <div class="mt-2">
            <input value="{{old('title')}}" id="title" name="title" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        @error('title')
          <span class="text-red-500 text-xs" role="alert">
              {{ $message }}
          </span>
        @enderror

        <div>
          <div class="flex items-center justify-between">
            <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Content</label>
          </div>
          <div class="mt-2">
            <textarea id="content" name="content" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{old('content')}}</textarea>
          </div>
        </div>
        @error('content')
          <span class="text-red-500 text-xs" role="alert">
              {{ $message }}
          </span>
        @enderror

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
        </div>
      </form>
    </div>
  </div>
</x-layouts.base>