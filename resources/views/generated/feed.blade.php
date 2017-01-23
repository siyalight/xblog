<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $site_title or 'Xblog' }}</title>
        <description>{{ $description or 'Description' }}</description>
        <link>{{ url('/') }}</link>
        <atom:link href="{{ url('/feed.xml') }}" rel="self" type="application/rss+xml"/>
        <?php
        $date = !empty($posts) ? $posts[0]->updated_at->format('D, d M Y H:i:s T') : date("D, d M Y H:i:s T", time())
        ?>
        <pubDate>{{ $date }}</pubDate>
        <lastBuildDate>{{ $date }}</lastBuildDate>
        <generator>lufficc</generator>
        @foreach ($posts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <link>{{ route('post.show',$post->slug) }}</link>
                <description>{{ $post->description }}</description>
                <pubDate>{{ $post->created_at->format('D, d M Y H:i:s T') }}</pubDate>
                <author>{{ $author or 'Author' }}</author>
                <guid>{{ route('post.show',$post->slug) }}</guid>
                <category>{{ $post->category->name }}</category>
            </item>
        @endforeach
    </channel>
</rss>