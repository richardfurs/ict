<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Blog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
  </head>

  <body>
      <x-partials.navigation />

      <div class="flex flex-col min-h-screen">

        <main class="flex-grow">
          {{ $slot }}
        </main>

        <x-partials.footer />

      </div>

      
  </body>
</html>

<script>
  async function addComment(id) {
    const commentText = document.getElementById(`comment-${id}`).value;
    const options = {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      body: JSON.stringify({
        text: commentText,
        user_id: "{{Auth::id()}}",
        post_id: id
      })
    };
    try {
        const response = await fetch(`/posts/${id}/comments/add`, options);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const html = await response.json().then(html => {
          const comments = document.getElementById(`comments-${id}`);
          const div = document.createElement('div');
          div.innerHTML = html;
          comments.appendChild(div);
          document.getElementById(`comment-${id}`).value = '';
        });

    } catch (error) {
        console.error('Error fetching data:', error.message);
        throw error;
    }
  }

  async function deletePost(id) {
    const options = {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
      }
    };
    try {
        const response = await fetch(`/posts/delete/${id}`, options);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        const currentPost = document.getElementById(`current-post-${id}`);
        currentPost.remove();
    } catch (error) {
        console.error('Error fetching data:', error.message);
        throw error;
    }
  }

  async function deleteComment(id) {
    const options = {
      method: 'DELETE',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
      }
    };
    try {
        const response = await fetch(`/posts/comments/${id}/delete`, options);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        const currentComment = document.getElementById(`current-comment-${id}`);
        currentComment.remove();
    } catch (error) {
        console.error('Error fetching data:', error.message);
        throw error;
    }
  }
</script>