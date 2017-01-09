<?php $stickys = new WP_Query(array('post__in'  => get_option( 'sticky_posts' ), 'posts_per_page' => 3)); ?>
<?php if ($stickys->have_posts()) : ?>
    <?php while ($stickys->have_posts()) : $stickys->the_post(); ?>
        <?php if ($stickys->current_post == 0): ?>
            <article <?php post_class('main-sticky') ?>>
                <?php the_post_thumbnail('col-12'); ?>
                <div class="post-data">
                    <p class="post-category"><?php the_category(', '); ?></p>
                    <h2 class="post-title">
                        <a href="<?php the_permalink() ?>" title="Enlace a <?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <p class="post-date"><?php the_time(get_option('date_format')); ?></p>
                    <p class="post-author"><?php get_template_part('templates/post-author'); ?></p>
                </div>
            </article>
        <?php endif; ?>
        <?php if ($stickys->current_post == 1): ?>
            <div class="secondary-stickys">
                <p class="post-category">Posts Destacados</p>
        <?php endif; ?>
        <?php if ($stickys->current_post > 0): ?>
            <a href="<?php the_permalink(); ?>" <?php post_class(); ?>>
                <?php the_post_thumbnail('col-4-crop'); ?>
                <h2 class="post-title">
                    <?php the_title(); ?>
                    <span class="cat"><?php $cats = get_the_category(); echo $cats[0]->cat_name; ?></span>
                </h2>
            </a>
        <?php endif; ?>
    <?php endwhile; ?>
    <?php if ($stickys->found_posts > 1): ?>
        </div> <!-- /.secondary-stickys -->
    <?php endif; ?>
<?php endif; ?>
