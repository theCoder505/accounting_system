<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>

        <title>Newsnarayanganjbd </title>
        <link>www.Newsnarayanganjbd.com </link>
        <description><![CDATA[Newsnarayanganjbd - Get Your News Update At 24 Hours ]]></description>
        <!-- <atom:link href=" www.Newsnarayanganjbd.com " rel="self" type="application/rss+xml" /> -->
        <language>en </language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($categories as $category)
            <item>
                <title><![CDATA[{{ $category->name }}]]></title>
                <link>https://www.Newsnarayanganjbd.com/{{ $category->slug }}</link>
                <description><![CDATA[{!! $category->meta_des !!}]]></description>
                <guid>{{ $category->id }}</guid>
                <pubDate>{{ $category->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach




        @foreach($banners as $banner)
            <item>
                <title><![CDATA[{{ $banner->title }}]]></title>
                <link>https://www.Newsnarayanganjbd.com/{{ $banner->slug }}</link>
                <description><![CDATA[{!! $banner->description !!}]]></description>
                <guid>{{ $banner->id }}</guid>
                <pubDate>{{ $banner->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach

        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>https://www.Newsnarayanganjbd.com/{{ $post->slug }}</link>
                <description><![CDATA[{!! $post->meta_description !!}]]></description>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach




    </channel>
</rss>