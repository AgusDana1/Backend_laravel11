<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>
<body>
    <ul>
        @foreach ($posts as $post)
        <li>
            <h4>{{ $post->title }}</h4>
            <p>{{ $post->content }}</p>
            @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Image for {{ $post->title }}" style="max-width: 200px;">
            @endif
        </li>
        @endforeach
    </ul>
</body>
</html>