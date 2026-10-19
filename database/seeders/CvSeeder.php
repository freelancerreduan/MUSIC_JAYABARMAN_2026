<?php

namespace Database\Seeders;

use App\Models\Affiliation;
use App\Models\CvSection;
use Illuminate\Database\Seeder;

class CvSeeder extends Seeder
{
    public function run(): void
    {
        if (CvSection::exists()) {
            return;
        }

        $affiliations = [
            ['Founder Member', 'Prachyanat (Theatre Group)', 'http://www.prachyanat.com'],
            ['Team Leader', 'Joler Gaan (Musical troupe)', 'http://www.jolergaan.com'],
            ['Trustee', 'Crack International Art Camp', 'http://www.crackbd.org'],
            ['Associate', "Edinburgh Mela Ltd.\nMelange Network UK\nBanglascot Foundation\nPANDAL (Festival Organizer)", null],
        ];
        foreach ($affiliations as $i => [$role, $organization, $url]) {
            Affiliation::create(compact('role', 'organization', 'url') + ['sort_order' => $i]);
        }

        // [title, icon, column, [[heading, type, lines], ...]]
        $sections = [
            ['Work Experience', 'briefcase', 'left', [
                [null, 'timeline', ['2008-2010 | Creative Director, Dhansiri communication ltd, Bangladesh']],
            ]],
            ['Residency Program', 'globe2', 'left', [
                ['Artist in Residency Program (Major)', 'timeline', [
                    '2003 | Eight weeks long residency in Edinburgh festival, Scotland, U.K',
                    '2004 | Two weeks long Residency in Tokyo organized by Japan Foundation, Japan',
                    '2004 | Eight weeks long residency in Edinburgh festival, Scotland, U.K',
                    '2005 | Two weeks long Residency in WIPSA Theatre Festival, India',
                    '2006 | Two weeks long residency in “World Sufi Festival” Glasgow, Scotland, U.K',
                    '2006 | Performed in different concerts in the U.K with “Joler Gaan” (Musical Band)',
                    '2008 | Eight weeks long residency in Brazil organized by Sacatar Foundation, Bahia, Brazil',
                    '2013 | Four weeks long residency in Soundcamp South Asia, Colombo, Sri Lanka',
                    '2014 | A week long residency in Worldtronics, Berlin, Germany',
                    '2014 | Six months long residency in NTOK-CPI-14, Seoul, South Korea',
                    '2010-Present | CRACK International Art Camp, Kustia, Bangladesh',
                ]],
            ]],
            ['Countries visited with Art projects', 'airplane', 'left', [
                [null, 'chips', ['Scotland', 'England', 'Brazil', 'Japan', 'Egypt', 'India', 'Nepal', 'Sri Lanka', 'Germany', 'UAE', 'Vietnam', 'South Korea', 'Australia']],
            ]],
            ['Dedications and Devotions', 'heart', 'left', [
                [null, 'timeline', ['Musical instruments collection', 'Making musical instruments with local elements', 'Research on traditional music and musical instruments', 'Writing, composing, and producing music']],
            ]],
            ['Activities', 'stars', 'left', [
                ['Artistic Collaborations', 'chips', ['Colin Blakey (Scotland)', 'Kim Ho Ip (China/UK)', 'Farzo Abaji (France)', 'Amy Trumppeter (USA)', 'Sacatar Foundation (Brazil)', 'Max Vandervorst (Belgium)', 'Jerome Philip Kavanagh (New Zealand)', 'Komako-Aroha Silva (New Zealand)', 'Refugee Musicians, UNHCR Rohingya camp (Bangladesh)']],
                ['Awards', 'timeline', [
                    '2003 | Honorable Mention Award, Desh Natok, Dhaka',
                    '2004 | Honorable Mention Award, Nagorik Nattyangan, Dhaka',
                    '2004 | Media Best Award, Faculty of Fine Arts, Dhaka',
                    '2007 | Sacatar Foundation Fellowship, USA',
                    '2009 | “Tanusree Podok 2009” Best Young Theater Activist Award',
                    '2014 | NTOK-CPI Fellowship 2014, Seoul, South Korea',
                    '2015 | Best Musical Band, Citycell-Channel I Music Award',
                ]],
                ['Workshops Attended (Major)', 'timeline', [
                    '1996 | Workshop on Puppet and Paper mask conducted by Amy Trumpeter (U.S.A.)',
                    '1999 | Workshop on ‘GRIPS’-Theater Berlin, the idea background and the acting techniques, conducted by Thomas Ahrens (Germany)',
                    '2001 | Musical workshop on ‘Brass Instrument’ organized by International Music School, Dhaka',
                    '2001 | Workshop on ‘Flute (classical)’ conducted by Bari Siddique, Alliance Francaise de Dacca',
                    '2003 | Playwright workshop organized by Bangladesh Group Theater Federation',
                    '2006 | Workshop on Video Art, organized by Britto Art Trust, Dhaka',
                    '2008 | World Perc Pan, Bahia, Brazil',
                    '2008 | Workshop on Digital Filmmaking, organized by British Council, Bangladesh',
                    '2012 | Soundcamp South Asia, Colombo, Sri Lanka',
                    '2013 | Worldtronics, Berlin, Germany',
                    '2010-23 | CRACK International Art Camp, Kustia, Bangladesh',
                ]],
            ]],
            ['Performing Art', 'mask', 'left', [
                ['Actor (on stage)', 'text', ['1. Palakrome Barbar, 2. Adab, 3. Joyjoyonti, 4. Dui Boloder Golpo, 5. Kandte Mana, 6. Circus Circus, 7. Aronay Sangbad, 8. A Man for All Seasons, 9. Koinnya, 10. Bish Panchali, 11. Jontu, 12. Dorir Khela, 13. Jhora Phool, 14. Raja ebong Onnanyo']],
                ['Actor (on screen)', 'text', ['Regularly acted in several Film, Tele Film, Tele Drama & Serials, Performance Art: 1. 2001 - Vomra (Love), 2. 2001 - Mirror Game (Power), 3. 2003 - Pink Man, 4. 2005 - Black & White, 5. 2005 - Mon Monia (Soul), 6. 2008 - “Luz da vida”, 7. 2008 - Lullabai BA.BA, 8. 2010 - To Dear Father, 9. Bells tree, 10. Operation theater, 11. 2011 - Ondorjatra, 12. 2011 to Present - Laaljatra, 13. 2017 - 100% Pure, 14. Made in Bangladesh, 15. Blowing in the Wind']],
                ['Open Air Street Improvisation', 'text', ['1. Boom, 2. Fouj Holt, 3. Ole ole Ola (Bahia), 4. Laaljatra']],
                ['Playwright', 'text', ['1. Bish Panchali, 2. No Man’s Land, 3. Mandar, 4. Laal, 5. 2X2=4, 6. Ural, 7. Shataroop (Based on Tagore)']],
                ['Direction', 'text', ['1. No Man’s Land, 2. Mandar, 3. Sinduk, 4. 2X2=4, 5. Ural']],
                ['Mask and Props Making', 'text', ['1. Iblish, 2. Dhrubo Tara, 3. Circus Circus, 4. Joyjoyonti, 5. Lebedev, 6. Halum Halum, 7. Adab, 8. Bahe Nidhua Pathar']],
                ['Video Art', 'text', ['1. Oh! Dream, 2. The Storyteller, 3. Shadow Opera, 4. Time & Tide, 5. Inner ‘i’, 6. Abuse, 7. Invisible Line, 8. 3rd ‘i’']],
            ]],
            ['Workshops Given (Major)', 'easel', 'right', [
                [null, 'timeline', [
                    '2003 | Workshop on puppet and mask making (2 weeks long), Edinburgh, Scotland',
                    '2003 | Workshop for disabled people on puppet making (1 week long), Edinburgh, Scotland',
                    '2003 | Workshop for senior citizens on making art work and set decoration (1 week long), Edinburgh, Scotland',
                    '2003 | Workshop for school children on making artwork for Mela Festival (2 weeks long), Edinburgh, Scotland',
                    '2004 | Workshop for school children on puppet and mask making (2 weeks long), Edinburgh, Scotland',
                    '2004 | Workshop for people with disabilities on puppet making (1 week long), Edinburgh, Scotland',
                    '2004 | Workshop for school children on making artwork for Mela Festival (2 weeks long), Edinburgh, Scotland',
                    '2004 | Workshop on toy making for people with disabilities with recyclable material (1 week long), Dhaka, Bangladesh',
                    '2006 | Workshop on Music and Art with found materials, Glasgow, Scotland',
                    '2008 | Workshop on theater props making with recyclable material (2 weeks long), Bahia, Brazil',
                    '2008 | Workshop on carnival puppet making with recyclable material (3 weeks long), Bahia, Brazil',
                    '2008 | Workshop on making sculpture with different materials, Itaparica, Brazil',
                    '2008 | Musical Workshop “Lullabai BA.BA”, Itaparica, Bahia, Brazil',
                    '2008 | Musical Workshop with school children, Salvador, Bahia, Brazil',
                    '2008 | Musical Workshop with people with disabilities, Salvador, Bahia, Brazil',
                    'Conducted workshops based on Theater and Music, home and abroad',
                ]],
            ]],
            ['Special Project', 'lightbulb', 'right', [
                [null, 'timeline', [
                    '2003 and 2004 | Making and operating giant puppet for Cavalcade parade, Edinburgh festival, Edinburgh, Scotland',
                    'Site decorations for the Mela Festival in Edinburgh, Scotland',
                    '2003-present | “Candle in the Wind”, site specific installation based on light and sound, has been done 19 times at home and abroad',
                    '2007-present | “Reshaping the Nature”, site specific installation based on natural elements, has been done 5 times at home and abroad',
                    '2012-present | “My body My software”',
                    '2023 | “Blowing in the Wind” multi-medium solo musical performance',
                ]],
            ]],
            ['Major Exhibitions', 'image', 'right', [
                [null, 'timeline', [
                    '1994-2004 | Participated in all annual Art Exhibitions, Institute of Fine Arts, University of Dhaka',
                    '1997-2005 | Participated in all National and International Art Exhibitions, Bangladesh Shilpakala Academy',
                    '1999 | Group Art Exhibition (India-Bangladesh), High Commission of India, Dhaka',
                    '2000 | Group Art Exhibition organized by the Gallery Alternative, Kolkata, India',
                    '2001 | Group Art Exhibition (Japan-Bangladesh), Chiju Art Gallery, Tokyo, Japan',
                    '2002 | Group Art Exhibition (Young artist from Bangladesh), Ibaraki, Japan',
                    '2006 | Video Art Exhibition, organized by Britto Art Trust, Dhaka',
                    '2008 | Group Exhibition, followed by 2 month long Artist Residency, Sacatar Foundation, Brazil',
                    '2006-present | “Longitude-latitude”, an art show based on Dhaka city',
                    '2010-present | One week long residency in CRACK International Art Camp, Kustia, Bangladesh',
                ]],
            ]],
            ['Work Experience as Visual Artist', 'palette', 'right', [
                [null, 'timeline', [
                    '1994-2006 | Worked as an artist and organizer for Bengali New Year festival parade (Mongol Shobha Jatra) from Institute of Fine Art, University of Dhaka',
                    '1994-2005 | Worked as a visual artist and organizer for Victory Day festival from Institute of Fine Art, University of Dhaka',
                    '2002-2004 | Worked as a visual artist for Edinburgh Mela Limited, Edinburgh, Scotland',
                    '2006 | Organized Poush Mela 2006 at The British Council Dhaka, organized by Melange Network Scotland, UK',
                ]],
            ]],
            ['Work Experience as Musician', 'music-note-beamed', 'right', [
                ['Instruments', 'chips', ['Various Wind Instruments', 'Various String Instruments', 'Traditional Percussions']],
                ['Music Compose for the Plays', 'text', ['1. Dhrubo Tara, 2. Circus Circus, 3. A Man for All Seasons, 4. A MidSummer Night’s Dream, 5. Oliver Twist – The Musical, 6. Loha, 7. Jontu, 8. Bish Panchali, 9. Koinnya, 10. Bahe Nidhua Pather, 11. Third Eye, 12. Rhinoceros, 13. Bibaho Britanto, 14. Kandte Mana, 15. Bou Basanti, 16. Macbeth, 17. Musical ensembles composition (1 hour) for open air concert, 18. Punorjonmo, 19. Mayer Mukh, 20. Phool, Pakhi, 21. Nodirgaan (musical performance)']],
                ['Music Compose for the Films', 'text', ['1. Chip (Beta Format), 2. Phool Kumar (16 mm), 3. Porshi (Documentary), 4. Bishoroner Nodi – The Little River Lithe (16 mm), 5. Circle (16 mm), 6. Photograph (16 mm), 7. Jamdani (docu), 8. Shishuk (river Dolphin), 9. Common Gender. Regularly composes background score, jingle and OST for Ad Film, Tele Film, Tele Drama & Serials.']],
                ['Album', 'timeline', ['2013 | Otol Joler Gaan', '2014 | Patalpurer Gaan', '2018 | Noyon Joler Gaan', 'Pinjira (unreleased)']],
                ['Membership', 'text', ['1997 - Prachyanat, 1995-1997: Aranyok Natya Dal, 1991-1997: Darpan Theater, Melange Network, Joler Gaan']],
            ]],
            ['Website Link', 'link-45deg', 'right', [
                [null, 'links', [
                    'www.sufifestival.org | http://www.sufifestival.org',
                    'www.sacatar.org | http://www.sacatar.org',
                    'www.jolergaan.com | http://www.jolergaan.com',
                    'www.ntok.go.kr | http://www.ntok.go.kr',
                    'www.prachyanat.com | http://www.prachyanat.com',
                    'www.crackbd.org | http://www.crackbd.org',
                ]],
            ]],
        ];

        foreach ($sections as $i => [$title, $icon, $column, $blocks]) {
            $section = CvSection::create(['title' => $title, 'icon' => $icon, 'column' => $column, 'sort_order' => $i]);
            foreach ($blocks as $j => [$heading, $type, $lines]) {
                $section->blocks()->create(['heading' => $heading, 'type' => $type, 'content' => implode("\n", $lines), 'sort_order' => $j]);
            }
        }
    }
}
