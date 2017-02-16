<?php $stickys = new WP_Query(array(
                'post_type'=> array('post', 'page'),
                'meta_key' => '_ungrynerd_featured',
                'meta_value' => 1,
                'posts_per_page' => -1)); ?>
<?php if ($stickys->have_posts()) : ?>
    <?php while ($stickys->have_posts()) : $stickys->the_post(); ?>
        <?php if ($stickys->current_post == 0): ?>
            <article <?php post_class('main-sticky') ?>>
                <?php the_post_thumbnail('col-12'); ?>
                <div class="post-data">
                    <h2 class="post-title">
                        <a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                </div>
            </article>
        <?php endif; ?>
        <?php if ($stickys->current_post == 1): ?>
            <div class="secondary-stickys">
        <?php endif; ?>
        <?php if ($stickys->current_post > 0): ?>
            <a href="<?php the_permalink(); ?>" <?php post_class(); ?>>
                <?php the_post_thumbnail('col-4-crop'); ?>
                <h2 class="post-title">
                    <?php the_title(); ?>
                </h2>
            </a>
        <?php endif; ?>
    <?php endwhile; ?>
    <?php if ($stickys->found_posts > 1): ?>
        </div> <!-- /.secondary-stickys -->
    <?php endif; ?>
<?php endif; ?>
