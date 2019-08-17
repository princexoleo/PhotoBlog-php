<?php

class post
{


 private $connection;

    function __construct ($c){
        $this->connection=$c;
    }


    public function addPost($title ,$image ,$post ,$category,$place, $userID)
    {
        $date = date("Y-m-d H:i:s");
        $t=mysqli_real_escape_string($this->connection ,$title);
        $i=mysqli_real_escape_string($this->connection ,$image );
        $p=mysqli_real_escape_string($this->connection, $post);
        $c =mysqli_real_escape_string($this->connection , $category);
        $pal =mysqli_real_escape_string($this->connection , $place);
        $user=(int)$userID;
        
        $query = "INSERT INTO post (Title , Date_Time , Image , Post , Category , Place , User_ID ) ".
            "VALUES ('{$t}' , '{$date}' , '{$i}' , '{$p}' ,'{$c}','{$pal}', {$user})";

        $result = mysqli_query($this->connection , $query);
        if($result){
            //success
            return 1;
        }else {
            //failure
            return -1;
        }
    }
    
      public function getOrderedPosts(){
        $query = " SELECT Title , Date_Time , Image , Post , Place , User_ID , ID FROM post ORDER BY Date_time DESC";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
    public function getEntertainmentPosts(){
        $query = " SELECT * FROM post ". 
            "WHERE Category= 'entertainment'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
    public function getSciencePosts(){
        $query = " SELECT * FROM post ". 
            "WHERE Category= 'science'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
    public function getSportsPosts(){
        $query = " SELECT * FROM post ". 
            "WHERE Category= 'sports'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    public function getDhakaPosts(){
        $query = " SELECT * FROM post ". 
            "WHERE Place= 'Dhaka'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
    public function getOthersPosts(){
        $query = " SELECT * FROM post ". 
            "WHERE Category= 'others'";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
    public function getUserOrderedPosts($user_id){
        $query = " SELECT * FROM post where User_ID= {$user_id} ORDER BY Date_Time DESC";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
    public function getPostInfo($post_id){
        $query = " SELECT * FROM post where ID= {$post_id}";
        $result = mysqli_query($this->connection , $query);
        if(!$result){ 
          return -1;
        }
        else{
            return $result; 
        }

    }
    
   public function SearchPost($category,$title) {
	
	if($category!="" && $title!="" && $pal!="")
	{
		
		$sql = "SELECT Post , ID FROM Post where Title='$title' and Category='$category' or Place='$category'";
		$result = mysqli_query($this->connection , $sql);

		if ($result->num_rows > 0) {
		// output data of each row
			return $result;
		} 
		else {
			return 0;
		}
    }
	
     }
    
    public function DeletePost($id) {

	   $sql = "DELETE FROM Post WHERE ID={$id}";
	   $result = mysqli_query($this->connection , $sql);
	   if(! $result ) {
        return -1;
        }
        return 1;
    }
    
    public function UpdatePost($id,$updated_post,$title,$img,$cat, $pal) {
	
	$date = new DateTime();
	$sql = "UPDATE Post SET Post = '$updated_post' ,Title='$title', Date_Time= '{$date->format('Y-m-d H:i:s')}', Total_Rates=0, Raters_Number=0 , Category='$cat', Place='$pal', Image='$img' WHERE ID='$id' ";
	$result = mysqli_query($this->connection , $sql);
	
	$sql = "DELETE FROM rates WHERE Post_ID='$id' ";
	$result2 = mysqli_query($this->connection , $sql);
	   
	if(! $result || ! $result2) {
		return -1;
	}
	return 1;	
}

    public function Rate($rater_id,$post_id,$rate) {

	$sql3 = "insert into rates (User_ID,Post_ID,Rate) values ('$rater_id','$post_id','$rate')";
	$result3 = mysqli_query($this->connection , $sql3);
	 if(!$result3){
         return -1;
        }
        else{
            if ($result3 ) {
		
		      $sql = "UPDATE Post SET  Total_Rates=Total_Rates+$rate, Raters_Number=Raters_Number+1 WHERE ID='$post_id' ";
		      $result = mysqli_query($this->connection , $sql);
                if(!$result){return -1;}else{return 1;}
	       } 
	       else { return 0; }
     }

}


}
?>