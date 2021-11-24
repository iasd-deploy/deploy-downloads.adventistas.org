<?php

/** 
 * 
 *	PARA LIMPAR OS POSTS ANTES:
 *	wp post delete $(wp post list --post_type='post' --post_status=draft --format=ids) --force && wp post delete $(wp post list --post_type='post' --post_status=private --format=ids) --force && wp post delete $(wp post list --post_type='post' --post_status=pending --format=ids) --force
 *
 *	PARA EXECUTAR O SCRIPT, RODE NO TERMINAL (com wpcli instalado): 
 * 	wp eval-file processaDownloads.php 1 2

 */

$page = $args[0];
$per_page = $args[1];

echo "\n\nPágina: " . $page . "\n";
echo "Qunatidade por página: " . $per_page . "\n";


processaDownloads($page, $per_page);

function processaDownloads($page = 1, $per_page = 5)
{
	ob_start();

	$log = fopen('log.csv', 'a');
	fwrite($log, "Count;PostID;FileUrl;FileSize;FileType\n");

	$args = array(
		"posts_per_page"    => $per_page,
		"paged"				=> $page,
		"post_status"       => array('publish'),
		// "include"			=> 37838,
		// 'meta_query' => array(
		// 	'relation' => 'OR',
		// 	array(
		// 		'key' => 'post_processed',
		// 		'value' => false
		// 	),
		// 	array(
		// 		'key' => 'post_processed',
		// 		'compare' => 'NOT EXISTS'
		// 	)
		// ),
		'orderby' => 'date',
		'order'   => 'DESC'
	);
	$posts = get_posts($args);
	$count = 0;

	echo "\n\n";
	echo "POSTS PROCESSADO: " . count($posts);
	echo "\n\n";

	foreach ($posts as &$post) {
		//sleep(0.2);
		$count++;

		add_post_meta($post->ID, "post_processed", false, true);

		$fileUrl = get_post_meta($post->ID, 'dp_file_url', true);

		switch (true) {
			case (strpos($fileUrl, 'deptos.adventistas.org.s3.us-east-1.amazonaws.com') == true):
				$fileUrl = str_replace('deptos.adventistas.org.s3.us-east-1.amazonaws.com', 'deptos.adventistas.org', $fileUrl);
				$fileUrl = str_replace('http://', 'https://', $fileUrl);
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case (strpos($fileUrl, 'deptos.adventistas.org.s3.amazonaws.com') == true):
				$fileUrl = str_replace('deptos.adventistas.org.s3.amazonaws.com', 'deptos.adventistas.org', $fileUrl);
				$fileUrl = str_replace('http://', 'https://', $fileUrl);
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case (strpos($fileUrl, 'deptos.adventistas.org') == true):
				$fileUrl = str_replace('http://', 'https://', $fileUrl);
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case (strpos($fileUrl, "cloud.ansc.org.br") ||
				strpos($fileUrl, "cloud.ac.org.br") ||
				strpos($fileUrl, "cloud.aopr.org.br") ||
				strpos($fileUrl, "cloud.iap.org.br") ||
				strpos($fileUrl, "cloud.mosr.org.br") ||
				strpos($fileUrl, "cloud.anp.org.br") ||
				strpos($fileUrl, "cloud.asp.org.br") ||
				strpos($fileUrl, "cloud.acpr.org.br") ||
				strpos($fileUrl, "cloud.asr.org.br")):
				$fileUrl = str_replace('http://', 'https://', $fileUrl) . "/download";
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case (strpos($fileUrl, "www.daniellocutor.com.br/?download=") == true):
				$fileID = explode("ccount=", parse_url($fileUrl, PHP_URL_QUERY))[1];
				$fileUrl = $fileID;
				break;

			case (strpos($fileUrl, "drive.google.com") == true):
				$fileID = explode("/", parse_url($fileUrl, PHP_URL_PATH))[3];
				$firstUrl = "https://drive.google.com/u/0/uc?id=" . $fileID . "&export=download";
				$fileHeaders = get_headers($firstUrl, true);
				$fileUrl = $fileHeaders['Location'];
				break;
		}

		// Pula links do google que são do tipo folder
		// if ( strpos($fileUrl, "drive.google.com/") == true && strpos($fileUrl, "folder") == true ){
		// 	continue;
		// }

		$post_content = get_post_field('post_content', $post->ID);
		$post_content = str_replace('<!-- wp:heading {"level":1} -->', '<!-- wp:paragraph -->', $post_content);
		$post_content = str_replace('<!-- wp:heading {"level":2} -->', '<!-- wp:paragraph -->', $post_content);
		$post_content = str_replace('<!-- wp:heading {"level":3} -->', '<!-- wp:paragraph -->', $post_content);
		$post_content = str_replace('<!-- wp:heading {"level":4} -->', '<!-- wp:paragraph -->', $post_content);
		$post_content = str_replace('<!-- wp:heading {"level":5} -->', '<!-- wp:paragraph -->', $post_content);
		$post_content = str_replace('<!-- wp:heading {"level":6} -->', '<!-- wp:paragraph -->', $post_content);
		$post_content = str_replace('<!-- /wp:heading -->', '<!-- /wp:paragraph -->', $post_content);
		$post_content = preg_replace('#<h[1-6]>(.*?)</h[1-6]>#si', '<p>${1}</p>', $post_content);
		$post->post_content = $post_content;
		wp_update_post($post);

		$fileInfo = getFileInfo($fileUrl);

		$file = array(
			'name' 		=> $post->post_title,
			'format'	=> $fileInfo[1],
			'size'		=> $fileInfo[0],
			'link'		=> $fileUrl
		);



		$msg = $count . " - " . $fileInfo[1] . " - " . $post->ID . " - " . $fileUrl . " - " . $fileInfo[0] . "\n";

		echo $msg;

		// if ($fileInfo[0] == "" || $fileInfo[1] == "") {

		// 	echo "Enviado para rascunho... \n";
		// 	wp_update_post(array('ID' => $post->ID, 'post_status' => 'draft'));
		// 	continue;
		// }

		// $result = add_row('downloads', $file, $post->ID);




		ob_flush();
		flush();

		fwrite($log, str_replace(' - ', ';', $msg));
		update_post_meta($post->ID, "post_processed", true);
	}
}

function getFileInfo($fileUrl)
{

	if ($fileUrl) {

		stream_context_set_default([
			'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
			],
		]);

		$headers = get_headers($fileUrl, true);

		if (is_numeric($headers['Content-Length'])) {
			$fileSize = formatBytes($headers['Content-Length'], $precision = 2);
			$fileType = $headers['Content-Type'];

			switch (true) {
				case (strpos($fileType, 'presentation') || strpos($fileType, 'powerpoint') || strpos($fileType, 'photoshop') || strpos($fileType, 'octet-stream') || strpos($fileType, 'rar') || strpos($fileType, 'quicktime') || strpos($fileType, 'vnd.wave')):
					$fileType = end(explode(".", $fileUrl));
					break;
				case (strpos($fileType, 'word')):
					$fileType = 'doc';
					break;
				case (strpos($fileType, 'sheet')):
					$fileType = 'xls';
					break;
				case (strpos($headers['Content-Type'], 'html')):
					$fileType = NULL;
					$fileSize = NULL;
					break;
				default:
					$fileType = explode("/", $headers['Content-Type'])[1];
			}

			return [$fileSize, $fileType];
		} else {
			return;
		}
	} else {
		return;
	}
}

function formatBytes($bytes, $precision = 2)
{
	return number_format($bytes / 1000000, $precision);;
}
