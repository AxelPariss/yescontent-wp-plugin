<?php

/**
 * at_rest_init
 */

class Yescontent_API
{
    public function __construct()
    {
        $this->namespace = 'yescontent/v1';
        $this->post_type = get_option('yescontent_post_type');

        add_action('rest_api_init', [$this, 'yescontent_rest_init']);
    }

    public function yescontent_rest_init()
    {
        register_rest_route($this->namespace, $this->post_type, [
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this, 'query_rest_content'],
        ]);
    }

    public function query_rest_content(WP_REST_Request $request)
    {
        $offer_url = trim($request->get_param('offer_url'));
        $offer_url = str_replace('https://', '', $offer_url);
        $offer_url = str_replace('http://', '', $offer_url);
        $offer_url = str_replace('www.', '', $offer_url);
        $offer_url = rtrim($offer_url, '/');
        $offer_url = esc_sql($offer_url);
        $offer_key = 'offer_url';

        $args = [
            'post_type' => [$this->post_type],
            'showposts' => '100',
            'order' => 'DESC',
            'orderby' => 'date',
            'meta_query' => [
                [
                    'key' => $offer_key,
                    'compare' => 'EXISTS',
                ],
                [
                    'key' => $offer_key,
                    'value' => $offer_url,
                    'compare' => 'LIKE',
                ],
            ],
        ];

        $meta_query = new WP_Query($args);
        if ($meta_query->have_posts()) {
            $data = [];
            // Store each post's data in the array
            while ($meta_query->have_posts()) {
                $meta_query->the_post();
                $id = get_the_ID();
                $post = get_post($id);
                $link = get_permalink($id);
                $post_object = (object) [
                    'id' => $post->ID,
                    'title' => (object) ['rendered' => $post->post_title],
                    'slug' => $post->post_name,
                    'link' => $link,
                    'offer_url' => get_post_meta($id, $offer_key, true),
                ];
                $data[] = $post_object;
            }
            // Return the data
            return $data;
        } else {
            // If there is no post
            return [];
        }
    }
}

$Yescontent_API = new Yescontent_API();
