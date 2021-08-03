<x-layout>

    <x-slot name="title">
        My Todo
    </x-slot>


    <h1>
        <span>My Todo</span>
        <a href="{{ route ('posts.create') }}">[Add New]</a>
    </h1>
    <ul>
        @forelse ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">
                    {{ $post->title }}
                </a>
                <a class="edit" href="{{ route('posts.edit', $post)}}">[Edit]</a>
                <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
                    @method('DELETE')
                    @csrf

                    <button class="btn">[x]</button>
                </form>
            </li>
        @empty
            <li>No posts yet</li>
        @endforelse
    </ul>
    <script>
        'use strict';

        {
            document.getElementById('delete_post').addEventListener('submit', e =>{
                e.preventDefault();

                if(!confirm('sure to delete?')) {
                    return;
                }

                e.target.submit();
            });
        }
    </script>
</x-layout>
