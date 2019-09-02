<?php

Class Statique{

    public static function isFreeForPeriod($beginTest, $endTest, $beginUsed, $endUsed): bool{
        if(!(($beginTest < $beginUsed && $endTest < $beginUsed) || ($beginTest > $endUsed && $endTest > $endUsed))) 
        // ! Avant ou Après sans chevauchement
        {
            return false;
        }
        return true;
    }
}


?>