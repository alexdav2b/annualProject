<?php

Class Statique{

    public static function isFreeForPeriod($dateStart, $dateEnd, $dateStartUsed, $dateEndUsed): bool{
        $beginTest = new DateTime($dateStart);
        $endTest = new DateTime($dateEnd);

        foreach($deliveries as $delivery){
            $beginUsed = new DateTime($dateStartUsed);
            $endUsed = new DateTime($dateEndUsed);
            if(!(($beginTest < $beginUsed && $endTest < $beginUsed) || ($beginTest > $endUsed && $endTest > $endUsed))) 
            // ! Avant ou Après sans chevauchement
            {
                return false;
            }
        }
        return true;
        
    }
}


?>