<x-layouts.base>
  @foreach($posts as $post)
    <x-partials.post :$post/>
  @endforeach
</x-layouts.base>