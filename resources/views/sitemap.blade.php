<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>www.Newsnarayanganjbd.com</loc>
        <lastmod>2021-03-25T23:14:17+00:00</lastmod>
        <priority>1.00</priority>
    </url>


    @foreach ($categories as $category)
        <url>
            <loc>{{url($category->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($category->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach



    @foreach ($banners as $banner)
        <url>
            <loc>{{url($banner->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($banner->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($posts as $post)
        <url>
            <loc>{{url($post->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($post->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach



</urlset>