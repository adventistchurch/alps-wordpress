<?php
/*
 * This file is part of the Hierarchy package.
 *
 * (c) Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Brain\Hierarchy\Branch;

use Brain\Hierarchy\PostTemplates;

/**
 * @author  Giuseppe Mazzapica <giuseppe.mazzapica@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */
final class BranchSingle implements BranchInterface
{
    /**
     * @var \Brain\Hierarchy\PostTemplates
     */
    private $postTemplates;

    /**
     * @param \Brain\Hierarchy\PostTemplates|null $postTemplates
     */
    public function __construct(PostTemplates $postTemplates = null)
    {
        $this->postTemplates = $postTemplates ?: new PostTemplates();
    }

    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return 'single';
    }

    /**
     * {@inheritdoc}
     */
    public function is(\WP_Query $query)
    {
        return $query->is_single();
    }

    /**
     * {@inheritdoc}
     */
    public function leaves(\WP_Query $query)
    {
        /** @var \WP_Post $post */
        $post = $query->get_queried_object();
        if (!$post instanceof \WP_Post || ! $post->ID) {
            return ['single'];
        }

        $leaves = [
            "single-{$post->post_type}-{$post->post_name}",
            "single-{$post->post_type}",
            'single',
        ];

        $decoded = urldecode($post->post_name);
        if ($decoded !== $post->post_name) {
            array_unshift($leaves, "single-{$post->post_type}-{$decoded}");
        }

        $template = $this->postTemplates->findFor($post);
        $template and array_unshift($leaves, $template);

        return $leaves;
    }
}
