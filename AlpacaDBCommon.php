{\rtf1\ansi\ansicpg932\cocoartf1138\cocoasubrtf470
{\fonttbl\f0\fswiss\fcharset0 Helvetica;\f1\fnil\fcharset128 HiraKakuProN-W3;}
{\colortbl;\red255\green255\blue255;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural

\f0\fs24 \cf0 <?php\
class AlpacaDBCommon \{\
  \
  $_dbh;\
  $_dbname = 'alpaca';\
  $_host = '127.0.0.1';\
  $_dsn = "mysql:dbname=$dbname;host=$host";\
  $_user_w = 'alpaca';\
  $_password = '';\
  \
  public function __construct() \{\
    try \{\
        $this->_dbh = new PDO($dsn, $user, $password);\
    \} catch (PDOException $e) \{\
        echo 'Connection failed: ' . $e->getMessage();\
    \}\
  \}\
  \
  /**\
  * 
\f1 \'89\'ef\'8f\'ea\'8f\'ee\'95\'f1\'82\'f0\'8e\'e6\'93\'be
\f0 \
  */\
  public function getHall(int $hall_id)\{\
    $sql = "\
SELECT * FROM hall WHERE id = :hall_id\
";\
    $sth = $dbh->prepare($sql);\
    $sth->bindValue(':hall_id', $hall_id, PDO::PARAM_INT);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
   if(empty($res))\{\
     return array();\
   \}\
   return $res;\
  \}\
\
  /**\
  * 
\f1 \'89\'ef\'8f\'ea\'83\'8a\'83\'58\'83\'67\'82\'f0\'8e\'e6\'93\'be
\f0 \
  * 
\f1 \'88\'f8\'90\'94\'82\'c9\'82\'e6\'82\'e8\'82\'52\'82\'4f\'8c\'8f\'82\'b8\'82\'c2\'95\'d4\'82\'b7
\f0 \
  * 0 
\f1 \'82\'aa
\f0 1-30
\f1 \'82\'dc\'82\'c5\'82\'cc\'83\'66\'81\'5b\'83\'5e\'82\'f0\'95\'d4\'82\'b7
\f0 \
  */\
  public function getHallList($num = 0)\{\
    $num++;\
    $get_count = 30;\
    $start = $num * $get_count;\
    $sql = "\
SELECT * FROM hala ORDER BY id ASC LIMIT $start, $get_count;\
";\
    $sth = $dbh->prepare($sql);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
   if(empty($res))\{\
     return array();\
   \}\
   return $res;\
  \}\
  \
  \
  /**\
  * 
\f1 \'89\'ef\'8f\'ea
\f0 ID
\f1 \'82\'a9\'82\'e7
\f0 Plan
\f1 \'83\'66\'81\'5b\'83\'5e\'82\'cc\'93\'fc\'82\'c1\'82\'bd\'94\'7a\'97\'f1\'82\'f0\'95\'d4\'82\'b7
\f0 \
  * 
\f1 \'82\'c8\'82\'a2\'8f\'ea\'8d\'87\'82\'cd\'82\'a9\'82\'e7\'82\'cc\'94\'7a\'97\'f1\'82\'f0\'95\'d4\'82\'b7
\f0 \
  */\
  public function getPlanList(int $hall_id)\{\
    $sql = "\
SELECT * FROM plan WHERE hall_id = :hall_id\
";\
    $sth = $dbh->prepare($sql);\
    $sth->bindValue(':hall_id', $hall_id, PDO::PARAM_INT);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
   if(empty($res))\{\
     return array();\
   \}\
   return $res;\
  \}\
  \
  /**\
  * 
\f1 \'83\'49\'81\'5b\'83\'69\'81\'5b
\f0 ID
\f1 \'82\'a9\'82\'e7\'83\'49\'81\'5b\'83\'69\'81\'5b\'8f\'ee\'95\'f1\'82\'f0\'95\'d4\'82\'b7
\f0 \
  * \
  */\
  public function getOwner(int $owner_id)\{\
    $sql = "\
SELECT * FROM owner WHERE id = :owner_id\
";\
    $sth = $dbh->prepare($sql);\
    $sth->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
    if(empty($res))\{\
      return array();\
    \}\
    return $res;\
  \}\
  \
  /**\
  * 
\f1 \'82\'a8\'8b\'71\'97\'6c
\f0 ID
\f1 \'82\'a9\'82\'e7\'82\'a8\'8b\'71\'97\'6c\'8f\'ee\'95\'f1\'82\'f0\'95\'d4\'82\'b7
\f0 \
  * \
  */\
  public function getUser(int $user_id)\{\
    $sql = "\
SELECT * FROM user WHERE id = :user_id\
";\
    $sth = $dbh->prepare($sql);\
    $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
    if(empty($res))\{\
      return array();\
    \}\
    return $res;\
  \}\
\
  /**\
  * 
\f1 \'83\'81\'81\'5b\'83\'8b\'83\'41\'83\'68\'83\'8c\'83\'58\'82\'a9\'82\'e7\'82\'a8\'8b\'71\'97\'6c
\f0 ID
\f1 \'82\'f0\'8e\'e6\'93\'be
\f0 \
  */\
  public function getUserId(int $mail_address)\{\
    $sql = "\
SELECT id FROM user WHERE mail_address = :mail_address\
";\
    $sth = $dbh->prepare($sql);\
    $sth->bindValue(':mail_address', $user_id, PDO::PARAM_INT);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
    if(empty($res))\{\
      return array();\
    \}\
    return $rea['id'];\
  \}\
\
  /**\
  * 
\f1 \'89\'ef\'8f\'ea\'91\'8d\'90\'94\'82\'f0\'8e\'e6\'93\'be
\f0  \
  */\
  public function getHallCount()\{\
    $sql = "\
SELECT count(*) FROM hall;\
";\
    $sth = $dbh->prepare($sql);\
    $sth->execute();\
    $res = $sth->fetchAll(PDO::FETCH_ASSOC);\
\
    if(empty($res))\{\
      return array();\
    \}\
    return $res["COUNT(*)"];\
  \}\
\
  \
  /**\
  * Plan
\f1 \'82\'f0\'82\'a8\'8b\'71\'97\'6c\'8f\'ee\'95\'f1\'82\'c6\'88\'ea\'8f\'8f\'82\'c9\'93\'6f\'98\'5e
\f0  \
  */\
  public function saveUser($name, $mail_address, $tel, $note,\
	$date_to, $date_from, $stricken_area, $bus, $town )\{\
    $sq_user = "\
INSERT INTO user (name, mail_address, tel, note);\
VLUES\
(:name, :mail_address, :tel, :note);\
";\
    $sth = $dbh->prepare($sql_user);\
    $sth->bindValue(':name', $name, PDO::PARAM_STR);\
    $sth->bindValue(':mail_address', $mail_address, PDO::PARAM_INT);\
    $sth->bindValue(':tel', $tel, PDO::PARAM_STR);\
    $sth->bindValue(':note', $note, PDO::PARAM_STR);\
    \
    try\{\
      $sth->execute();\
    \}catch(PDOException $e)\{\
      error_log("PDO Exception : " . $e->getMessage());\
      return false;\
    \}\
\
    $sq_plan = "\
INSERT INTO plan (date_to, date_from, stricken_area, bus, town);\
VLUES\
(:date_to, :date_from, :stricken_area, :bus, :town);\
";\
     \
    $sth_plan = $dbh->prepare($sql_plan);\
    $sth_plan->bindValue(':bus', $bus, PDO::PARAM_BOOL);\
    $sth_plan->bindValue(':date_to', $date_to, PDO::PARAM_STR);\
    $sth_plan->bindValue(':date_from', $date_from, PDO::PARAM_STR);\
    $sth_plan->bindValue(':stricken_area', $stricken_area, PDO::PARAM_BOOL);\
    $sth_plan->bindValue(':bus', $bus, PDO::PARAM_BOOL);\
    $sth_plan->bindValue(':town', $town, PDO::PARAM_BOOL);\
   \
    try\{\
      $sth_plan->execute();\
    \}catch(PDOException $e)\{\
      error_log("PDO Exception : " . $e->getMessage());\
      return false;\
    \}\
  \}\
\}}