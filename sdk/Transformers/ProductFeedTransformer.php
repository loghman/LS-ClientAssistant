<?php

namespace Ls\ClientAssistant\Transformers;

use Ls\ClientAssistant\Utilities\Tools\ArrayHelper;

class ProductFeedTransformer extends BaseTransformer
{
    private const IN_STOKE = 'in stock';
    private const OUT_OF_STOKE = 'out of stock';

    public function transform(): array
    {
        $main = (array)$this->resource;

        if (empty($main)) {
            return [];
        }

        ArrayHelper::add($main, [
            'id'            => $main['hash_id'],
            'title'         => $main['title'],
            'subtitle'      => $main['title'],
            'link'          => site_url("course/{$main['slug']}"),
            'image_link'    => $main['banner']['url'] ?? null,
            'availability'  => $this->getAvailabilityStatus($main),
            'regular_price' => $this->getRegularPrice($main),
            'sale_price'    => $this->getSalePrice($main),
            'category'      => $main['category']['name_fa'],
            'description'   => [
                'duration' => 'ساعت ' . to_persian_num($main['attachment_duration_sum']['hours'] ?? 0),
                'teacher'           => $main['mainTeacherFaculty']['full_name'],
                'short_description' => $main['meta']['short_description'] ?? null,
                'session_count'     => to_persian_num($main['item_count']).' جلسه'
            ],
            'brand'         => setting('brand_name_fa')
        ]);

        $requiredFields = [
            'id', 'title', 'subtitle', 'link', 'image_link',
            'availability', 'regular_price', 'sale_price', 'category', 'description', 'brand'
        ];

        $result = [];
        foreach ($requiredFields as $field) {
            $result[$field] = $main[$field] ?? null;
        }

        return $result;
    }

    private function getAvailabilityStatus(array $product): string
    {
        $isOnSale = $product['is_on_sale'];
        $dontList = $product['dont_list'];

        if ($isOnSale && !$dontList) {
            return self::IN_STOKE;
        }

        return self::OUT_OF_STOKE;
    }

    private function getRegularPrice(array $product): ?int
    {
        return $product['price']['main'];
    }

    private function getSalePrice(array $product): ?int
    {
        return $product['final_price']['main'] ?? $product['price']['main'];
    }
} 