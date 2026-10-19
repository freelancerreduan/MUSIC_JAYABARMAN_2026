<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        // One row per public page: hero texts, background and SEO
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nav_label');
            $table->string('eyebrow')->nullable();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_position')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('show_in_nav')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Project page: big clickable cards
        Schema::create('featured_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('source')->nullable();
            $table->string('image');
            $table->string('image_position')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_bangla')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_bn')->nullable();
            $table->string('meta')->nullable();
            $table->longText('body')->nullable();
            $table->string('credit')->nullable();
            $table->string('video_url');
            $table->string('poster')->nullable();
            $table->boolean('in_project')->default(true);
            $table->boolean('in_performance')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('title');
            $table->date('event_date')->nullable();
            $table->string('location')->nullable();
            $table->string('genres')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->text('quote')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Interview + News & Views (embedded videos with a link)
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index();
            $table->string('source')->nullable();
            $table->string('title');
            $table->string('meta')->nullable();
            $table->text('embed_url')->nullable();
            $table->text('link_url')->nullable();
            $table->string('link_label')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->string('category')->index();
            $table->string('tag')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('archive_items', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // About page: "Current status" cards
        Schema::create('affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->text('organization');
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // About page: CV sections, each holding blocks of lines
        Schema::create('cv_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->nullable();
            $table->string('column')->default('left');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('cv_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cv_section_id')->constrained()->cascadeOnDelete();
            $table->string('heading')->nullable();
            $table->string('type')->default('timeline');
            $table->longText('content')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('body');
            $table->string('ip', 45)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->date('visited_on')->index();
            $table->string('path');
            $table->string('visitor', 64)->index();
            $table->string('referrer')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('subject_type')->nullable();
            $table->string('subject_label')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('created_at')->nullable()->index();
        });
    }

    public function down(): void
    {
        foreach (['activity_logs', 'visits', 'messages', 'cv_blocks', 'cv_sections', 'affiliations', 'archive_items',
            'photos', 'media_items', 'concerts', 'videos', 'featured_works', 'pages', 'settings'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
