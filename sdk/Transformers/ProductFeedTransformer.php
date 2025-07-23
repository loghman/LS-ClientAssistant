<?php

namespace Ls\ClientAssistant\Transformers;

use Ls\ClientAssistant\Utilities\Tools\ArrayHelper;

class ProductFeedTransformer extends BaseTransformer
{
    public function transform(): array
    {
        $main = (array)$this->resource;

        if (empty($main)) {
            return [];
        }

        ArrayHelper::add($main, [
            'id'            => $main['id'] ?? $main['slug'] ?? null,
            'title'         => $main['title'],
            'subtitle'      => $main['title'],
            'link'          => site_url("course/{$main['slug']}"),
            'image_link'    => $main['banner']['url'] ?? null,
            'availability'  => $this->getAvailabilityStatus($main),
            'regular_price' => $this->getRegularPrice($main),
            'sale_price'    => $this->getSalePrice($main),
            'category'      => $main['category']['name_fa'],
            'description'   => $main['description']['full'] ?? '',
            'brand'         => setting('brand_name_fa')
        ]);

        $requiredFields = [
            'id', 'title', 'subtitle', 'link', 'image_link',
            'availability', 'regular_price', 'sale_price', 'category', 'description','brand'
        ];

        $result = [];
        foreach ($requiredFields as $field) {
            $result[$field] = $main[$field] ?? null;
        }

        return $result;
    }

    private function getAvailabilityStatus(array $product): string
    {
        $isOnSale = $product['is_on_sale'] ?? false;
        $dontList = $product['dont_list'] ?? false;

        if ($isOnSale && !$dontList) {
            return 'in stock';
        }

        return 'out of stock';
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