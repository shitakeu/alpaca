<?php
class AlpacaDBCommon {
  
  $_dbh;
  $_dbname = 'alpaca';
  $_host = '127.0.0.1';
  $_dsn = "mysql:dbname=$dbname;host=$host";
  $_user_w = 'alpaca';
  $_password = '';
  
  public function __construct() {
    try {
        $this->_dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
  }
  
  /**
  * 会場情報を取得
  */
  public function getHall(int $hall_id){
    $sql = "
SELECT * FROM hall WHERE id = :hall_id
";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':hall_id', $hall_id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

   if(empty($res)){
     return array();
   }
   return $res;
  }

  /**
  * 会場リストを取得
  * 引数により３０件ずつ返す
  * 0 が1-30までのデータを返す
  */
  public function getHallList($num = 0){
    $num++;
    $get_count = 30;
    $start = $num * $get_count;
    $sql = "
SELECT * FROM hala ORDER BY id ASC LIMIT $start, $get_count;
";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

   if(empty($res)){
     return array();
   }
   return $res;
  }
  
  
  /**
  * 会場IDからPlanデータの入った配列を返す
  * ない場合はからの配列を返す
  */
  public function getPlanList(int $hall_id){
    $sql = "
SELECT * FROM plan WHERE hall_id = :hall_id
";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':hall_id', $hall_id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

   if(empty($res)){
     return array();
   }
   return $res;
  }
  
  /**
  * オーナーIDからオーナー情報を返す
  * 
  */
  public function getOwner(int $owner_id){
    $sql = "
SELECT * FROM owner WHERE id = :owner_id
";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(empty($res)){
      return array();
    }
    return $res;
  }
  
  /**
  * お客様IDからお客様情報を返す
  * 
  */
  public function getUser(int $user_id){
    $sql = "
SELECT * FROM user WHERE id = :user_id
";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(empty($res)){
      return array();
    }
    return $res;
  }

  /**
  * メールアドレスからお客様IDを取得
  */
  public function getUserId(int $mail_address){
    $sql = "
SELECT id FROM user WHERE mail_address = :mail_address
";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':mail_address', $user_id, PDO::PARAM_INT);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(empty($res)){
      return array();
    }
    return $rea['id'];
  }

  /**
  * 会場総数を取得 
  */
  public function getHallCount(){
    $sql = "
SELECT count(*) FROM hall;
";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(empty($res)){
      return array();
    }
    return $res["COUNT(*)"];
  }

  
  /**
  * Planをお客様情報と一緒に登録 
  */
  public function saveUser($name, $mail_address, $tel, $note,
	$date_to, $date_from, $stricken_area, $bus, $town ){
    $sq_user = "
INSERT INTO user (name, mail_address, tel, note);
VLUES
(:name, :mail_address, :tel, :note);
";
    $sth = $dbh->prepare($sql_user);
    $sth->bindValue(':name', $name, PDO::PARAM_STR);
    $sth->bindValue(':mail_address', $mail_address, PDO::PARAM_INT);
    $sth->bindValue(':tel', $tel, PDO::PARAM_STR);
    $sth->bindValue(':note', $note, PDO::PARAM_STR);
    
    try{
      $sth->execute();
    }catch(PDOException $e){
      error_log("PDO Exception : " . $e->getMessage());
      return false;
    }

    $sq_plan = "
INSERT INTO plan (date_to, date_from, stricken_area, bus, town);
VLUES
(:date_to, :date_from, :stricken_area, :bus, :town);
";
     
    $sth_plan = $dbh->prepare($sql_plan);
    $sth_plan->bindValue(':bus', $bus, PDO::PARAM_BOOL);
    $sth_plan->bindValue(':date_to', $date_to, PDO::PARAM_STR);
    $sth_plan->bindValue(':date_from', $date_from, PDO::PARAM_STR);
    $sth_plan->bindValue(':stricken_area', $stricken_area, PDO::PARAM_BOOL);
    $sth_plan->bindValue(':bus', $bus, PDO::PARAM_BOOL);
    $sth_plan->bindValue(':town', $town, PDO::PARAM_BOOL);
   
    try{
      $sth_plan->execute();
    }catch(PDOException $e){
      error_log("PDO Exception : " . $e->getMessage());
      return false;
    }
  }
}
