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
final class BranchPage implements BranchInterface
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
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function is(\WP_Query $query)
    {
        return $query->is_page();
    }

    /**
     * {@inheritdoc}
     */
    public function leaves(\WP_Query $query)
    {
        /** @var \WP_Post $post */
        $post = $query->get_queried_object();
        $post instanceof \WP_Post or $post = new \WP_Post((object) ['ID' => 0]);

        $template = $this->postTemplates->findFor($post);
        $pagename = $query->get('pagename');
        (!$pagename && $post->ID) and $pagename = $post->post_name;

        $leaves = $template ? [$template] : [];
        $baseLeaves = $post->ID ? ["page-{$post->ID}", 'page'] : ['page'];

        if (!$pagename) {
            return array_merge($leaves, $baseLeaves);
        }

        $pagenameDecoded = urldecode($pagename);
        if ($pagenameDecoded !== $pagename) {
            $leaves[] = "page-{$pagenameDecoded}";
        }

        $leaves[] = "page-{$pagename}";

        return array_merge($leaves, $baseLeaves);
    }
}
