<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Doctors Posts</title>

<style>
    /* Reset some default styles for consistency */
    *, *::before, *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Overall body styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #fff7f0, #ffe4b5);
        color: #333;
        line-height: 1.6;
        padding: 20px;
    }

    /* Header style */
    h1 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.5rem;
        color: #2c3e50;
        letter-spacing: 2px;
    }

    /* Posts container */
    .posts-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 900px;
        margin: 0 auto 40px;
        padding: 10px;
    }

    /* Individual post style */
    .post {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        padding: 25px;
        margin-bottom: 30px;
        width: 100%;
        transition: box-shadow 0.3s, transform 0.2s;
    }

    .post:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    /* Post title */
    .post h2 {
        font-size: 1.75rem;
        color: #34495e;
        margin-bottom: 15px;
        font-weight: 600;
    }

    /* Post description */
    .post p {
        font-size: 1rem;
        color: #555;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    /* Like/Dislike button styles */
    .like-dislike {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-top: 15px;
    }

    button {
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s, box-shadow 0.2s, transform 0.1s;
    }

    button:hover {
        background-color: #2980b9;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    /* Comment section styles */
    .comments {
        margin-top: 25px;
        padding-left: 10px;
        border-left: 4px solid #dfe6e9;
        background-color: #f1f2f6;
        border-radius: 8px;
        padding: 15px;
        transition: background-color 0.2s ease;
    }

    /* Individual comment style */
    .comment {
        background-color: #fff;
        padding: 15px 20px;
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        position: relative;
        transition: background-color 0.2s;
    }

    .comment:hover {
        background-color: #f9f9f9;
    }

    /* Comment text and info */
    .comment p {
        margin: 4px 0;
        font-size: 0.9rem;
        color: #636e72;
    }

    /* Button inside comments for reply toggle */
    button[type="button"] {
        margin-top: 10px;
        background-color: #e67e22;
        padding: 8px 14px;
        font-size: 0.9rem;
        border-radius: 6px;
    }

    button[type="button"]:hover {
        background-color: #d35400;
    }

    /* Reply form styles */
    form {
        margin-top: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #2980b9;
        box-shadow: 0 0 8px rgba(41, 128, 185, 0.2);
    }

    /* Submit button inside forms */
    form button {
        align-self: flex-start;
        background-color: #ca890f;
        padding: 10px 15px;
        font-size: 1rem;
        border-radius: 8px;
    }

    form button:hover {
        background-color: #b98c13;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transform: translateY(-1px);
    }

    /* Replies container styles */
    .reply {
        background-color: #fdfdfd;
        padding: 12px 16px;
        margin-top: 10px;
        border-left: 3px solid #3498db;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        font-size: 0.9rem;
        transition: background-color 0.2s;
    }

    .reply:hover {
        background-color: #f4f4f4;
    }

    /* Small utility styles for spacing */
    button + form {
        margin-top: 8px;
        display: inline-block;
    }
</style>
</head>
<body >
    <a href="{{ url()->previous() }}" class="btn btn-secondary go-back-btn">Go Back</a>
    <div class="d-flex justify-content-end">
        <a style="align-items: left;" href="{{ route('addPost') }}" class="btn btn-primary">+ Add New Post</a>
    </div>
    <div class="d-flex justify-content-end mt-4">
        <a style="align-items: left;" href="{{ route('myDeletedPosts') }}" class="btn btn-danger"> Deleted Posts</a>
    </div>

<h1>My Posts</h1>



@foreach ($posts as $post)

<div class="posts-container">

    <div class="post">
        <div class="d-flex justify-content-end">

            <a href="{{ route('editPost',['id'=>$post->id]) }}" class="btn btn-secondary btn-sm m-2">Edit the post</a>

            <form action="{{ route('post.softDelete',['id'=>$post->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
            </form>
        </div>
        <p><b>By : {{ \App\Models\User::find($post->doctor_id)->name }}</b></p>

        <h2>{{ $post->title }}</h2>
        <p>{{ $post->description }}</p>
        <a href="{{ $post->link_source }}">{{ $post->link_source }}</a><br><br>
         <img src="{{ asset('storage/' . $post->image) }}" alt="image" />

        @php
            $like = \App\Models\Like::where('patient_id', auth()->user()->id)
                ->where('post_id', $post->id)
                ->first();
        @endphp

<div class="d-flex justify-content-start mb-3">
    <span class="mr-3">👍 Likes: {{   0 }}</span>
    <span class="mr-3">💬 Comments: {{   0 }}</span>
  </div>


        <!-- Like / Dislike Buttons -->
        {{-- @if (!$like)
        <form method="POST" action="{{ route('createLike', ['post_id' => $post->id]) }}">
            @csrf
            <button type="submit">Like</button>
        </form>
        @else
        <form method="POST" action="{{ route('disLike', ['post_id' => $post->id]) }}">
            @method('DELETE')
            @csrf
            <button type="submit" style="background-color:#e74c3c;">Dislike</button>
        </form>
        @endif --}}


        <!-- Add Comment -->
        <form method="POST" action="{{ route('comment.store',['post_id'=>$post->id]) }}" style="margin-top:15px;">
            @csrf
            <input type="text" name="description" placeholder="Add a comment" required>
            <button type="submit">Submit</button>
        </form>

        <!-- Toggle Comments Button -->
        <div style="margin-top:20px;">
            <button onclick="toggleComments('comments-{{ $post->id }}')">Show Comments</button>
        </div>

        <!-- Comments Section -->
        <div id="comments-{{ $post->id }}" style="display:none; margin-top:15px;">
            <div class="comments">
                @foreach ($post->comments as $comment)
                <div class="comment">
                    <p>{{ $comment->description }}</p>
                    <p>— By: {{ \App\Models\User::find($comment->patient_id)->name }}</p>
                    <p>Created at: {{ $comment->created_at }}</p>
                    <p>Replies: {{ $comment->replyComment_id }}</p>

                    <!-- Reply toggle button -->
                    <button type="button" onclick="toggleReplies('replies-{{ $comment->id }}')">Show Replies</button>

                    <!-- Replies list -->
                    <div id="replies-{{ $comment->id }}" style="display:none; margin-left:20px; margin-top:10px;">
                        @foreach ($post->comments->where('replyComment_id', $comment->id) as $reply)
                        <div class="reply">
                            {{ $reply->description }}
                            <p>— By: {{ \App\Models\User::find($reply->patient_id)->name }}</p>
                            <p>Created at: {{ $reply->created_at }}</p>
                        </div>
                        @endforeach
                    </div>

                    <!-- Reply form -->
                    <form method="POST" action="{{ route('comment.store',['post_id'=>$post->id]) }}" style="margin-top:8px;">
                        @csrf
                        <input type="hidden" name="replyComment_id" value="{{ $comment->id }}">
                        <input type="text" name="description" placeholder="Add a Reply" required>
                        <button type="submit" style="background-color:#2980b9;">Reply</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach

<script>



    function toggleComments(commentSectionId) {
        const section = document.getElementById(commentSectionId);
        section.style.display = (section.style.display === "none") ? "block" : "none";
    }

    function toggleReplies(id) {
        const element = document.getElementById(id);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>
@if(session('message'))
<script>
    alert('{{ session('message') }}');
</script>
@endif
</body>
</html>
