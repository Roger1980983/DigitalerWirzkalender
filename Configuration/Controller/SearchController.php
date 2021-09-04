<?php
        require '../../System/DatabaseConnector.php';
        require '../../System/JsonFileHandler.php';

        $db = (new DatabaseConnector())->getConnection();
        //$this->db = $db;
        $fileHandler = new JsonFileHandler();
        $searchstring = $fileHandler->handleJsonRequest();
         
        if (isset($searchstring))
        {
            
        $statement = "
                SELECT JSON_OBJECT('chapter',id,'textpart',textpart) as 'res'
                    FROM parts 
                        WHERE MATCH (textpart) 
                        AGAINST ('$searchstring[searchstring]' 
                            IN NATURAL LANGUAGE MODE);

            ";
        
        $statement = "
                SELECT id, textpart, title
                    FROM parts 
                        WHERE MATCH (textpart) 
                        AGAINST ('$searchstring[searchstring]' 
                            IN NATURAL LANGUAGE MODE);

            ";
        }

        try {
            $statement = $db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

//            $result2 = "[";
//            for ($x=0;$x<count($result);$x++) {
//                
//                $result2 = $result2 . $result[$x]["res"];
////                if ($x < count($result)-1) {
//                    $result2 = $result2 . ", ";
//                }
//            }
//            $result2 = $result2 . "]";
//            
//            var_dump($result2);
//            $result = json_encode($result);
            echo(json_encode($result));
            
//            return (json_encode($result));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
        
        
 ?>

