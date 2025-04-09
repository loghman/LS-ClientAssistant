<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Exception;

class CoreAsset
{
    private string $buildDirectory = 'build';

    private string $manifestFilename = 'manifest.json';

    private static array $manifests = [];

    /**
     * Get the URL for an asset.
     *
     * @param string $asset
     * @param string|null $buildDirectory
     * @return string
     * @throws Exception
     */
    public function asset(string $asset, string $buildDirectory = null): string
    {
        $buildDirectory ??= $this->buildDirectory;

        $chunk = $this->chunk($this->manifest($buildDirectory), $asset);

        return $this->assetPath($buildDirectory . '/' . $chunk['file']);
    }

    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @return string
     */
    protected function assetPath(string $path): string
    {
        return env('LSP_URL') . $path;
    }

    /**
     * Get the chunk for the given entry point / asset.
     *
     * @param array $manifest
     * @param string $file
     * @return array
     *
     * @throws Exception
     */
    protected function chunk(array $manifest, string $file): array
    {
        if (!isset($manifest[$file])) {
            throw new Exception("Unable to locate file in Vite manifest: $file.");
        }

        return $manifest[$file];
    }

    /**
     * Get the manifest file for the given build directory.
     *
     * @param string $buildDirectory
     * @return array
     *
     * @throws Exception
     */
    protected function manifest(string $buildDirectory): array
    {
        $url = $this->manifestUrl($buildDirectory);

        if (!isset(static::$manifests[$url])) {
            $manifestContent = file_get_contents($url);
            if (!$manifestContent) {
                throw new Exception("Vite manifest not found at: $url");
            }

            static::$manifests[$url] = json_decode($manifestContent, true);
        }

        return static::$manifests[$url];
    }

    /**
     * Get the path to the manifest file for the given build directory.
     *
     * @param string $buildDirectory
     * @return string
     */
    protected function manifestUrl(string $buildDirectory): string
    {
        return core_url($buildDirectory . '/' . $this->manifestFilename);
    }
}