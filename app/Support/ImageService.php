<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Saves uploaded images with Intervention Image: fixes phone rotation, shrinks big photos
 * and stores them as WebP, plus a small "-thumb" copy for grids and admin lists.
 */
class ImageService
{
    const MAX_WIDTH = 1920;
    const MAX_HEIGHT = 1920;
    const THUMB_WIDTH = 640;
    const QUALITY = 82;

    /** Returns the public path, e.g. "uploads/photos/stage-ab12cd.webp". */
    public static function store(UploadedFile $file, string $folder): string
    {
        $dir = public_path("uploads/{$folder}");
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $base = Str::limit(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'image', 60, '');
        $base .= '-'.Str::lower(Str::random(6));

        // GIF (animation) and SVG are kept as they are
        $ext = strtolower($file->getClientOriginalExtension());
        if (in_array($ext, ['gif', 'svg'])) {
            $file->move($dir, "{$base}.{$ext}");

            return "uploads/{$folder}/{$base}.{$ext}";
        }

        $manager = new ImageManager(new Driver);

        $image = $manager->read($file->getRealPath());
        $image->scaleDown(width: self::MAX_WIDTH, height: self::MAX_HEIGHT);
        $image->toWebp(self::QUALITY)->save("{$dir}/{$base}.webp");

        $thumb = $manager->read($file->getRealPath());
        $thumb->scaleDown(width: self::THUMB_WIDTH);
        $thumb->toWebp(78)->save("{$dir}/{$base}-thumb.webp");

        return "uploads/{$folder}/{$base}.webp";
    }

    /** The small copy of an uploaded image, or the image itself when there is none. */
    public static function thumb(?string $path): ?string
    {
        if (! $path || ! str_starts_with($path, 'uploads/')) {
            return $path;
        }
        $thumb = preg_replace('/\.webp$/', '-thumb.webp', $path);

        return $thumb !== $path && is_file(public_path($thumb)) ? $thumb : $path;
    }

    /** Removes an uploaded image and its thumbnail (files under /assets are never touched). */
    public static function delete(?string $path): void
    {
        if (! $path || ! str_starts_with($path, 'uploads/')) {
            return;
        }
        foreach ([$path, self::thumb($path)] as $p) {
            if ($p && is_file(public_path($p))) {
                @unlink(public_path($p));
            }
        }
    }
}
