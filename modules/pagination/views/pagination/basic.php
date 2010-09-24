<p class="pagination">

	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo $page->url($first_page) ?>" rel="first"><?php echo __('В начало') ?></a>
	<?php else: ?>
		<?php echo __('В начало') ?>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo $page->url($previous_page) ?>" rel="prev"><?php echo __('Пред.') ?></a>
	<?php else: ?>
		<?php echo __('Пред.') ?>
	<?php endif ?>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<strong><?php echo $i ?></strong>
		<?php else: ?>
			<a href="<?php echo $page->url($i) ?>"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo $page->url($next_page) ?>" rel="next"><?php echo __('След.') ?></a>
	<?php else: ?>
		<?php echo __('След.') ?>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo $page->url($last_page) ?>" rel="last"><?php echo __('В конец') ?></a>
	<?php else: ?>
		<?php echo __('В конец') ?>
	<?php endif ?>

</p><!-- .pagination -->