<?php
/** 
	PARA EXECUTAR O SCRIPT, RODE NO TERMINAL (com wpcli instalado): 
 	wp eval-file processaDownloads.php
 */

processaDownloads();

function processaDownloads() {
	ob_start();

	$log = fopen('log.csv', 'a');
	fwrite($log, "Count;PostID;FileUrl;FileSize;FileType\n");

	$args = array(
		"posts_per_page"    => "-1",
		"post_status"       => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash') ,
		// "include"			=> 39166,
		'meta_query' => array(
			'relation' => 'OR',
			array( 
				'key'=> 'post_processed',
				'value' => false
			),
			array( 
				'key'=> 'post_processed',
				'compare' => 'NOT EXISTS'
			)
		),
	);
	$posts = get_posts($args);
	
	echo "\n\n";
	echo "POSTS A PROCESSAR: ". count($posts);
	echo "\n\n";
	
	foreach ($posts as &$post){
		sleep(0.5);
		$count++;

		add_post_meta($post->ID, "post_processed", false, true);

		$fileUrl = get_post_meta( $post->ID, 'dp_file_url', true );

		switch(true){
			case ( strpos($fileUrl, 'deptos.adventistas.org.s3.us-east-1.amazonaws.com' ) == true ):
				$fileUrl = str_replace('deptos.adventistas.org.s3.us-east-1.amazonaws.com', 'deptos.adventistas.org', $fileUrl);
				$fileUrl = str_replace('http://', 'https://', $fileUrl);
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case ( strpos($fileUrl, 'deptos.adventistas.org.s3.amazonaws.com' ) == true ):
				$fileUrl = str_replace('deptos.adventistas.org.s3.amazonaws.com', 'deptos.adventistas.org', $fileUrl);
				$fileUrl = str_replace('http://', 'https://', $fileUrl);
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case ( strpos($fileUrl, 'deptos.adventistas.org' ) == true ):
				$fileUrl = str_replace('http://', 'https://', $fileUrl);
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case ( strpos($fileUrl, "cloud.ansc.org.br") || strpos($fileUrl, "cloud.ac.org.br") || strpos($fileUrl, "cloud.aopr.org.br") || strpos($fileUrl, "cloud.iap.org.br") || strpos($fileUrl, "cloud.mosr.org.br") || strpos($fileUrl, "cloud.anp.org.br") || strpos($fileUrl, "cloud.asp.org.br") || strpos($fileUrl, "cloud.acpr.org.br") || strpos($fileUrl, "cloud.asr.org.br") ):
				$fileUrl = str_replace( 'http://', 'https://', $fileUrl) ."/download";
				update_post_meta($post->ID, 'dp_file_url', $fileUrl);
				break;

			case ( strpos($fileUrl, "drive.google.com") == true ):
				$fileID = explode("/", parse_url($fileUrl, PHP_URL_PATH))[3];
				$firstUrl = "https://drive.google.com/u/0/uc?id=". $fileID ."&export=download";
				$fileHeaders = get_headers($firstUrl, true);
				$fileUrl = $fileHeaders['Location'];
				break;
		}

		// Pula links do google que são do tipo folder
		if ( strpos($fileUrl, "drive.google.com/") == true && strpos($fileUrl, "folder") == true ){
			continue;
		}

		$msg = $count ." - ". $post->ID ." - ". $fileUrl ." - ". getFileSize( $fileUrl, $post->ID )[0] ." - ". getFileSize( $fileUrl, $post->ID )[1] ."\n";

		echo $msg;
		ob_flush();
		flush();

		fwrite($log, str_replace(' - ', ';', $msg));
		update_post_meta($post->ID, "post_processed", true);
	}
}

function getFileSize( $fileUrl, $postID ){

	if($fileUrl){

		stream_context_set_default( [
			'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
			],
		]);

		$headers = get_headers($fileUrl, true);

		if ( is_numeric( $headers['Content-Length'] ) ){ 
			$fileSize = formatBytes( $headers['Content-Length'], $precision = 2 );
			$fileType = $headers['Content-Type'];
			
			switch(true){
				case (strpos($fileType, 'presentation') || strpos($fileType, 'powerpoint') || strpos($fileType, 'photoshop') || strpos($fileType, 'word') || strpos($fileType, 'octet-stream') || strpos($fileType, 'rar')):
					$fileType = end( explode( ".", $fileUrl ) );
					break;
				case (strpos($headers['Content-Type'], 'html')):
					$fileType = NULL;
					$fileSize = NULL;
					break;
				default :
					$fileType = explode( "/", $headers['Content-Type'] )[1];
			}
	
			return [$fileSize, $fileType];
		} else {
			return;
		}
	} else {
		return;
	}
}

function formatBytes( $bytes, $precision = 2 ) {
	$unit = ["B", "KB", "MB", "GB"];
	$exp = floor(log($bytes, 1024)) | 0;
	return round($bytes / (pow(1024, $exp)), $precision).$unit[$exp];
}