<?php 
include_once("db.php");

//insert a post
function addPost($db, $user_id, $title, $content)
{
	$db->errorMessage = null;

	$db->insert("INSERT INTO posts (title, content, date, user_id) VALUES (:title, :content, 
		:date, :user_id)", [':title'=>$title, ':content'=>$content, ':date'=>date('Y-m-d'), ':user_id'=>$user_id]);
	
	//error handling
	if($db->errorMessage == null) return 1;	
	else 
	{
		$errorMessage = $db->errorMessage;
		return 0;	
	}
}

//fetch posts 
function fetchPosts($db, $user_id = null)
{
	$db->errorMessage = null;

	
}