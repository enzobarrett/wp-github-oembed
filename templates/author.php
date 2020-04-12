<div class="github-embed github-embed-user <?php echo $data['logo_class'] ?>">
	<p>
		<a href="https://github.com/<?php echo esc_attr( $data['owner'] ) ?>" target="_blank">
			<strong>
				<?php echo esc_html( $data['owner'] ) ?>
			</strong>
		</a>
		<br>
		<?php echo esc_html( number_format_i18n( $data['owner_info']->public_repos ) ) ?> repositories, <?php echo esc_html( number_format_i18n( $data['owner_info']->followers ) ) ?> followers.

		<?php
		# Use the Curl extension to query github and get back a page of results

		$url = "https://github.com/users/" . $data['owner'] . "/contributions";

		$ch = curl_init();

		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$html = curl_exec($ch);
		curl_close($ch);

		# Create a DOM parser object
		$dom = new DOMDocument();

		@$dom->loadHTML($html);

		# Find class that contains chart, and print that
		$classname="position-relative";
		$finder = new DomXPath($dom);
		$spaner = $finder->query("//*[contains(@class, '$classname')]");
		echo $dom->saveHTML($spaner[0]);
		?>
	</p>
</div>
