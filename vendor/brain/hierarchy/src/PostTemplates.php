<?php
/*
 * This file is part of the Hierarchy package.
 *
 * (c) Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brain\Hierarchy;

/**
 * @author  Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
class PostTemplates
{

    /**
     * @var array[]
     */
    private $templates = [];

    /**
     * @param \WP_Post $post
     * @return string
     */
    public function findFor(\WP_Post $post)
    {
        if (!$post->ID || !$post->post_type) {
            return '';
        }

        $stored = filter_var(get_page_template_slug($post), FILTER_SANITIZE_URL);
        if (!$stored || validate_file($stored) !== 0) {
            return '';
        }

        $stored = wp_normalize_path($stored);
        $templates = $this->templatesForType($post->post_type);

        foreach ($templates as $template) {
            if ($template === $stored) {
                $dir = dirname($template);
                $filename = pathinfo($template, PATHINFO_FILENAME);

                return $dir === '.' ? $filename : "{$dir}/{$filename}";
            }
        }

        return '';
    }

    /**
     * @param string $postType
     * @return string[]
     */
    private function templatesForType($postType)
    {
        if (array_key_exists($postType, $this->templates)) {
            return $this->templates[$postType];
        }

        $this->templates[$postType] = [];
        $templates = (array)wp_get_theme()->get_page_templates(null, $postType);
        foreach ($templates as $template => $header) {
            if ($template && is_string($template)) {
                $sanitized = filter_var($template, FILTER_SANITIZE_URL);
                $this->templates[$postType][] = wp_normalize_path($sanitized);
            }
        }

        return $this->templates[$postType];
    }
}
