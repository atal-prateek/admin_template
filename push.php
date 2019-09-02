<?php
	echo "<pre>";
	
	
	$result = array();
    exec("git config --global user.name", $result);
	$name=false;
	if(empty($result)){
		echo showform("Enter Your Name","name");
	}else{$name=true;}
	if(isset($_GET['name']) && trim($_GET['name'])!=''){
		$result = array();
		exec('git config --global user.name "'.$_GET['name'].'"', $result);
	}
	if($name===false && (!isset($_GET['name']) || trim($_GET['name'])!='')){  
		die;
	}
	$result = array();
    exec("git config --global user.email", $result);
	$email=false;
	if(empty($result)){
		echo showform("Enter Your Email","email");
	}else{$email=true;}
	if(isset($_GET['email']) && trim($_GET['email'])!=''){
		$result = array();
		exec('git config --global user.email "'.$_GET['email'].'"', $result);
	}
	if($email===false && (!isset($_GET['email']) || trim($_GET['email'])!='')){  
		die;
	}
	$result = array();
    exec("git status", $result);
	print_r($result);
	
	if(isset($_GET['git']) && trim($_GET['git'])!=''){
		if($_GET['git']=='add'){
			$result = array();
			exec("git add .", $result);
			print_r($result);
		}
		if($_GET['git']=='commit'){
			if(isset($_GET['message']) && trim($_GET['message'])!=''){
				$message=$_GET['message'];
				$result = array();
				exec('git commit -m "'.$message.'"', $result);
				print_r($result);
			}
			else{
				echo showform("Enter Commit Message","message",$_GET['git']);
			}
		}
		if($_GET['git']=='push'){
			$result = array();
			exec("git push", $result);
			print_r($result);
		}
	}
	
	$result = array();
    exec("git status", $result);
	//print_r($result);
	
	$add=$commit=$push=false;
	foreach($result as $line){
		if(strpos($line,"Untracked files")!==false || strpos($line,"Changes not staged for commit")!==false){
			$add=true;
		}
		if(strpos($line,"Changes to be committed")!==false){
			$commit=true;
		}
		if(strpos($line,"Your branch is ahead of 'origin/master'")!==false){
			$push=true;
		}
	}
	
	if($add===true){
		echo createlink("Add files","add");
	}
	elseif($commit===true){
		echo createlink("Commit files","commit");
	}
	elseif($push===true){
		echo createlink("Push files","push");
	}
	elseif($add===false && $commit===false && $push===false ){
		echo createlink("View Status","");
	}
	function showform($text,$name,$git=''){
		$form='</pre><form action="">'.$text.'<br>';
		if($git!=''){
			$form.='<input type="hidden" name="git" value="'.$git.'">';
		}
		$form.='<input type="text" name="'.$name.'">
				<input type="submit">
			</form><pre>';
		return $form;
	}
	
	function createlink($text,$type){
		return "</pre><a href='?git=$type'>$text</a><pre>";
	}
?>

