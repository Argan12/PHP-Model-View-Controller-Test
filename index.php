<?php
	session_start();
	
	require('controller/controller.php');

	try {
		if (isset($_GET['action']))
		{
			switch ($_GET['action'])
			{
				case 'listPosts':
					listPosts();
					break;
				
				case 'newPost':
					require('view/newPost.php');
					break;
				
				case 'savePost':
					if (!empty($_POST['title']) && !empty($_POST['content']))
						savePost($_POST['title'], $_POST['content']);
					else 
						header('Location:index.php?action=newPost');
					
					break;
				
				case 'update':
					updatePostPage();
					break;
					
				case 'updatePost':
					if (!empty($_POST['title']) && !empty($_POST['content']))
						updatePost($_GET['id'], $_POST['title'], $_POST['content']);
					else 
						header('Location:index.php?action=update&id='.$_GET['id']);
					
					break;
					
				case 'deletePost':
					deletePost($_GET['id']);
					break;
					
				case 'new_comment':
					newComment();
					break;
					
				case 'saveComment':
					if (!empty($_POST['comment']))
						saveComment($_GET['id'], $_SESSION['id'], $_SESSION['firstname'], $_SESSION['lastname'], $_POST['comment']);
					else 
						header('Location:index.php?action=new_comment&id='.$_GET['id']);
					
					break;
					
				case 'comment':
					if (isset($_GET['id']) && $_GET['id'] > 0)
						displayComments();
					else 
						throw new Exception('Page introuvable');
					break;
					
				case 'registerPage':
					if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['mail_address']) && !empty($_POST['password']))
					{
						if ((preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail_address'])) && (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['password'])))
							registerPage($_POST['firstname'], $_POST['lastname'], $_POST['mail_address'], $_POST['password']);
					} else { 
						header('Location:index.php');
					}
				
				case 'login':
					login($_POST['mail_address'], $_POST['password']);
					break;
				
				case 'logout':
					logout();
					break;
				
				default:
					throw new Exception('Page introuvable');
			}
		} else {
			require('view/loginPage.php');
		}
	} catch (Exception $e) {
		$errorMessage = $e->getMessage();
		require('view/errorView.php');
	}