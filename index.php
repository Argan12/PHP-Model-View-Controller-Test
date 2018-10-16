<?php
	session_start();
	
	require('controller/controller.php');

	try {
		if (isset($_GET['action']))
		{
			switch ($_GET['action'])
			{
				// Display homepage, call listPosts() function
				case 'listPosts':
					listPosts();
					break;
				
				// Display new post page
				case 'newPost':
					require('view/newPost.php');
					break;
				
				// Call savePost() function
				case 'savePost':
					if (!empty($_POST['title']) && !empty($_POST['content']))
						savePost($_POST['title'], $_POST['content']);
					else 
						header('Location:index.php?action=newPost');
					
					break;
				
				// Display update page which contain an input to update a post
				case 'update':
					updatePostPage();
					break;
					
				// PHP function to save modifications 	
				case 'updatePost':
					if (!empty($_POST['title']) && !empty($_POST['content']))
						updatePost($_GET['id'], $_POST['title'], $_POST['content']);
					else 
						header('Location:index.php?action=update&id='.$_GET['id']);
					
					break;
				
				// Call function to delete a post
				case 'deletePost':
					deletePost($_GET['id']);
					break;
					
				// Display new comment page
				case 'new_comment':
					newComment();
					break;
				
				// Call function to save a comment
				case 'saveComment':
					if (!empty($_POST['comment']))
						saveComment($_GET['id'], $_SESSION['id'], $_SESSION['firstname'], $_SESSION['lastname'], $_POST['comment']);
					else 
						header('Location:index.php?action=new_comment&id='.$_GET['id']);
					
					break;
					
				// Display post with its comments
				case 'comment':
					if (isset($_GET['id']) && $_GET['id'] > 0)
						displayComments();
					else 
						throw new Exception('Page introuvable');
					break;
					
				// Create an account
				//Password have to contains specials characters, numbers, capital letters and at least 8 characters
				case 'registerPage':
					if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['mail_address']) && !empty($_POST['password']))
					{
						if ((preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail_address'])) && (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['password'])))
							registerPage($_POST['firstname'], $_POST['lastname'], $_POST['mail_address'], $_POST['password']);
					} else { 
						header('Location:index.php');
					}
				
				// Call function to log in and access to homepage
				case 'login':
					login($_POST['mail_address'], $_POST['password']);
					break;
				
				// Call function to log out
				// Redirection to index.php
				case 'logout':
					logout();
					break;
				
				default:
					throw new Exception('Page introuvable');
			}
		} else {
			// First Website page
			require('view/loginPage.php');
		}
	} catch (Exception $e) {
		$errorMessage = $e->getMessage();
		require('view/errorView.php');
	}
