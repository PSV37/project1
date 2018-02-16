<?php

use App\Post;

return [
 
 'post_create'=>[
    'new_post' => Post::class,
 ],

 'success' => [
   'message' => 'Successfully New Created Post',
 ],

'success_code' => [
		'success' => 200,
	],

];