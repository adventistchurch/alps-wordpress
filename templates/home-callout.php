<div id="home-callout">
	<div class="two-thirds-<?= get_option('home-callout') ?>">
		<h2><?= __("My Whole Life", "adventist") ?></h2>
		<p><?= __("I was born to reflect the image of a God who is powerful enough to create my universe, attentive enough to hear my prayers and loving enough to be defined by self-sacrifice. I find my greatest fulfillment on a journey toward purpose and wholeness.", "adventist") ?></p>
		<a href="<?= __('http://www.adventist.org/spirituality/', 'adventist') ?>" id="spirituality" class="callout"><strong><?= __("Spirituality", "adventist") ?></strong><?= __("My God loves without restraint...", "adventist") ?><span class="go"></span></a>
		<a href="<?= __('http://www.adventist.org/vitality/', 'adventist') ?>" id="vitality" class="callout"><strong><?= __("Vitality", "adventist") ?></strong><?= __("My Life is a gift to be valued...", "adventist") ?><span class="go"></span></a>
		<a href="<?= __('http://www.adventist.org/service/', 'adventist') ?>" id="service" class="callout"><strong><?= __("Service", "adventist") ?></strong><?= __("My World is a place where people find hope...", "adventist") ?><span class="go"></span></a>
	</div> <!-- End .two-thirds-right -->
	<div class="third-<?= inverse_position(get_option('home-callout')) ?>">
		<h3 class="ico-book"><?= __("Our Beliefs", "adventist") ?></h3>
		<p><?= __("Seventh-day Adventist beliefs are meant to permeate your whole life. Growing out of scriptures that paint a compelling portrait of God, you are invited to explore, experience and know the One who desires to make us whole.", "adventist") ?></p>
		<a href="<?= __('http://www.adventist.org/service/', 'adventist') ?>" class="btn btn-go"><?= __("Learn More", "adventist") ?></a>
	</div> <!-- End .third-left -->
</div> <!-- End #home-callout -->