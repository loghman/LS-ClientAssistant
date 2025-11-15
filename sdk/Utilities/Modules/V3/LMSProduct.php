<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class LMSProduct extends Cacher
{
    public static function list(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/lms/product', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function get(string $slug, ModuleFilter $filter = null, string $field = null, bool $rowData = false): Collection
    {
        try {
            $path = $field ? "$slug/$field" : $slug;
            $response =  API::get('client/v3/lms/product/' . $path, $filter ? $filter->all() : []);

            if (!$rowData && $response->get('success')) {
                $product = $response->get('data');
                if (is_valid_url($product['custom_landing'])) {
                    header('Location: '.$product['custom_landing'], true, \Illuminate\Http\Response::HTTP_MOVED_PERMANENTLY);
                    exit;
                }
                if ($product['dont_list']) {
                    return collect(['success' => false, 'data' => [], 'message' => 'این دوره یافت نشد.']);
                }
            }

            return $response;
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function keyValList(string $filed, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/lms/product/key-val-list/' . $filed, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function stat(): Collection
    {
        try {
            return API::get('client/v3/lms/stat/');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function listOpus(ModuleFilter $filter = null,$userToken)
    {
        try {
            return API::get('client/v3/lms/opus/',$filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function createOpus($data, $userToken)
    {
        try {
            return API::post('client/v3/lms/opus', [
                'lms_product_id' => $data['lms_product_id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'media_file' => $data['media_file'] ?? null,
                'source_file' => $data['source_file'] ?? null,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}