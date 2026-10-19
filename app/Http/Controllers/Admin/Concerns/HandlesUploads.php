<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Support\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Media fields come as a pair: "<field>_file" (an upload) and "<field>" (a path or URL).
 * An upload wins; otherwise the typed path is kept. Images go through Intervention Image
 * (ImageService), videos are stored as they are. Everything lands in public/uploads/<folder>.
 */
trait HandlesUploads
{
    protected function mediaRules(string $field, bool $required = false, bool $video = false): array
    {
        // An empty path arrives as null, so "nullable" must always be there (a chosen file leaves the path empty).
        // Videos pick one source ("<field>_mode": file or link); a link has to be a real URL.
        return [
            $field => array_merge(
                ['nullable', 'string', 'max:500'],
                $required ? ["required_without:{$field}_file"] : [],
                $video && request("{$field}_mode") === 'link' ? ['url'] : [],
            ),
            "{$field}_file" => ['nullable', 'file', $video ? 'mimetypes:video/mp4,video/webm,video/ogg,video/quicktime' : 'mimes:jpg,jpeg,png,webp,gif', 'max:'.($video ? 512000 : 15360)],
        ];
    }

    /** $current is the value saved before; an uploaded file it pointed to is removed when replaced. */
    protected function storeMedia(Request $request, string $field, string $folder, ?string $current = null, bool $video = false): ?string
    {
        if ($request->hasFile("{$field}_file")) {
            $file = $request->file("{$field}_file");

            if ($video) {
                $name = Str::limit(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'video', 60, '');
                $name .= '-'.Str::lower(Str::random(6)).'.'.strtolower($file->getClientOriginalExtension());
                $file->move(public_path("uploads/{$folder}"), $name);
                $path = "uploads/{$folder}/{$name}";
            } else {
                $path = ImageService::store($file, $folder);
            }
        } else {
            $path = trim((string) $request->input($field)) ?: null;
        }

        if ($current && $current !== $path) {
            $video ? $this->deleteUpload($current) : ImageService::delete($current);
        }

        return $path;
    }

    protected function deleteUpload(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/') && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    /** Validated data without the *_file keys. */
    protected function clean(array $data): array
    {
        return array_filter($data, fn ($key) => ! str_ends_with($key, '_file'), ARRAY_FILTER_USE_KEY);
    }
}
