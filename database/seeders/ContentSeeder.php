<?php

namespace Database\Seeders;

use App\Models\Concert;
use App\Models\FeaturedWork;
use App\Models\MediaItem;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        if (Video::exists()) {
            return; // content already there, don't duplicate
        }

        FeaturedWork::create(['title' => 'প্যারিসে লোকগানের দ্যুতি', 'source' => 'Jugantor', 'image' => 'assets/img/jaya-live.jpg', 'image_position' => '50% 20%', 'link' => 'https://www.facebook.com/share/v/1Fzy7mioQ4/', 'is_bangla' => true, 'sort_order' => 1]);
        FeaturedWork::create(['title' => 'Din Protidin', 'source' => 'Bangla Vision', 'image' => 'assets/img/jaya-duo.jpg', 'image_position' => '60% 50%', 'link' => 'https://youtu.be/HSO6v9n220w', 'sort_order' => 2]);

        Concert::create([
            'eyebrow' => 'Solo concert',
            'title' => 'World Music Day 2026',
            'event_date' => '2026-06-21',
            'location' => 'Aubervilliers, France',
            'genres' => 'Semi-classical, Hindi ghazal, Bengali romantic, Bengali folk, rock',
            'excerpt' => 'A solo concert in Aubervilliers, France – semi-classical music, Hindi ghazals, romantic Bengali songs, Bengali folk and even rock, all in one evening.',
            'image' => 'assets/img/portrait.jpg',
            'is_featured' => true,
            'body' => implode("\n", [
                '<p>On <b>World Music Day 2026</b>, Jaya Barman presented a special <b>solo concert in Aubervilliers, France</b>, marking an important moment in her journey as a versatile live performer.</p>',
                '<p>The concert showcased the full range of Jaya’s musical personality. Rather than limiting the evening to a single genre, she took the audience on a musical journey through <b>semi-classical music, Hindi ghazals, romantic Bengali songs, Bengali folk music and even rock songs</b>.</p>',
                '<p>Her repertoire reflected both her classical training and her openness to different musical traditions. From the refinement and depth of semi-classical compositions to the emotional expression of Hindi ghazals, the warmth of Bengali romantic music, the earthy character of Bengali folk songs and the energy of rock, Jaya demonstrated her ability to move comfortably between contrasting musical styles.</p>',
                '<p>The concert was particularly significant because it was presented as a <b>solo performance</b>, placing Jaya’s voice and artistic interpretation at the centre of the evening. It reflected her belief that a singer should not be confined to one genre, but should be able to explore different musical expressions while maintaining her own identity.</p>',
                '<p>For Jaya, music has always been a journey of exploration. Her training in Indian classical music provides the foundation for her singing, while her love for Bengali folk, romantic music and other international influences continues to shape her evolving artistic identity.</p>',
                '<p>The World Music Day concert therefore became a reflection of <b>Jaya Barman as an artist – rooted in Bengali culture, trained in Indian classical music, raised in the multicultural environment of Paris, and open to the musical languages of the world.</b></p>',
            ]),
            'quote' => 'Through this performance, she once again expressed her larger artistic vision: to celebrate musical diversity while bringing the richness and emotion of Bengali music to audiences around the world.',
        ]);

        // Performance videos (also shown on the Project page)
        $videos = [
            [
                'title' => 'Ami Tor Piriter Mora', 'title_bn' => 'আমি তোর পিরিতের মরা', 'meta' => 'Bengali folk',
                'video_url' => 'assets/video/performance-01.mp4', 'credit' => 'Bengali folk · associated with Bari Siddiqui',
                'in_project' => true, 'in_performance' => true, 'sort_order' => 1,
                'body' => '<p><em>“Ami Tor Piriter Mora”</em> (<span class="bn">আমি তোর পিরিতের মরা</span>) is a deeply emotional Bengali folk song associated with the folk tradition of Bengal. The song is widely known through the rendition of legendary folk singer <b>Bari Siddiqui</b>, whose distinctive voice gave the song a special place among Bengali folk lovers.</p>
<p>The song expresses the pain, devotion and helplessness of a lover who is completely consumed by love. Its simple yet powerful lyrics capture the essence of Bengali folk music – love, longing, separation and deep emotional surrender.</p>
<p>For Jaya Barman, performing this song is a way of celebrating the richness of Bengali folk heritage and bringing its timeless emotions to audiences beyond Bangladesh.</p>',
            ],
            [
                'title' => 'Prem Kolonker Jwala Koto Re', 'title_bn' => 'প্রেম কলঙ্কের জ্বালা কত রে', 'meta' => 'Bengali folk',
                'video_url' => 'assets/video/performance-02.mp4', 'credit' => 'Bengali folk · written by Delwar Hossain Jahangir',
                'in_project' => true, 'in_performance' => true, 'sort_order' => 2,
                'body' => '<p>Jaya Barman chose <span class="bn">“প্রেম কলঙ্কের জ্বালা কত রে”</span>, written by <b>Delwar Hossain Jahangir</b>, for its deeply emotional expression of love, longing and separation – emotions that lie at the very heart of Bengali folk music. The song, widely performed by folk singers including <b>Rai Mallika</b>, reflects the timeless soul and simplicity of Bengal’s folk tradition.</p>',
            ],
            [
                'title' => 'Bengali Folk on Ranga Shokal', 'title_bn' => 'রাঙা সকাল · মাছরাঙা টেলিভিশন', 'meta' => 'Maasranga Television',
                'video_url' => 'assets/video/performance-03.mp4', 'credit' => 'Maasranga Television · song by Radha Raman Datta',
                'in_project' => true, 'in_performance' => true, 'sort_order' => 3,
                'body' => '<p>Jaya Barman’s appearance on <b>Maasranga Television’s</b> popular programme <em>Ranga Shokal</em> offered her a special opportunity to showcase one of the most important parts of her musical identity – her deep love for <b>Bengali folk music</b>.</p>
<p>For this appearance, Jaya consciously chose to focus on Bengali folk songs, rather than presenting a mixed repertoire. Her intention was to introduce the audience to the richness, emotion and simplicity of Bengal’s folk tradition through her own interpretation.</p>
<p>Among the songs she performed was <em>“Kalay Pranti Nilo Banshiti Bajaiya,”</em> a beloved folk composition associated with <b>Radha Raman Datta</b>, one of the great figures of Bengali folk and devotional music. Through this performance, Jaya sought to preserve the traditional character of the song while bringing her own vocal expression and musical training to it.</p>
<p>The performance was particularly meaningful to Jaya because Bengali folk music remains very close to her heart.</p>',
            ],
            [
                'title' => 'Bhalo Achhi, Bhalo Theko', 'title_bn' => 'ভালো আছি, ভালো থেকো', 'meta' => 'Bengali romantic',
                'video_url' => 'assets/video/performance-04.mp4', 'credit' => 'Bengali romantic · words and music by Rudra Mohammad Shahidullah',
                'in_project' => true, 'in_performance' => true, 'sort_order' => 4,
                'body' => '<p><span class="bn">“ভালো আছি, ভালো থেকো”</span> is a celebrated Bengali song written and composed by the renowned poet <b>Rudra Mohammad Shahidullah</b> (<span class="bn">রুদ্র মুহম্মদ শহিদুল্লাহ</span>). The song was later popularized through performances by <b>Andrew Kishore</b> and <b>Kanak Chapa</b>, in the album <em>Tomakey Chai</em>, with music arranged by <b>Ahmed Imtiaz Bulbul</b>. The song expresses love, separation, longing and an enduring emotional connection, capturing the delicate beauty of Bengali romantic music. Jaya Barman chose to perform it because of its deep poetic emotion and timeless place in Bengali musical culture.</p>',
            ],
            ['title' => 'World Music Day 2026', 'meta' => 'Live in Aubervilliers, Paris', 'video_url' => 'assets/video/project-01.mp4', 'in_project' => true, 'sort_order' => 5],
            ['title' => 'World Music Day 2026', 'meta' => 'Live broadcast · Shobdo Taranga, Paris', 'video_url' => 'assets/video/project-02.mp4', 'in_project' => true, 'sort_order' => 6],
            ['title' => 'World Music Day 2026', 'meta' => 'Live broadcast · Shobdo Taranga, Paris', 'video_url' => 'assets/video/project-03.mp4', 'in_project' => true, 'sort_order' => 7],
        ];
        foreach ($videos as $v) {
            Video::create($v);
        }

        $media = [
            ['interview', 'Agamir Shomoy', 'প্যারিসে লোকগীতিকন্যা জয়া বর্মণ', 'Agamir Shomoy Entertainment', 'https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Freel%2F1483935276751986%2F&show_text=false&width=560', 'https://www.facebook.com/reel/1483935276751986', 'Facebook'],
            ['interview', 'Jugantor', 'প্যারিসে লোকগানের দ্যুতি ছড়াচ্ছেন বাংলাদেশের জয়া', 'Jugantor Entertainment', 'https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Freel%2F1777172319967304%2F&show_text=false&width=560', 'https://www.facebook.com/share/v/1F1nhjvLa6/', 'Facebook'],
            ['news', 'Bangla Vision', 'দিন প্রতিদিন · Din Protidin', 'BanglaVision, 08 Aug 2026', 'https://www.youtube-nocookie.com/embed/HSO6v9n220w', 'https://youtu.be/HSO6v9n220w', 'YouTube'],
            ['news', 'Channel i', 'বিনোদন আড্ডায় সংগীতশিল্পী জয়া বর্মণ', 'Binodon Adda', 'https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Freel%2F37173789118935431%2F&show_text=false&width=560', 'https://www.facebook.com/share/v/1J9rU9dKek/', 'Facebook'],
        ];
        foreach ($media as $i => [$type, $source, $title, $meta, $embed, $link, $label]) {
            MediaItem::create(compact('type', 'source', 'title', 'meta') + ['embed_url' => $embed, 'link_url' => $link, 'link_label' => $label, 'sort_order' => $i]);
        }

        $photos = [
            ['assets/img/world-music-day.jpg', 'World Music Day 2026 solo concert'],
            ['assets/img/jaya-live.jpg', 'Jaya Barman singing'],
            ['assets/img/jaya-garden.webp', 'Jaya Barman in a garden with a guitarist'],
            ['assets/img/jaya-duo.jpg', 'Jaya Barman with a fellow artist'],
        ];
        foreach ($photos as $i => [$image, $caption]) {
            Photo::create(['image' => $image, 'caption' => $caption, 'category' => 'project', 'sort_order' => $i]);
        }
    }
}
