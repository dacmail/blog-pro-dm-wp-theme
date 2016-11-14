<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <p class="post-category"><?php the_category(', '); ?></p>
        <h1 class="post-title">
            <?php the_title(); ?>
        </h1>
        <p class="post-date"><?php the_time(get_option('date_format')); ?></p>
        <p class="post-author"><?php get_template_part('templates/post-author'); ?></p>
        <?php the_post_thumbnail('col-8') ?>
        <div class="post-content">
            <?php the_content( __('Leer m&aacute;s &raquo;', 'ungrynerd')); ?>
            <?php wp_link_pages(); ?>
        </div>
        <div class="post-meta">
            <?php the_tags('<div class="post-tags"><i class="icon-ico_etiqueta"></i>', ' / ', '</div>'); ?>
            <a href="http://www.madrid.es/portales/munimadrid/es/Inicio/Actualidad?vgnextchannel=1578e3d5d3e07010VgnVCM100000dc0ca8c0RCRD&vgnextoid=ae50a76d7388f410VgnVCM1000000b205a0aRCRD" target="_blank" class="post-report"><i class="icon-ico_megafono"></i> Comunicar error en la información</a>
        </div>
    </article>
    <?php $links = get_post_meta(get_the_ID(), '_ungrynerd_links', true); ?>
    <?php if (!empty($links)) : ?>
        <aside class="post-links">
            <h3>Enlaces relacionados</h3>
            <ul>
            <?php foreach ($links as $link) : ?>
                <li><a href="<?php echo esc_url($link[1]) ?>"><?php echo $link[0] ?></a></li>
            <?php endforeach; ?>
            </ul>
        </aside>
    <?php endif ?>
<?php endwhile; ?>
