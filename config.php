<?php
$config = array(
	'charset'			=> empty( $charset ) ? 'UTF-8' : $charset,
	'timezone'			=> 'Asia/Chongqing',
	'force_send_header'	=> empty( $force_send_header ) ? true : $force_send_header,
	'locale'			=> 'en_US',
	'language'			=> 'en-us',


	'max_file_size'		=> 4096000,
	'max_page'			=> 100,

	'session_cookie_path'	=> dirname( $_SERVER['SCRIPT_NAME'] ),

	'cache_enable'		=> true,
	'cache_ttl'			=> 86400,
	'cache_uid'			=> 'fkcj',

	'error_file'		=> ROOT . '/error.log',
	'sql_error_file'	=> ROOT . '/error.sql.log',

	'var_list'			=> array(
								array( 'id',					'i', 0 ),
								array( 'site',					's', '' ),
								array( 'season',			'i', 1 ),
                                array( 'course',				'i', 0 ),
								array( 'username',				's', '' ),
								array( 'pass',					'b', false ),
								array( 'type',					's', '' ),
								array( 'keyword',				's', '' ),
								array( 'mobile',				's', '' ),
								array( 'step',					'i', 0 ),
								array( 'default',				'i', 1 ),
								array( 'password',				's', '' ),
								array( 'start_time',			's', '' ),
								array( 'end_time',				's', '' ),
								array( 'order',					's', 'id desc' ),
								array( 'orderid',				'i', 0 ),
								array( 'start_id',				'i', 0 ),
								array( 'page',					'i', 1 ),
								array( 'pagesize',				'i', 20 ),
								array( 'redirect',				'b', false ),
								array( 'module',				's', 'index' ),
								array( 'tpl',					's', '' ),
								array( 'format',				's', 'html' ),
								array( 'return_to',				's', '' ),
								array( 'json_result',			'i', 0 ),
                                array( 'message',				's', '' ),
                                array( 'code',		    		's', '' ),
                                array( 'idcard',		    	's', '' ),
                                array( 'name',		    	    's', '' ),
								array( 'venue',		    	    's', '' ),
								array( 'title',		    	    's', '' ),
								array( 'content',		   	    's', '' ),
								array( 'date',		    	    'i', 0 ),
								array( 'poll_id',	    		'i', 0 ),
								array( 'alt_course',	  		'i', 0 ),
								array( 'votes', 	      		's', '' ),
								array( 'street', 	      		's', '' ),
							),

	'watermark'			=> '/images/watermark.png',
	'thumbnail_width'	=> 200,

	'salt'				=> 'asferg32ejiazaahahegaaansgwdsgg4tgrgg',
	'sid_prefix'		=> 'recaptcha_',

	'recaptcha_public_key'	=> '',
	'recaptcha_private_key'	=> '',

	'user_cookie_name'	=> 'user',
	'last_login_cookie_name'	=> 'last_login',

	'message_source'	=> "",
	'site_name'			=> '风口财经',

	'venue_apply_max_period'  => 7,

	'admin_header_nav_items'	=> [
        'admin.news.list'			=> '新闻管理',
	],

);

