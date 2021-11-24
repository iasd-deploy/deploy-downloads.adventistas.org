<div id="<?php echo $this->slug(); ?>" class="iasd-widget iasd-widget-posts_grid <?php echo $this->widgetAddClasses(); ?>">
	<?php echo $this->widgetTitle(); 
		IASD_ListaDePosts::addEditButton();
?>
	
	<div class="row iasd-widget-list">
		<div class="highlight col-md-6 col-sm-6">
<?php if(have_posts()): the_post(); $post_title = the_title('', '', false); $thumb_url = $this->getThumbnail('thumb_740x475'); ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo $post_title, '. ', __('Clique para ler a matéria completa', 'iasd'); ?>.">
				<figure style="background-image: url('<?php echo $thumb_url; ?>');">
					<img src="<?php echo $thumb_url; ?>" class="img-responsive" alt="<?php echo $this->getThumbnailName(); ?>">
					<?php if($term = $this->getPostTerm()) echo '<figcaption class="post-taxonomy-tag"><span>'.( is_object($term) ? $term->name : $term ).'</span></figcaption>'; ?>
				</figure>
				<h2><?php echo apply_filters('trim', $post_title, 55); ?></h2>
			</a>
<?php endif; ?>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="row">
<?php for($i = 0; $i < 2; $i++): ?>
				<div class="post-vertical-list-item col-md-6 col-sm-6">
<?php if(have_posts()): the_post(); $post_title = the_title('', '', false); $thumbnail_url = $this->getThumbnail('thumb_150x100'); ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo $post_title, '. ', __('Clique para ler a matéria completa', 'iasd'); ?>.">
						<figure style="background-image: url('<?php echo $thumbnail_url; ?>');">
							<img src="<?php echo $thumbnail_url ?>" class="img-responsive" alt="<?php echo $this->getThumbnailName(); ?>">
							<?php if($term = $this->getPostTerm()) echo '<figcaption class="post-taxonomy-tag"><span>'.( is_object($term) ? $term->name : $term ).'</span></figcaption>'; ?>
						</figure>
						<h2><?php echo apply_filters('trim', $post_title, 50); ?></h2>
					</a>
<?php endif; ?>
				</div>			
<?php endfor; ?>
			</div>
			<div class="row">
<?php for($i = 0; $i < 2; $i++): ?>
				<div class="post-vertical-list-item no-thumb col-md-6 col-sm-6">
<?php if(have_posts()): the_post(); $post_title = the_title('', '', false); ?>
					<a href="<?php the_permalink(); ?>" title="<?php echo $post_title, '. ', __('Clique para ler a matéria completa', 'iasd'); ?>.">
						<?php if($term = $this->getPostTerm()) echo '<p class="post-taxonomy-tag">'.( is_object($term) ? $term->name : $term ).'</p>'; ?>
						<h2><?php echo apply_filters('trim', $post_title, 40); ?></h2>
					</a>
<?php endif; ?>
				</div>			
<?php endfor; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->widgetSeeMoreHtml(__('Mais notícias', 'iasd'), __('Clique para ver todas as notícias', 'iasd')); ?>
		</div>
	</div>
	<?php $this->widgetAddGroupingTaxonomyHtml(); ?>
	<?php IASD_ViewFragments::WrongSizeHtml(); ?>
</div>
