<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Missing keys only: values changed in the admin panel are kept
        $defaults = [
            'site_name' => 'Jaya Barman',
            'site_tagline' => 'spirit U all',
            'meta_description' => 'Jaya Barman: musician, visual artist and actor from Dhaka, Bangladesh.',
            'phone' => '+8801711046714',
            'phone_display' => '+880 1711 046714',
            'whatsapp' => '8801711046714',
            'email' => 'tukuli17@gmail.com',
            'location' => 'Dhaka, Bangladesh',
            'facebook' => '',
            'instagram' => '',
            'spotify' => '',
            'youtube' => '',
            'footer_credit_text' => 'SMART BD HOST',
            'footer_credit_url' => '',
            'profile_roles' => 'Musician|Visual Artist|Actor',
            'profile_title' => 'Actor, Musician and Visual Artist',
            'portrait' => 'assets/img/portrait.jpg',
            'home_intro' => implode("\n\n", [
                'Jaya Barman is a distinguished visual artist, actor, and professional musician, with a Master of Fine Arts degree from the University of Dhaka. Jaya currently serves as the lead member of <a href="http://www.jolergaan.com" target="_blank" rel="noopener">Joler Gaan</a>, a musical group based in Dhaka, Bangladesh, while also engaging in television, film, and stage productions. Jaya is also a lead actor and musician with <a href="http://www.prachyanat.com" target="_blank" rel="noopener">Prachyanat</a>, a prominent theater group recognized for its impactful social commentary.',
                'Jaya identifies as a child of the soil, drawing inspiration from the rivers that cleanse and carry the gentle, soothing symphonies of nature. On contemplative nights, dreams navigate like a boat across these fertile lands, fueled by a profound curiosity regarding the melodies of the natural world. Jaya is particularly passionate about composing songs, designing innovative musical instruments, and delving into digital film and multimedia art.',
                'Jaya has participated in various residency programs across the UK, Germany, Sri Lanka, Japan, India, South Korea, Nepal, Vietnam, Egypt, and Brazil. Over the years, Jaya has collaborated on numerous projects with esteemed artists and organizations, including Colin Blakey from the UK, Farzo Abaji from France, Amy Trumppetar from the USA, Sacatar Foundation from Brazil, Jerome Philip Kavanagh and Komako-Aroha Silva from New Zealand, and Max Vandervorst from Belgium.',
                'Jaya firmly believes in the transformative power of art and its capacity to forge connections among diverse cultures and experiences. Through this work, Jaya aspires to inspire others to discover their own voices and articulate their unique narratives. Everyone is invited to join this artistic journey to explore the beauty of creativity together.',
            ]),
            'contact_subjects' => "Performance booking\nCollaboration\nWorkshop\nExhibition\nOther",
            'contact_intro' => 'For performances, collaborations, workshops and exhibitions.',
        ];
        foreach ($defaults as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
        \Illuminate\Support\Facades\Cache::forget('settings');

        $pages = [
            ['home', 'Home', null, 'Jaya Barman', '… spirit <b>U</b> all …', 'assets/img/hero.jpg', null],
            ['project', 'Project', 'Works', 'Project', 'Music, stage and screen – featured work, videos and photos.', 'assets/img/world-music-day.jpg', 'center 30%'],
            ['performance', 'Performance', 'Live & on screen', 'Performance', null, 'assets/img/portrait.jpg', null],
            ['interview', 'Interview', 'Video', 'Interview', null, 'assets/img/stage-02.jpg', null],
            ['news-views', 'News & Views', 'Press & TV', 'News & Views', null, 'assets/img/stage-05.jpg', null],
            ['portfolio', 'Portfolio', 'Selected Works', 'Portfolio', null, 'assets/img/stage-06.jpg', null],
            ['archive', 'Archive', 'Past work', 'Archive', null, 'assets/img/stage-04.jpg', null],
            ['about', 'About', 'About Me', 'Jaya Barman', 'Actor, Musician and Visual Artist', 'assets/img/portrait.jpg', null],
            ['contact', 'Contacts', 'Get in touch', 'Contacts', 'For performances, collaborations, workshops and exhibitions.', 'assets/img/stage-02.jpg', null],
        ];

        foreach ($pages as $i => [$slug, $label, $eyebrow, $title, $subtitle, $image, $position]) {
            Page::firstOrCreate(['slug' => $slug], [
                'nav_label' => $label,
                'eyebrow' => $eyebrow,
                'title' => $title,
                'subtitle' => $subtitle,
                'hero_image' => $image,
                'hero_position' => $position,
                'show_in_nav' => true,
                'sort_order' => $i,
            ]);
        }
    }
}
