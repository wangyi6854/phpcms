<?php

$format = 'json';

$data = '请完整填写申请。';

if ( !empty( $_POST[ 'name' ] ) )
{
	$_POST[ 'content' ] = !empty( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : '';

	$news = new PollOption( $_POST );
	$news->setNotSavingColumns( [ 'count' ] );

	if ( $news->save() )
	{
		foreach ( json_decode( $_POST[ 'content' ], true ) as $k => $value )
		{
			switch ( $k )
			{
				case 'video':
					$update = '';
					foreach ( $value as $v )
					{
						$update .= $app->db()->quote( $v ) . ',';
					}
					$update = trim( $update, ',' );

					$query = "update aliyun_video set pollOptionId = $news->id where videoId in ($update)";
					$app->db()->exec( $query );

					$app->updatePollOptionImage( $news->id, '' );

					break;
				case 'photo':
					break;
			}
		}

		$data = '提交完成。请等待审核。审核完成后将使用短信通知您。（审核不通过不会发送短信通知。）';

	}
}


