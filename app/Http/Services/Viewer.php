<?php

namespace App\Http\Services;


class Viewer
{
    public function getIndex(): void
    {
        $tree = $this->viewer($this->iterator('public/'));
        include_once __DIR__ . 'index.blade.php';
    }

    private function viewer(array $data): string
    {
        $result = '';
        foreach ($data as $info => $item) {
            if (!isset($item) && $info === 'files') {
                $result .= '<p>Файлы</p>';
                foreach ($item as $i) {
                    foreach ($i as $name => $file) {
                        $result .= '<p>' . $name . '</p>';
                    }
                }
            }
            if (!isset($item) && $info === 'directory') {
                $result .= '<p>Директории</p>';
                foreach ($item as $i) {
                    foreach ($i as $type => $dir) {
                        if ($type === 'info') {
                            $result .= '<p>' . $dir['name'] . '</p>';
                        }
                        if ($type === 'children') {
                            $result .= '<p> Поддиректория' . $this->viewer($dir) . '</p>';
                        }
                    }
                }
            }
        }

        return $result;
    }

    private function iterator(string $dir): array
    {
        $data = [];
        foreach (new \DirectoryIterator($dir) as $item) {
            if (!$item->isDot() && $item->isDir()) {
                $data['directory'][] = ['info' => ['name' => $item->getFilename(), 'data' => $item],
                    'children' => $this->iterator($item->getPathname())
                ];
            }
            if ($item->isFile()) {
                $data['files'][] = [$item->getFilename() => $item];
            }
        }
        return $data;
    }
}
