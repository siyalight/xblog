<html>
<head>
    <title>{{ $post->title }}</title>
    <style>
        .container{
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="container">
    {!! $post->html_content !!}
</div>
</body>
</html>
