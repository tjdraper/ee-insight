<div class="insight">
	<?php if (count($list) > 1) { ?>
		<div class="insight__sidebar">
			<h2 class="insight__sidebar-heading">
				<?= lang('insight_sidebar_heading') ?>
			</h2>
			<ol class="insight__sidebar-list">
				<?php foreach($list as $item) { ?>
					<li class="insight__sidebar-item">
						<a
							href="<?= $baseUrl . AMP ?>insightPage=<?= $item['fileName'] ?>"
							class="insight__sidebar-link<?php if ($currentPage === $item['fileName']) { ?> --is-active<?php } ?>"
						>
							<?php if ($currentPage === $item['fileName']) { ?>&raquo; <?php } ?><?= $item['title'] ?>
						</a>
					</li>
				<?php } ?>
			</ol>
		</div>
	<?php } ?>
	<div class="insight__content<?php if (count($list) > 1) { ?> --has-sidebar<?php } ?>">
		<?= $content ?>
	</div>
</div>
