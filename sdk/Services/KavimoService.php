<?php

namespace Ls\ClientAssistant\Services;

class KavimoService
{
    public static function apiKey()
    {
        return setting('_env_video_streaming_provider');
    }

    public static function auth()
    {
        return self::get('auth');
    }

    public static function getProjects()
    {
        $result = self::post('projects');

        if (!self::succeed($result))
            return [];

        return $result->response;
    }

    public static function getProject($project_id)
    {
        $result = self::post('projects', ['id' => $project_id]);
        if (!self::succeed($result))
            return null;
        return $result->response[0];
    }

    public static function createProject($name, $description = null)
    {
        $result = self::post('projects/create', ['name' => $name, 'description' => $description]);
        if (!self::succeed($result))
            return null;
        return $result->response->inserted_id;
    }

    public static function updateProject($project_id, $name, $description = null)
    {
        $data = ['id' => $project_id, 'name' => $name];
        if (!is_null($description))
            $data['description'] = $description;

        $result = self::post('projects/update', $data);
        if (!self::succeed($result))
            return null;
        return $result->response->updated_id;
    }

    public static function deleteProject($project_id)
    {
        $result = self::post('projects/delete', ['id' => $project_id]);
        if (!self::succeed($result))
            return false;
        return true;
    }

    public static function getMedias($project_id = null)
    {
        $data = [];
        if (!is_null($project_id))
            $data = ["project_id" => $project_id];

        $result = self::post('medias', $data);

        if (!self::succeed($result))
            return [];

        return $result->response;
    }

    public static function getMedia($media_id)
    {
        $result = self::post('medias', ['media_id' => $media_id]);
        if (!self::succeed($result))
            return null;
        return $result->response[0];
    }

    public static function getDownloadLinks($media_id, $expire_time = 7200)
    {
        $result = self::post('medias/download', ['media_id' => $media_id]);
        if (!self::succeed($result))
            return null;
        return $result->response;
    }

    public static function uploadFromUrl($url, $project_id = null, $title = null)
    {
        $result = self::post('remote/create', ["url" => $url, 'project_id' => $project_id, 'title' => $title]);
        if (!self::succeed($result))
            return null;
        return $result->response->media_id;
    }

    public static function uploadFromLocal($source, $project_id = null, $title = null)
    {
        $result = self::post('medias/upload', ["source" => $source, "project_id" => $project_id, 'title' => $title]);
        if (!self::succeed($result))
            return null;
        return $result->media;
    }

    public static function updateMedia($media_id, $title, $params = [])
    {
        $data = ['media_id' => $media_id, 'title' => $title];
        $data = array_merge($data, $params);
        $result = self::post('medias/update', $data);
        if (!self::succeed($result))
            return null;
        return $result->response->media_id;
    }

    public static function deleteMedia($project_id)
    {
        $result = self::post('medias/delete', ['media_id' => $project_id]);
        if (!self::succeed($result))
            return false;
        return true;
    }

    public static function getStreamEmbedScriptAttribute($streamId): ?string
    {
        if (!is_null($streamId)) {
            $kavimoMedia = self::getMedia($streamId);
            if ($kavimoMedia->progress->ready_to_play) {
                return $kavimoMedia->embed_script;
            }
            return null;
        }
        return null;
    }

    # utility methods for kavimo service
    public static function request($http_verb, $uri, $data = [])
    {
        $uri = trim($uri, '/');
        $endpoint = "https://stream.7learn.com/api/v1/$uri/?access-token=" . self::apiKey();
        $crl = curl_init();

        curl_setopt($crl, CURLOPT_URL, $endpoint);
        curl_setopt($crl, CURLOPT_TIMEOUT, 3);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($crl, CURLOPT_CUSTOMREQUEST, $http_verb);

        if (isset($data['source'])) {
            $filePath = $data['source'];
            $data['source'] = curl_file_create($filePath, mime_content_type($filePath), basename($filePath));
            curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($crl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
            curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        }

        $result = curl_exec($crl);
        $error = curl_error($crl);
        curl_close($crl);
        if ($error)
            return ['response' => "Error: $error"];

        return json_decode($result);
    }

    public static function get($uri, $data = [])
    {
        return self::request('GET', $uri, $data);
    }

    public static function post($uri, $data = [])
    {
        return self::request('POST', $uri, $data);
    }

    public static function succeed($result)
    {
        $isOk = (!is_null($result) && ($result?->success ?? null));
        return $isOk;
    }

    public static function isReadyToPlay($media_id)
    {
        $media = self::getMedia($media_id);
        return $media?->progress?->ready_to_play ?? false;
    }

}
