<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $filenames;
    public $filesystem;

    public function __construct()
    {
        $this->filenames = collect(File::allFiles(app_path('Posts')))
            ->sortByDesc(function ($file) {
                return $file->getBaseName();
            })
            ->map(function ($file) {
                return $file->getBaseName();
            });

        $this->filesystem = new Filesystem();
    }

    public function getLatest($limit): \Illuminate\Support\Collection
    {
        $posts = [];

        foreach ($this->filenames->take($limit) as $filename) {
            $posts[] = $this->getPostData($filename);
        }

//        dd($posts);
        return collect($posts);
    }

    public function getPostData($filename): array
    {
        $file = $this->filesystem->get(app_path('Posts/' . $filename));
        $object = YamlFrontMatter::parse($file);

        $post['meta'] = $object->matter();
        $post['slug'] = str_replace('.md', '', $filename);

        $converter = new CommonMarkConverter();
        $post['body'] = $converter->convert($object->body())->getContent();

        return $post;
    }

}
